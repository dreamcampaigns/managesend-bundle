# ManagesendBundle

![Travis (.org)](https://img.shields.io/travis/dreamcampaigns/managesend-bundle)
![Packagist](https://img.shields.io/packagist/l/dreamcampaigns/managesend-bundle)
![Packagist Version](https://img.shields.io/packagist/v/dreamcampaigns/managesend-bundle)
![Packagist](https://img.shields.io/packagist/dt/dreamcampaigns/managesend-bundle)

This bundle integrates [DreamCampaigns API](https://github.com/dreamcampaigns/managesend-php) into your Symfony application.

## Prerequisites

This version of the bundle requires Symfony 5 for Symfony 2, 3 or 4 versions try v1.

## Installation

**managesend-bundle** is available on Packagist as the
[`dreamcampaigns/managesend-bundle`](https://packagist.org/packages/dreamcampaigns/managesend-bundle) package.

## Using Composer

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

## Configuration

**Add DreamCampaigns Api keys**

You can add your Api keys to the `managesend_api.yaml`

```yaml
# config/packages/managesend_api.yaml

managesend_api:
    api_key: <Your API Token Key>
    api_secret: <Your API Token Secret>
    client_id: <Your Client id> #optional for some calls
    timeout: 60 #optional timeout value, default is 60 secs
```
 or use the .env
 
```dotenv
MANAGESEND_TOKEN_KEY=ACXXXXXX
MANAGESEND_TOKEN_SECRET=YXYXYX
MANAGESEND_CLIENT_ID=c5is8tltkk00018k9ype5lg741
```

### Usage

The API is available with the `managesend_api` service.
To access it, use DependencyInjection:

```php

public function TestAction(\Managesend\RestClient $managesend)
{
   $result = $managesend->clients()->getClients();
}
```

## Examples

Samples for accessing all resources can be found in the examples directory of [`dreamcampaigns/managesend-php`](https://packagist.org/packages/dreamcampaigns/managesend-php)

## Documentation

For more details you can reffer to the [`DreamCampaigns API documentations`][apidocs]

[apidocs]: https://api.managesend.com/


