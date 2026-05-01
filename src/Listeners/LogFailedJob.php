<?php

namespace Samirlama\LaravelQueueMonitor\Listeners;

use Illuminate\Queue\Events\JobFailed;
use Samirlama\LaravelQueueMonitor\Models\FailedJob;

class LogFailedJob
{
    public function handle(JobFailed $event): void
    {
        FailedJob::create([
            'connection' => $event->connectionName,
            'queue' => $event->job->getQueue(),
            'payload' => $event->job->payload(),
            'exception' => $event->exception->getMessage(),
        ]);
    }
}
