<?php

namespace App\Providers;

use App\Events\UserDeleted;
use App\Events\UserSaved;
use App\Listeners\ClearUserCache;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        UserSaved::class => [
            ClearUserCache::class,
        ],
        UserDeleted::class => [
            ClearUserCache::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
