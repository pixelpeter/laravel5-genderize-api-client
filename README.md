# Laravel 5 Genderize.io API Client

[![Latest Version on Packagist](https://img.shields.io/packagist/v/pixelpeter/laravel5-genderize-api-client.svg?style=flat-square)](https://packagist.org/packages/pixelpeter/laravel5-genderize-api-client)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Travis Build](https://img.shields.io/travis/pixelpeter/laravel5-genderize-api-client/master.svg?style=flat-square)](https://travis-ci.org/pixelpeter/laravel5-genderize-api-client)
[![Scrutinizer Quality](https://img.shields.io/scrutinizer/g/pixelpeter/laravel5-genderize-api-client.svg?style=flat-square)](https://scrutinizer-ci.com/g/pixelpeter/laravel5-genderize-api-client)
[![Scrutinizer Build](https://img.shields.io/scrutinizer/build/g/pixelpeter/laravel5-genderize-api-client.svg?style=flat-square)](https://scrutinizer-ci.com/g/pixelpeter/laravel5-genderize-api-client)
[![SensioLabsInsight](https://img.shields.io/sensiolabs/i/3297d598-b868-40b0-8bea-e09aea1a10c0.svg?style=flat-square)](https://insight.sensiolabs.com/projects/3297d598-b868-40b0-8bea-e09aea1a10c0)
[![Total Downloads](https://img.shields.io/packagist/dt/pixelpeter/laravel5-genderize-api-client.svg?style=flat-square)](https://packagist.org/packages/pixelpeter/laravel5-genderize-api-client)
[![Dependency Status](https://www.versioneye.com/user/projects/574483dfce8d0e004130c23b/badge.svg?style=flat)](https://www.versioneye.com/user/projects/574483dfce8d0e004130c23b)
[![Coverage Status](https://coveralls.io/repos/github/pixelpeter/laravel5-genderize-api-client/badge.svg?branch=master)](https://coveralls.io/github/pixelpeter/laravel5-genderize-api-client?branch=master)

A simple Laravel 5 client for the [Genderize.io API](https://genderize.io/).
It provides a fluent interface for easy request building.

## Installation

### Step 1: Install Through Composer
``` bash
composer require pixelpeter/laravel5-genderize-api-client
```

### Step 2: Add the Service Provider
Add the service provider in `app/config/app.php`
```php
'provider' => [
    ...
    Pixelpeter\Genderize\GenderizeServiceProvider::class,
    ...
];
```

### Step 3: Add the Facade
Add the alias in `app/config/app.php`
```php
'aliases' => [
    ...
    'Genderize' => Pixelpeter\Genderize\Facades\Genderize::class,
    ...
];
```
### Step 4: Publish the configuration file
This is only needed when you have an API key from Genderize.io
```php
php artisan vendor:publish --provider="Pixelpeter\Genderize\GenderizeServiceProvider"
```

## Examples

### Send requests
#### Single name
```php
use Genderize;

Genderize::name('Peter')->get();
```

#### Multiple names (max. 10)
```php
use Genderize;

Genderize::name(['John', 'Jane'])->get();

// or for better readability you can use the plural
Genderize::names(['John', 'Jane'])->get();
```

#### Add language and country options
```php
use Genderize;

Genderize::name('John')->country('US')->lang('EN')->get();
```
### Working with the response
#### For single usage
```php
use Genderize;

$response = Genderize::name('Peter')->get();

print $response->result->gender; // 'male'
print $response->result->name; // 'Peter'
print $response->result->probability; '0.99'
print $response->result->count; 144
print $response->result->isMale(); true
print $response->result->isFemale(); false
print $response->result->isNotMale(); false
print $response->result->isNotFemale(); true
```

#### For batch usage
```php
use Genderize;

$response = Genderize::names(['John', 'Jane'])->country('US')->lang('EN')->get();

foreach($response->result as $row)
{
    print $row->name;
}
```

### Getting information about the request and limits
```php
use Genderize;

$response = Genderize::name('Peter')->get();

print $response->meta->code; // 200 - HTTP response code
print $response->meta->limit; // 1000 - Max number of allowed requests
print $response->meta->remaining; // 950 - Number of requests left
print $response->meta->reset->diffInSeconds(); // Carbon\Carbon - time left till reset
```

### More documentation
Refer to [Genderize.io API Documentation](https://store.genderize.io/documentation/) for more examples and documentation.

## Testing
Run the tests with:
```bash
vendor/bin/phpunit
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
