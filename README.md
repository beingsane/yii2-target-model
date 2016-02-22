# TargetModel for Yii2

This extension for yii framework 2 allows to get custom information for ActiveRecord. It is used in some other extensions.

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
composer require --prefer-dist yiister/yii2-target-model
```

or add

```json
"yiister/yii2-target-model": "dev-master"
```

to the `require` section of your composer.json.

## Post-installation

Go to directory with your yii console bootstrap file and execute

```
./yii migrate --migrationPath=@yiister/tm/migrations
```
