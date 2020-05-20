<?php

declare(strict_types=1);

namespace Facilitador\Console\Commands\System;

use Illuminate\Console\Command;

class RollbackCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitec:facilitador:rollback:attributes {--force : Force the operation to run when in production.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Rollback Facilitador Attributes Tables.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $this->alert($this->description);

        if (file_exists($path = 'database/migrations/facilitador/laravel-attributes')) {
            $this->call(
                'migrate:reset', [
                '--step' => true,
                '--path' => $path,
                '--force' => $this->option('force'),
                ]
            );
        } else {
            $this->warn('No migrations found! Consider publish them first: <fg=green>php artisan facilitador:publish:attributes</>');
        }

        $this->line('');
    }
}
