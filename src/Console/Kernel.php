<?php

namespace Facilitador\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

/**
 * Class Kernel.
 *
 * @package Console
 */
class Kernel extends ConsoleKernel
{
    public function __construct(Application $app, Dispatcher $events) {
        $this->loadCommands('Console/Commands');
        parent::__construct($app, $events);
    }
    

    /**
     * @param string $path
     * @return $this
     */
    protected function loadCommands($path) {
        $realPath = app_path($path);
        
        collect(scandir($realPath))
            ->each(function ($item) use ($path, $realPath) {
                if (in_array($item, ['.', '..'])) return;

                if (is_dir($realPath . $item)) {
                    $this->loadCommands($path . $item . '/');
                }

                if (is_file($realPath . $item)) {
                    $item = str_replace('.php', '', $item);
                    $class = str_replace('/', '\\', "Facilitador\\{$path}$item");

                    if (class_exists($class)) {
                        $this->commands[] = $class;
                    }                  
                }
            });
    }

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('horizon:snapshot')->everyFiveMinutes();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
