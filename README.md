# ComLaude/php-formatter
Pre-configured php formatter using php-cs-fixer

[![Latest Stable Version](https://poser.pugx.org/comlaude/php-formatter/v)](//packagist.org/packages/comlaude/php-formatter)
[![License](https://poser.pugx.org/comlaude/php-formatter/license)](//packagist.org/packages/comlaude/php-formatter)

## Installation

### Composer

Add the following to your require part within the composer.json: 

```js
"comlaude/php-formatter": "^1.0.0"
```
```shell
$ php composer update
```

or

```shell
$ php composer require comlaude/php-formatter
```

## Integration

### Lumen

Create a **config** folder in the root directory of your Lumen application and copy the content
from **vendor/comlaude/php-formatter/config/php-formatter.php** to **config/php-formatter.php**.

Adjust the properties to your needs.

```php
return [
    // A flag to enable/disable caching mode
    'cache' => false,
    // See https://github.com/FriendsOfPHP/PHP-CS-Fixer/blob/3.0/doc/rules/index.rst for available rules and rulesets
    'rules' => [
        '@PSR2' => true,
        '@DoctrineAnnotation' => true,
        'whitespace_after_comma_in_array' => true,
    ],
    // this is used to call function on configuring a finder as defined here https://github.com/FriendsOfPHP/PHP-CS-Fixer/blob/3.0/doc/config.rst
    'finder' => [
        'include'  => [],
        'exclude'  => [ 'bootstrap', 'vendor', 'storage' ],
        'name'     => [ '*.php' ],
        'notname'  => [ '*.blade.php' ],
        'in'       => __DIR__.'/../../../../',
    ];
```

## Basic Usage

```shell
php vendor/bin/php-formatter fix
```

## CI Automation usage

```shell
php vendor/bin/php-formatter fix -v --dry-run
```

## License

This package is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)