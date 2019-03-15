#!/bin/bash

VERSION=56

# save original composer json
cp ./composer.json ./original-composer.json

# save original phpunit.xml
cp ./phpunit.xml ./original-phpunit.xml

# use laravel specific version of composer.json
cp ./build/$VERSION/composer.json ./composer.json

# use laravel specific version of phpunit.xml
cp ./build/$VERSION/phpunit.xml ./phpunit.xml

# install laravel specific dependencies
composer update --prefer-source --no-interaction

mkdir -p ./build/logs
php ./vendor/bin/phpunit --configuration ./phpunit.xml --coverage-text --coverage-clover ./build/logs/clover.xml

# restore original composer.json
rm ./composer.json
mv ./original-composer.json ./composer.json

# restore original phpunit.xml
rm ./phpunit.xml
mv ./original-phpunit.xml ./phpunit.xml
