<?php
$configReader = new ComLaude\PhpFormatter\ConfigReader();
return (new PhpCsFixer\Config())
    ->setUsingCache($configReader->getUsingCache())
    ->setRules($configReader->getRules())
    ->setFinder($configReader->getFinder());
