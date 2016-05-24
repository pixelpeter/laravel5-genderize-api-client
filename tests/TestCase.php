<?php

namespace Pixelpeter\Genderize;

use ReflectionClass;

abstract class TestCase extends \Illuminate\Foundation\Testing\TestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__ . '/../vendor/laravel/laravel/bootstrap/app.php';

        $app->register(\Pixelpeter\Genderize\GenderizeServiceProvider::class);

        $app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }

    /**
     * getPrivateProperty
     *
     * @author    Joe Sexton <joe@webtipblog.com>
     * @param    string $className
     * @param    string $propertyName
     * @return    \ReflectionProperty
     */
    public function getPrivateProperty($className, $propertyName)
    {
        $reflector = new ReflectionClass($className);
        $property = $reflector->getProperty($propertyName);
        $property->setAccessible(true);

        return $property;
    }
}
