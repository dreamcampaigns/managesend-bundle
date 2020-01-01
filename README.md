# managesendBundle

This bundle integrates [DreamCampaigns API](https://github.com/dreamcampaigns/managesend-php). into Symfony2.

## Installation

## Symfony 2.1 and above (using Composer)

Require the bundle in your composer.json file:

``` json
{
    "require": {
        "dreamcampaigns/managesend-bundle": "*"
    }
}
```

Install the bundle:

``` bash
$ composer require dreamcampaigns/managesend-bundle
```

Register the bundle:

``` php
// app/AppKernel.php

public function registerBundles()
{
    return array(
        new Managesend\ApiBundle\ManagesendApiBundle(),
        // ...
    );
}
```

## Symfony 2.0.*

### Submodule Creation

Add HTMLPurifier and this bundle to your `vendor/` directory:

``` bash
$ git submodule add git://github.com/Exercise/HTMLPurifierBundle.git vendor/bundles/Exercise/HTMLPurifierBundle
$ git submodule add git://github.com/ezyang/htmlpurifier.git vendor/htmlpurifier
```

### Class Autoloading

Register "HTMLPurifier" and the "Exercise" namespace prefix in your project's
`autoload.php`:

``` php
# app/autoload.php

$loader->registerNamespaces(array(
    'Exercise' => __DIR__ . '/../vendor/bundles',
));

$loader->registerPrefixes(array(
    'HTMLPurifier' => __DIR__ . '/../vendor//htmlpurifier/library',
));
```

### Application Kernel

Add HTMLPurifierBundle to the `registerBundles()` method of your application
kernel:

``` php
# app/AppKernel.php

public function registerBundles()
{
    return array(
        // ...
        new Managesend\ApiBundle\ManagesendApiBundle(),
        // ...
    );
}
```

## Configuration

If you do not explicitly configure this bundle, an HTMLPurifier service will be
defined as `exercise_html_purifier.default`. This behavior is the same as if you
had specified the following configuration:

``` yaml
# app/config.yml

managesend_api:
    api_key: 
    api_secret: 
    client_id: 
```

