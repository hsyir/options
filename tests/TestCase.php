<?php

namespace Hsy\Options\Tests;


use Hsy\Options\OptionsServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->loadMigrationsFrom(__DIR__ . "/../database/migrations");

    }

    protected function getPackageProviders($app)
    {
        return [
            OptionsServiceProvider::class
        ];
    }

    protected function getEnvironmentSetUp($app)
    {

        // Setup default database to use sqlite :memory:
        $app['config']->set('app.locale', 'fa');
        $app['config']->set('app.faker_locale', 'fa_IR');
        $app['config']->set('app.timezone', 'Asia/tehran');
        $app['config']->set('database.default', 'testdb');
        $app['config']->set('database.connections.testdb', [
            'driver' => 'sqlite',
            'database' => ':memory:',
        ]);
    }
}