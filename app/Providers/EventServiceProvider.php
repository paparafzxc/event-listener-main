<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // \App::bindMethod(TestJob::class . '@handle', fn($job)=> $job->handle());
        \App::bindMethod(ProductCreated::class . '@handle', fn($job)=> $job->handle());
        \App::bindMethod(ProductUpdated::class . '@handle', fn($job)=> $job->handle());
        \App::bindMethod(ProductDeleted::class . '@handle', fn($job)=> $job->handle());
    }
}
