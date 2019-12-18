<?php

namespace Facilitador\Console\Commands\Generate;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;
use TCG\Voyager\Facades\Voyager;
use Facilitador\Models\Admin as BkwldAdmin;
use Log;

class Admin extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'facilitador:admin {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new admin. Make sure there is a user with the admin role that has all of the necessary permissions.';

    /**
     * Get user options.
     */
    protected function getOptions()
    {
        return [
            ['create', null, InputOption::VALUE_NONE, 'Create an admin user', null],
        ];
    }
    public function fire()
    {
        return $this->handle();
    }

    /**
     * Create the new admin with input from the user
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        // Get or create user @todo descomentar a opcao
        Log::info('Opção para handle');
        Log::info($this->option('create'));
        $user = $this->getUser(
            // $this->option('create')
        );
        // the user not returned
        if (!$user) {
            exit;
        }
        // Get or create role
        $role = $this->getAdministratorRole();
        // Get all permissions
        $permissions = Voyager::model('Permission')->all();
        // Assign all permissions to the admin role
        $role->permissions()->sync(
            $permissions->pluck('id')->all()
        );
        // Ensure that the user is admin
        $user->role_id = $role->id;
        $user->save();
        $this->info('The user now has full access to your site.');
    }

    /**
     * Get command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['email', InputOption::VALUE_REQUIRED, 'The email of the user.', null],
        ];
    }
    /**
     * Get the administrator role, create it if it does not exists.
     *
     * @return mixed
     */
    protected function getAdministratorRole()
    {
        $role = Voyager::model('Role')->firstOrNew([
            'name' => 'admin',
        ]);
        if (!$role->exists) {
            $role->fill([
                'display_name' => 'Administrator',
            ])->save();
        }
        return $role;
    }
    /**
     * Get or create user.
     *
     * @param bool $create
     *
     * @return \App\User
     */
    protected function getUser($create = true)
    {
        $email = $this->argument('email');
        $model = Auth::guard(app('VoyagerGuard'))->getProvider()->getModel();
        $model = Str::start($model, '\\');
        // If we need to create a new user go ahead and create it
        if ($create) {
            $name = $this->ask('Enter the admin name');
            $password = $this->secret('Enter admin password');
            $confirmPassword = $this->secret('Confirm Password');
            // Ask for email if there wasnt set one
            if (!$email) {
                $email = $this->ask('Enter the admin email');
            }

            // Check the email to see if its already being used
            while ($admin = BkwldAdmin::where('email', $email)->exists()) {
                $this->error('That email is already in use');
                $email = $this->ask('Enter the admin email');
            }

            // Passwords don't match
            while ($password != $confirmPassword) {
                $this->info("Passwords don't match");
                $password = $this->secret('Enter admin password');
                $confirmPassword = $this->secret('Confirm Password');
            }


            // Create a new admin
            $admin = new BkwldAdmin;
            $admin->first_name = $name;
            $admin->last_name = $name;
            $admin->email = $email;
            $admin->password = $password;
            // Save out the new admin
            $admin->save();

            $this->info('Creating admin account');
            return call_user_func($model.'::create', [
                'name'     => $name,
                'email'    => $email,
                'password' => Hash::make($password),
            ]);

            
        }
        return call_user_func($model.'::where', 'email', $email)->firstOrFail();

    }
}