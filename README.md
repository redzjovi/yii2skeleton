Yii 2 Advanced Project Template
===============================

Yii 2 Advanced Project Template is a skeleton [Yii 2](http://www.yiiframework.com/) application best for
developing complex Web applications with multiple tiers.

The template includes three tiers: front end, back end, and console, each of which
is a separate Yii application.

The template is designed to work in a team development environment. It supports
deploying the application in different environments.

Documentation is at [docs/guide/README.md](docs/guide/README.md).

[![Latest Stable Version](https://poser.pugx.org/yiisoft/yii2-app-advanced/v/stable.png)](https://packagist.org/packages/yiisoft/yii2-app-advanced)
[![Total Downloads](https://poser.pugx.org/yiisoft/yii2-app-advanced/downloads.png)](https://packagist.org/packages/yiisoft/yii2-app-advanced)
[![Build Status](https://travis-ci.org/yiisoft/yii2-app-advanced.svg?branch=master)](https://travis-ci.org/yiisoft/yii2-app-advanced)

DIRECTORY STRUCTURE
-------------------

```
common
    config/              contains shared configurations
    mail/                contains view files for e-mails
    models/              contains model classes used in both backend and frontend
    tests/               contains tests for common classes    
console
    config/              contains console configurations
    controllers/         contains console controllers (commands)
    migrations/          contains database migrations
    models/              contains console-specific model classes
    runtime/             contains files generated during runtime
backend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains backend configurations
    controllers/         contains Web controller classes
    models/              contains backend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for backend application    
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
frontend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains frontend configurations
    controllers/         contains Web controller classes
    models/              contains frontend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for frontend application
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
    widgets/             contains frontend widgets
vendor/                  contains dependent 3rd-party packages
environments/            contains environment-based overrides
```
Features
-------------------
- [yii2-assets-auto-compress](https://github.com/skeeks-semenov/yii2-assets-auto-compress)
- [yii2-clean-assets](https://github.com/mbrowniebytes/yii2-clean-assets)
- [yii2-migrik](https://github.com/Insolita/yii2-migrik)
- [yii2-nestable](https://github.com/ASlatius/yii2-nestable)
- [yii2-nested-sets](https://github.com/creocoder/yii2-nested-sets)
- [yii2-usuario](https://github.com/2amigos/yii2-usuario)
- [yii2-widget-remainingcharacters](https://github.com/jlorente/yii2-widget-remainingcharacters)

Installation
-------------------
- Run command, composer global require "fxp/composer-asset-plugin:^1.0"
- Run command, composer update
- Run command, php init, then choose 0
- Update common/config/main-local.php, set db
- Run command, php yii clean-assets
- Run command, php yii migrate/up 5 --migrationPath=@vendor/2amigos/yii2-usuario/migrations
- Run command, php yii migrate/up 1 --migrationPath=@yii/rbac/migrations
- Run command, php yii migrate/up 8
