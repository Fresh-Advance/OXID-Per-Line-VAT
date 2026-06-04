# Per-Line-VAT module for OXID eShop

[![Development](https://github.com/Fresh-Advance/OXID-Per-Line-VAT/actions/workflows/trigger.yaml/badge.svg?branch=b-7.5.x)](https://github.com/Fresh-Advance/OXID-Per-Line-VAT/actions/workflows/trigger.yaml)
[![Latest Version](https://img.shields.io/packagist/v/Fresh-Advance/OXID-Per-Line-VAT?logo=composer&label=latest&include_prereleases&color=orange)](https://packagist.org/packages/Fresh-Advance/OXID-Per-Line-VAT)
[![PHP Version](https://img.shields.io/packagist/php-v/Fresh-Advance/OXID-Per-Line-VAT)](https://github.com/Fresh-Advance/OXID-Per-Line-VAT)

## Branch compatibility

* Branch **b-7.5.x** is compatible with OXID Shop compilation **7.5.0 and up**
* Branch **b-7.4.x** is compatible with OXID Shop compilation **7.4.0 and up**
* Branch **b-7.3.x** is compatible with OXID Shop compilation **7.3.0 and up**
* Branch **b-7.2.x** is compatible with OXID Shop compilation **7.2.0 and up**
* Branch **b-7.1.x** is compatible with OXID Shop compilation **7.1.0 and up**

Note: Not all latest features are available in the older branches.

## Version compatibility

* v1.x is compatible with OXID Shop compilation 7.1.x-7.5.x

Note: Not all latest features and fixes are available in older than the last versions - always prefer the latest possible release.

## Installation

Module is available on packagist and installable via composer

```
composer require fresh-advance/oxid-per-line-vat:1.0
```

# Development installation

To be able running the tests and other preconfigured quality tools, please install the module as a [root package](https://getcomposer.org/doc/04-schema.md#root-package).

The next section shows how to install the module as a root package by using the [Fresh Advance Development Base](https://github.com/Fresh-Advance/development).

In case of different environment usage, please adjust by your own needs.

# Development installation on Fresh Advance Development Base

The installation instructions below are shown for the current [Fresh Advance Development Base](https://github.com/Fresh-Advance/development)
for shop 7.0. Make sure your system meets the requirements of the Development Base.

0. Ensure all docker containers are down to avoid port conflicts

1. Clone the SDK for the new project
```shell
echo MyProject && git clone https://github.com/Fresh-Advance/development.git $_ && cd $_
```

2. Clone the repository to the source directory
```shell
git clone --recurse-submodules https://github.com/Fresh-Advance/OXID-Per-Line-VAT.git --branch=b-7.5.x ./source
```

3. Run the recipe to setup the development environment
```shell
./source/recipes/setup-development.sh
```

You should be able to access the shop with http://localhost.local and the admin panel with http://localhost.local/admin
(credentials: noreply@oxid-esales.com / admin)

### Running the tests and quality tools

Check the "scripts" section in the `composer.json` file for the available commands. Those commands can be executed
by connecting to the php container and running the command from there, example:

```shell
make php
composer tests-coverage
```

Commands can be also triggered directly on the container with docker compose, example:

```shell
docker compose exec -T php composer tests-coverage
```

## License

Please make sure you checked the License before using the module.
