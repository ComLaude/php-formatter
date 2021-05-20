<?php

namespace ComLaude\PhpFormatter;

use PhpCsFixer\Finder;

class ConfigReader {

    protected $config;

    function __construct() {
        // Load up the defaults from config file
        $this->config = require(__DIR__.'/../config/php-formatter.php');

        // If the environment config is available merge any overlapping keys
        if(file_exists(__DIR__.'/../../../../config/php-formatter.php')) {
            $modified = $this->readConfigFromFile(__DIR__.'/../../../../config/php-formatter.php');
            // Array merge recursive will do strange things here, we want to permit 1-level deep merging here
            // such that any setting defined in config can be merged with defaults but not merging individual rules within
            $this->config['cache'] = isset($modified['cache']) ? $modified['cache'] : $this->config['cache'];
            $this->config['finder'] = array_merge($this->config['finder'], $modified['finder'] ?? []);
            $this->config['rules'] = array_merge($this->config['rules'], $modified['rules'] ?? []);
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