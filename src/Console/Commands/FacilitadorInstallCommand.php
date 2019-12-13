<?php

namespace Facilitador\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Intervention\Image\ImageServiceProviderLaravel5;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Process\Process;
use Facilitador\FacilitadorProvider;

class FacilitadorInstallCommand extends Command
{
    protected $userModelFile = 'Models/User.php';
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'facilitador:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the Facilitador Admin package';

    protected function getOptions()
    {
        return [
            ['force', null, InputOption::VALUE_NONE, 'Force the operation to run when in production', null],
            // ['with-dummy', null, InputOption::VALUE_NONE, 'Install with dummy data', null],
        ];
    }

    /**
     * Get the composer command for the environment.
     *
     * @return string
     */
    protected function findComposer()
    {
        if (file_exists(getcwd().'/composer.phar')) {
            return '"'.PHP_BINARY.'" '.getcwd().'/composer.phar';
        }

        return 'composer';
    }

    public function fire(Filesystem $filesystem)
    {
        return $this->handle($filesystem);
    }

    /**
     * Execute the console command.
     *
     * @param \Illuminate\Filesystem\Filesystem $filesystem
     *
     * @return void
     */
    public function handle(Filesystem $filesystem)
    {
        $this->info('Publishing the Facilitador assets, database, and config files');

        // Publish only relevant resources on install
        $tags = ['sitec'];

        $this->call('vendor:publish', ['--tag' => $tags]);
        // $this->call('vendor:publish', ['--provider' => FacilitadorServiceProvider::class, '--tag' => $tags]);
        $this->call('vendor:publish', ['--provider' => ImageServiceProviderLaravel5::class]);

        $this->info('Migrating the database tables into your application');
        $this->call('migrate', ['--force' => $this->option('force')]);

        $this->info('Attempting to set Facilitador User model as parent to App\User');
        if (file_exists(app_path($this->userModelFile))) {
            $str = file_get_contents(app_path($this->userModelFile));

            if ($str !== false) {
                $str = str_replace('extends Authenticatable', "extends \Facilitador\Models\User", $str);

                file_put_contents(app_path($this->userModelFile), $str);
            }
        } else {
            $this->warn('Unable to locate "app/Models/User.php".  Did you move this file?');
            $this->warn('You will need to update this manually.  Change "extends Authenticatable" to "extends \Facilitador\Models\User" in your User model');
        }

        $this->info('Dumping the autoloaded files and reloading all new files');

        $composer = $this->findComposer();

        $process = new Process($composer.' dump-autoload');
        $process->setTimeout(null); // Setting timeout to null to prevent installation from stopping at a certain point in time
        $process->setWorkingDirectory(base_path())->run();

        $this->info('Adding Facilitador routes to routes/web.php');
        $routes_contents = $filesystem->get(base_path('routes/web.php'));
        if (false === strpos($routes_contents, 'Facilitador::routes()')) {
            $filesystem->append(
                base_path('routes/web.php'),
                "\n\nRoute::group(['prefix' => 'admin'], function () {\n    Facilitador::routes();\n});\n"
            );
        }

        \Route::group(['prefix' => 'admin'], function () {
            \Facilitador::routes();
        });

        // $this->info('Seeding data into the database');
        // $this->seed('FacilitadorDatabaseSeeder');

        // if ($this->option('with-dummy')) {
        //     $this->info('Publishing dummy content');
        //     $tags = ['dummy_seeds', 'dummy_content', 'dummy_config', 'dummy_migrations'];
        //     $this->call('vendor:publish', ['--provider' => FacilitadorDummyServiceProvider::class, '--tag' => $tags]);

        //     $this->info('Migrating dummy tables');
        //     $this->call('migrate');

        //     $this->info('Seeding dummy data');
        //     $this->seed('FacilitadorDummyDatabaseSeeder');
        // } else {
        //     $this->call('vendor:publish', ['--provider' => FacilitadorServiceProvider::class, '--tag' => ['config', 'voyager_avatar']]);
        // }

        $this->info('Setting up the hooks');
        $this->call('hook:setup');

        $this->info('Adding the storage symlink to your public folder');
        $this->call('storage:link');

        $this->info('Creating admin');
        $this->call('facilitador:admin');

        $this->info('Successfully installed Facilitador! Enjoy');
    }
}