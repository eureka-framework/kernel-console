<?php

use ShipMonk\ComposerDependencyAnalyser\Config\Configuration;
use ShipMonk\ComposerDependencyAnalyser\Config\ErrorType;

$config = new Configuration();

return $config
    ->addPathToScan(__DIR__ . '/../src', isDev: false)
    ->addPathToScan(__DIR__ . '/../tests', isDev: true)

    ->ignoreErrorsOnPackage('symfony/yaml',  [ErrorType::UNUSED_DEPENDENCY]) // required in dependencies of symfony/dependency-injection
;
