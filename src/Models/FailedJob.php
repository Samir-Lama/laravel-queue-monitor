<?php

namespace Samirlama\LaravelQueueMonitor\Models;

use Illuminate\Database\Eloquent\Model;

class FailedJob extends Model
{
    protected $table = 'failed_jobs_monitor';

    protected $fillable = [
        'connection',
        'queue',
        'payload',
        'exception',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'payload' => 'array',
    ];
}
