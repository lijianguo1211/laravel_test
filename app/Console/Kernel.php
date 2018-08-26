<?php

namespace App\Console;

use App\Models\Test;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var arrayphp
     */
    protected $commands = [
       /* App\Console\Commands\Inspire::class,
        //通过命令执行可以执行定时
        App\Console\Commands\PushEmailCampaign::class,*/

    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
       // * * * * * /usr/local/bin/php /data/wwwroot/default/laravel_test/artisan schedule:run >> /dev/null 2>&1
//         $schedule->command('inspire')
//                  ->hourly();
        //$filePath = __DIR__.mt_rand(0,1000);->sendOutputTo($filePath)
        $schedule->command('testconsole')->everyMinute()->appendOutputTo('test.txt');
        $schedule->call(function(){
            $data = [
                'username'   => 'TSET_'.mt_rand(1000,9999),
                'sex'        => mt_rand(0,1),
                'age'        => mt_rand(10,99),
                'class'      => '三年级'.mt_rand(1,10).'班',
                'hobby'      => '打球，写字，散步'.mt_rand(0,10000),
                'email'      => '15398533'.mt_rand(10,99).'@qq.com',
                'mobile'     => '15971896'.mt_rand(100,999),
                'updatetime' => time(),
                'createtime' => time(),
            ];

            (new Test())->create($data);
        })->everyTenMinutes()->between('20:00', '23:00');
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
