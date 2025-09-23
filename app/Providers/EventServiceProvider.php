<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    protected $listen=[
        \App\Events\UserCreated::class=>[
            \App\Events\SendWelcomeMessage::class,
        ],
    ];
    public function register(): void
    {
       
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
