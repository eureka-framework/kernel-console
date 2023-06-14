# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](http://semver.org/spec/v2.0.0.html).


## [5.2.0] - 2023-06-14
### Changed
- Now compatible PHP 8.2
- Update composer.json
- Fix phpstan error in Kernel
- Add PHP 8.2 compatibility check

## [5.1.0] - 2022-09-02
### Changed
* CI improvements (php compatibility check, makefile, jenkins)
* Now compatible with PHP 7.4, 8.0 & 8.1
* Fix phpdoc according to phpstan analysis
### Added
* phpstan for static analysis
### Removed
* phpcompatibility (no more maintained)

## [5.0.1] - 2020-11-05
### Changed:
 * Better loading for yaml file (now search for sub directory /{env}/ & /secrets/)

## [5.0.0] - 2020-10-29
### Changed:
 * Require php 7.4+
 * Improve code & testability
 * Update kernel
 * Upgrade phpcodesniffer to v0.7 for composer 2.0
 * Now require eureka/component-console (v5.0+)
### Added
 * Tests
 * Configs for tests



## [4.0] - No Release



## [3.0] - No Release



## [2.0+] - 2019
### Changed  
 * Require php 7.2+
 * Update kernel
 * Update interface
 * Now based on Eurekon 3.0
 * Re-order config loading
 * Upgrade to Eurekon 3.2+
### Added
 * Allow sub directories in config/packages/


 
## [1.0+] - 2018
### Added
 * Add kernel console
 * Add application
 * Add interface
 * Add dependency to Eurekon 2.0+
 * Support namespace from packages
### Changed
 * Change loading cache methods
 * Change loading service container
