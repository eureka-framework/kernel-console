# kernel-http

[![Current version](https://img.shields.io/packagist/v/eureka/kernel-console.svg?logo=composer)](https://packagist.org/packages/eureka/kernel-console)
[![Supported PHP version](https://img.shields.io/static/v1?logo=php&label=PHP&message=%5E7.4&color=777bb4)](https://packagist.org/packages/eureka/kernel-console)
![Build](https://github.com/eureka-framework/kernel-console/workflows/CI/badge.svg)
[![Quality Gate Status](https://sonarcloud.io/api/project_badges/measure?project=eureka-framework_kernel-console&metric=alert_status)](https://sonarcloud.io/dashboard?id=eureka-framework_kernel-console)
[![Coverage](https://sonarcloud.io/api/project_badges/measure?project=eureka-framework_kernel-console&metric=coverage)](https://sonarcloud.io/dashboard?id=eureka-framework_kernel-console)

Kernel Console for any Eureka Framework application.

Define global Application &amp; Component kernel version


## Installation

You can install the kernel (for testing) with the following command:
```bash
make install
```

## Update

You can update the kernel (for testing) with the following command:
```bash
make update
```

## Usage

```php
<?php

/*
 * Copyright (c) Romain Cottard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Eureka\Kernel\Console\Application\Application;
use Eureka\Kernel\Console\Kernel;
use Psr\Container\NotFoundExceptionInterface;

//~ Define Loader & add main classes for config
require_once __DIR__ . '/vendor/autoload.php';

try {

    $root   = realpath(__DIR__ . '/..');
    $env    = 'dev';
    $debug  = true;

    $kernel = new Kernel($root, $env, $debug);

    $console = (new Application($argv, $kernel->getContainer()))
        ->setBaseNamespaces([
            'Application\Script',
            'Eureka\Component\Deployer\Script',
            'Eureka\Component',
        ])
        //->setLogger()
    ;

    $console->before();
    $console->run();
    $console->after();
    $console->terminate();

} catch (NotFoundExceptionInterface $exception) {
    echo 'Exception: ' . $exception->getMessage() . PHP_EOL;
    exit(1);
} catch (\Exception $exception) {
    echo 'Exception: ' . $exception->getMessage() . PHP_EOL;
    exit(1);
}

```



## Testing

You can test the kernel with the following commands:
```bash
make phpcs
make tests
make testdox
```