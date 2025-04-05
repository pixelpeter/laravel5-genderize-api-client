# Laravel 5 Genderize.io API Client

[![Latest Version on Packagist](https://img.shields.io/packagist/v/pixelpeter/laravel5-genderize-api-client.svg?style=flat-square)](https://packagist.org/packages/pixelpeter/laravel5-genderize-api-client)
[![Total Downloads](https://img.shields.io/packagist/dt/pixelpeter/laravel5-genderize-api-client.svg?style=flat-square)](https://packagist.org/packages/pixelpeter/laravel5-genderize-api-client)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Coverage Status](https://coveralls.io/repos/github/pixelpeter/laravel5-genderize-api-client/badge.svg?branch=master)](https://coveralls.io/github/pixelpeter/laravel5-genderize-api-client?branch=master)
[![Tests](https://github.com/pixelpeter/laravel5-genderize-api-client/actions/workflows/run-tests.yml/badge.svg?branch=master)](https://github.com/pixelpeter/laravel5-genderize-api-client/actions/workflows/run-tests.yml)
[![Fix PHP code style issues](https://github.com/pixelpeter/laravel5-genderize-api-client/actions/workflows/fix-php-code-style-issues.yml/badge.svg)](https://github.com/pixelpeter/laravel5-genderize-api-client/actions/workflows/fix-php-code-style-issues.yml)
[![PHPStan](https://github.com/pixelpeter/laravel5-genderize-api-client/actions/workflows/phpstan.yml/badge.svg)](https://github.com/pixelpeter/laravel5-genderize-api-client/actions/workflows/phpstan.yml)
[![dependabot-auto-merge](https://github.com/pixelpeter/laravel5-genderize-api-client/actions/workflows/dependabot-auto-merge.yml/badge.svg)](https://github.com/pixelpeter/laravel5-genderize-api-client/actions/workflows/dependabot-auto-merge.yml)

A simple Laravel 5 client for the [Genderize.io API](https://genderize.io/).
It provides a fluent interface for easy request building.

## WARNING: This library is deprecated. Please use [https://github.com/pixelpeter/laravel-genderize-api-client](https://github.com/pixelpeter/laravel-genderize-api-client) instead.
## Version overview

| Laravel | php           | use branch  |
| ------  | ------------- |-------------|
| 5.8     | 7.1, 7.2, 7.3 | master      |
| 5.7     | 7.1, 7.2, 7.3 | 2.0.x       |
| 5.6     | 7.1, 7.2, 7.3 | 2.0.x       |
| 5.5     | 7.0, 7.1, 7.2 | 1.1.x/2.0.x |

## Installation

### Step 1: Install Through Composer
``` bash
composer require pixelpeter/laravel5-genderize-api-client
```

### Step 2: Add the Service Provider (not needed with v2.x because of auto discovery)
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

print $response->result->first()->gender; // 'male'
print $response->result->first()->name; // 'Peter'
print $response->result->first()->probability; '0.99'
print $response->result->first()->count; 144
print $response->result->first()->isMale(); true
print $response->result->first()->isFemale(); false
print $response->result->first()->isNotMale(); false
print $response->result->first()->isNotFemale(); true
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
Refer to [Genderize.io API Documentation](https://genderize.io/documentation/) for more examples and documentation.

## Testing
Run the tests with:
```bash
vendor/bin/phpunit
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
