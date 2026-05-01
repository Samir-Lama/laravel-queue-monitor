<?php

namespace Samirlama\LaravelQueueMonitor\Tests;

use Exception;
use Illuminate\Queue\Events\JobFailed;
use Samirlama\LaravelQueueMonitor\Listeners\LogFailedJob;

class FailedJobTest extends TestCase
{
    public function test_it_stores_failed_job_in_database(): void
    {
        $job = new class {
            public function getQueue()
            {
                return 'default';
            }

            public function payload()
            {
                return ['job' => 'test'];
            }
        };

        $event = new JobFailed(
            'database',
            $job,
            new Exception('Test failure')
        );

        (new LogFailedJob())->handle($event);

        $this->assertDatabaseHas('failed_jobs_monitor', [
            'connection' => 'database',
            'queue' => 'default',
            'exception' => 'Test failure',
        ]);
    }
}
