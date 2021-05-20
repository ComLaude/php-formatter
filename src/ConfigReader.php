<?php

namespace ComLaude\PhpFormatter;

use PhpCsFixer\Finder;

class ConfigReader {

    protected $config;

    function __construct() {
        // Load up the defaults from config file
        $this->config = require(__DIR__.'/../config/php-formatter.php');

        // If the environment config is available merge any overlapping keys
        if(file_exists(__DIR__.'/../../../config/php-formatter.php')) {
            $this->config = array_merge_recursive($this->readConfigFromFile());
        }
    }

    public function readConfigFromFile($file) {
        return include($file);
    }

    public function getUsingCache() {
        return $this->config['cache'] ?? false;
    }

    public function getRules() {
        return $this->config['rules'] ?? [];
    }

    public function getFinder() {

        $finder = Finder::create();

        foreach($this->config['finder'] as $command => $value) {
            if(!empty($value)) {
                $finder->$command($value);
            }
        }

        return $finder;
    }
}