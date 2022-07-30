<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Schema;
use App\Services\ThemeLanding;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ThemeLanding::class);
        $this->app->alias(ThemeLanding::class, 'ThemeLanding');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {   
        if(config('app.env') === 'production') { \URL::forceScheme('https'); }
        if(config('app.env') === 'development') { \URL::forceScheme('https'); }

        Schema::defaultStringLength(191);

        $saveManyToManyAudit = function ($event, $eventData) {
            $audit = new Audit;
            $audit->user_id = Auth::check() ? Auth::user()->getAuthIdentifier() : null;
            $audit->event = $event;
            $audit->auditable_id = $eventData['parent_id'];
            $audit->auditable_type = $eventData['parent_model'];
            $audit->old_values = [];
            unset($eventData['parent_id']);
            unset($eventData['parent_model']);
            $audit->new_values = $eventData;
            $audit->url = App::runningInConsole() ? 'console' : Request::fullUrl();
            $audit->ip_address = Request::ip();
            $audit->user_agent = Request::header('User-Agent');
            $audit->created_at = Carbon::now();
            $audit->save();
        };

        $this->app['events']->listen('App\Events\Relations\Attached', function ($eventData) use ($saveManyToManyAudit) {
            $saveManyToManyAudit('attached', $eventData);
        });
    }
}
