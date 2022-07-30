<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Schema;
use App\WebSetting;

//CRONTAB
//* * * * * cd /home/webuser/helpthoseneed && docker-compose exec php_app php artisan schedule:run >> /dev/null 2>&1

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {   
        $webSetting = false;
        if (Schema::hasTable('web_settings')) {
            $webSetting = WebSetting::find(1);
        }

        if($webSetting){
            if($webSetting->enable_email_sending){
                $schedule->command('email:send')->everyMinute()->withoutOverlapping(5);    
            }
        }
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
