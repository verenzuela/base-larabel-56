<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        'App\Events\Event' => [
            'App\Listeners\EventListener',
        ],
        'App\Events\Logined' => [
            'App\Listeners\LastLoginListener',
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        

        Event::listen('eloquent.*: *', function ($event, $model) {            
            // Get model instance.
            $model = $model[0];            

            // Get event name only(E.g. 'booting').
            $event = explode('.', explode(':', $event)[0])[1];             

            /**
            * Verify if the camel case validation method exists.
            * E.g. eloquent.booting should be validateBooting($args).
            */             
            $method = 'validate' . ucfirst($event);            

            // Do we have a validate<Event> ? Do we have a validate only?
            if (method_exists($model, $method)) {
                return $model->$method($model->getAttributes());
            };        
        });

        parent::boot();
    }
}
