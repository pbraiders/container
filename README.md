# Pbraiders-container

[![Build Status](https://img.shields.io/travis/pbraiders/container/master.svg?style=flat-square)](https://travis-ci.com/pbraiders/container.svg?branch=master)

Pbraiders\Container is a factory that create PSR-11 dependency injection container: PHP-DI, League\Container, ...

*Note: I use this package for my own projects, it contains only the features I need.*

## Table of Contents

- [Requirements](#requirements) | [Installation](#installation) | [Documentation](#documentation) | [Test](#test) | [Contributing](#contributing) | [License](#license)

## Requirements

- PHP: >=7.3
- php-di/php-di: >=6.0

## Installation

This package requires PHP 7.3. For specifics, please examine the package [composer.json](https://github.com/pbraiders/container/blob/master/composer.json) file.

You may check if your PHP and extension versions match the platform requirements using `composer diagnose` and `composer check-platform-reqs`. (This requires [Composer](https://getcomposer.org/) to be available as composer.)

This package is installable and PSR-4 autoloadable via [Composer](https://getcomposer.org/) as pbraiders/container. For no dev, use `composer install --no-dev` and for dev, use `composer install`.

Alternatively, [download a release](https://github.com/pbraiders/container/releases), or clone this repository, then map the Pbraiders\Container\ namespace to the package src/ directory.

## Documentation

I wrote and I use this package for my own projects. And, unfortunately, I do not provide exhaustive documentation. Please read the code and the comments ;)

## Test

To run the unit tests at the command line, issue `composer install` and then `./vendor/bin/phpunit` at the package root. (This requires [Composer](https://getcomposer.org/) to be available as composer.)

## Contributing

Thanks you for taking the time to contribute. Please fork the repository and make changes as you'd like.

If you have any ideas, just open an [issue](https://github.com/pbraiders/container/issues) and tell me what you think. Pull requests are also warmly welcome.

If you encounter any **bugs**, please open an [issue](https://github.com/pbraiders/container/issues).

Be sure to include a title and clear description,as much relevant information as possible, and a code sample or an executable test case demonstrating the expected behavior that is not occurring.

## License

**PBRaiders Container** is open-source and is licensed under the [GNU General Public License v3.0 License](https://github.com/pbraiders/container/blob/master/LICENSE).
