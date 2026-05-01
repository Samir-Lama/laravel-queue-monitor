<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('failed_jobs_monitor', function (Blueprint $table): void {
            $table->id();
            $table->string('connection');
            $table->string('queue')->nullable();
            $table->json('payload');
            $table->text('exception');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('failed_jobs_monitor');
    }
};
