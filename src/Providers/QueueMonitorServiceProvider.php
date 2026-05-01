<?php

namespace Samirlama\LaravelQueueMonitor\Providers;

use Illuminate\Queue\Events\JobFailed;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Samirlama\LaravelQueueMonitor\Listeners\LogFailedJob;

class QueueMonitorServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Event::listen(JobFailed::class, LogFailedJob::class);

        $this->loadRoutesFrom(__DIR__.'/../../routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'queue-monitor');
        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');

        $this->publishes([
            __DIR__.'/../../config/queue-monitor.php' => config_path('queue-monitor.php'),
        ], 'queue-monitor-config');
    }

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../../config/queue-monitor.php', 'queue-monitor');
    }
}
