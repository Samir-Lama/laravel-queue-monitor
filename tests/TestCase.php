<?php

namespace Samirlama\LaravelQueueMonitor\Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;
use Samirlama\LaravelQueueMonitor\Providers\QueueMonitorServiceProvider;

class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app)
    {
        return [
            QueueMonitorServiceProvider::class,
        ];
    }

    protected function defineDatabaseMigrations()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }
}
