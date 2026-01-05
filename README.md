# kernel-http

[![Current version](https://img.shields.io/packagist/v/eureka/kernel-console.svg?logo=composer)](https://packagist.org/packages/eureka/kernel-console)
[![Supported PHP version](https://img.shields.io/static/v1?logo=php&label=PHP&message=>%3D8.3&color=777bb4)](https://packagist.org/packages/eureka/kernel-console)
![Build](https://github.com/eureka-framework/kernel-console/workflows/CI/badge.svg)
[![Quality Gate Status](https://sonarcloud.io/api/project_badges/measure?project=eureka-framework_kernel-console&metric=alert_status)](https://sonarcloud.io/dashboard?id=eureka-framework_kernel-console)
[![Coverage](https://sonarcloud.io/api/project_badges/measure?project=eureka-framework_kernel-console&metric=coverage)](https://sonarcloud.io/dashboard?id=eureka-framework_kernel-console)

Kernel Console for any Eureka Framework application.

Define global Application &amp; Component kernel version


## Installation

If you wish to install it in your project, require it via composer:

```bash
composer require eureka/kernel-console
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
use Lcobucci\Clock\SystemClock;
use Psr\Container\NotFoundExceptionInterface;

//~ Define Loader & add main classes for config
require_once __DIR__ . '/vendor/autoload.php';

try {

    $root   = realpath(__DIR__ . '/..');
    $env    = 'dev';
    $debug  = true;

    $kernel = new Kernel($root, $env, $debug);

    $console = (new Application(SystemClock::fromUTC(), $argv, container: $kernel->getContainer()))
        ->setBaseNamespaces(['Application\Script', 'Eureka\Component'])
    ;

    $console->before();
    $console->run();
    $console->after();
    $console->terminate();

} catch (\Throwable $exception) {
    echo 'Exception: ' . $exception->getMessage() . PHP_EOL;
    exit(1);
}

```

### Config tree example
```
config/
|_ packages/
|  |_ domains/
|      - user.yaml
|   -  app.yaml
|   - database.yaml
|   - services.yaml
|_ dev/
|   - app.yaml
|_ test/
|   - app.yaml
|_ secrets/
|   - database.yaml
|_ services.yaml
```

Config loading order and overrides:
1. `packages/` yaml files
2. Then `services.yaml` yaml file
3. Then `{current_env}/` yaml files
4. Finally `secrets/` yaml files

## Contributing

See the [CONTRIBUTING](CONTRIBUTING.md) file.


### Install / update project

You can install project with the following command:
```bash
make install
```

And update with the following command:
```bash
make update
```

NB: For the components, the `composer.lock` file is not committed.

### Testing & CI (Continuous Integration)

#### Tests
You can run unit tests (with coverage) on your side with following command:
```bash
make php/tests
```

You can run integration tests (without coverage) on your side with following command:
```bash
make php/integration
```

For prettier output (but without coverage), you can use the following command:
```bash
make php/testdox # run tests without coverage reports but with prettified output
```

#### Code Style
You also can run code style check with following commands:
```bash
make php/check
```

You also can run code style fixes with following commands:
```bash
make php/fix
```

#### Check for missing explicit dependencies
You can check if any explicit dependency is missing with the following command:
```bash
make php/deps
```

#### Static Analysis
To perform a static analyze of your code (with phpstan, lvl 9 at default), you can use the following command:
```bash
make php/analyse
```

To ensure you code still compatible with current supported version at Deezer and futures versions of php, you need to
run the following commands (both are required for full support):

Minimal supported version:
```bash
make php/min-compatibility
```

Maximal supported version:
```bash
make php/max-compatibility
```

#### CI Simulation
And the last "helper" commands, you can run before commit and push, is:
```bash
make ci  
```

## License

This project is currently under The MIT License (MIT). See [LICENCE](LICENSE) file for more information.
