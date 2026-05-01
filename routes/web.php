<?php

use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Route;
use Samirlama\LaravelQueueMonitor\Models\FailedJob;

Route::middleware(config('queue-monitor.middleware', ['web']))
    ->prefix(config('queue-monitor.route_path', 'queue-monitor'))
    ->group(function (): void {
        Route::get('/', function () {
            return view('queue-monitor::dashboard', [
                'jobs' => FailedJob::latest()->get(),
            ]);
        })->name('queue-monitor.index');

        Route::post('/retry/{id}', function (int $id) {
            $failedJob = FailedJob::findOrFail($id);

            Queue::connection($failedJob->connection)->pushRaw(
                json_encode($failedJob->payload, JSON_THROW_ON_ERROR),
                $failedJob->queue
            );

            return redirect()
                ->route('queue-monitor.index')
                ->with('status', 'Job has been queued for retry.');
        })->name('queue-monitor.retry');
    });
