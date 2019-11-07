<?php

namespace Facilitador\Decoy\Routing;

use App;
use Route;

/**
 * This class acts as a bootstrap for setting up
 * Decoy routes
 */
class Router
{
    /**
     * Action for current wildcard request
     *
     * @var string
     */
    private $action;

    /**
     * The path "directory" of the admin.  I.e. "admin"
     *
     * @var string
     */
    private $dir;

    /**
     * Constructor
     *
     * @param string $dir The path "directory" of the admin.  I.e. "admin"
     */
    public function __construct($dir)
    {
        $this->dir = $dir;
    }

    /**
     * Register all routes
     *
     * @return void
     */
    public function registerAll()
    {
        // Public routes
        Route::group([
            'prefix' => $this->dir,
            'middleware' => 'decoy.public',
        ], function () {
            $this->registerLogin();
            $this->registerResetPassword();
        });

        // Routes that don't require auth or CSRF
        Route::group([
            'prefix' => $this->dir,
            'middleware' => 'decoy.endpoint',
        ], function () {
            $this->registerExternalEndpoints();
        });

        // Protected, admin routes
        Route::group([
            'prefix' => $this->dir,
            'middleware' => 'decoy.protected',
        ], function () {
            $this->registerAdmins();
            $this->registerCommands();
            $this->registerElements();
            $this->registerEncode();
            $this->registerRedactor();
            $this->registerWorkers();
            $this->registerWildcard(); // Must be last
        });
    }

    /**
     * Account routes
     *
     * @return void
     */
    public function registerLogin()
    {
        Route::get('/', [
            'as' => 'decoy::account@login',
            'uses' => '\Facilitador\Decoy\Controllers\Login@showLoginForm',
        ]);

        Route::post('/', [
            'as' => 'decoy::account@postLogin',
            'uses' => '\Facilitador\Decoy\Controllers\Login@login',
        ]);

        Route::get('logout', [
            'as' => 'decoy::account@logout',
            'uses' => '\Facilitador\Decoy\Controllers\Login@logout',
        ]);
    }

    /**
     * Reset password routes
     *
     * @return void
     */
    public function registerResetPassword()
    {
        Route::get('forgot', ['as' => 'decoy::account@forgot',
            'uses' => '\Facilitador\Decoy\Controllers\ForgotPassword@showLinkRequestForm',
        ]);

        Route::post('forgot', ['as' => 'decoy::account@postForgot',
            'uses' => '\Facilitador\Decoy\Controllers\ForgotPassword@sendResetLinkEmail',
        ]);

        Route::get('password/reset/{code}', ['as' => 'decoy::account@reset',
            'uses' => '\Facilitador\Decoy\Controllers\ResetPassword@showResetForm',
        ]);

        Route::post('password/reset/{code}', ['as' => 'decoy::account@postReset',
            'uses' => '\Facilitador\Decoy\Controllers\ResetPassword@reset',
        ]);
    }

    /**
     * Setup wilcard routing
     *
     * @return void
     */
    public function registerWildcard()
    {
        // Setup a wildcarded catch all route
        Route::any('{path}', ['as' => 'decoy::wildcard', function ($path) {

            // Remember the detected route
            App::make('events')->listen('wildcard.detection', function ($controller, $action) {
                $this->action($controller.'@'.$action);
            });

            // Do the detection
            $router = App::make('decoy.wildcard');
            $response = $router->detectAndExecute();
            if (is_a($response, 'Symfony\Component\HttpFoundation\Response')
                || is_a($response, 'Illuminate\View\View')) { // Possible when layout is involved
                return $response;
            } else {
                App::abort(404);
            }
        }])->where('path', '.*');
    }

    /**
     * Non-wildcard admin routes
     *
     * @return void
     */
    public function registerAdmins()
    {
        Route::get('admins/{id}/disable', [
            'as' => 'decoy::admins@disable',
            'uses' => '\Facilitador\Decoy\Controllers\Admins@disable',
        ]);

        Route::get('admins/{id}/enable', [
            'as' => 'decoy::admins@enable',
            'uses' => '\Facilitador\Decoy\Controllers\Admins@enable',
        ]);
    }

    /**
     * Commands / Tasks
     *
     * @return void
     */
    public function registerCommands()
    {
        Route::get('commands', [
            'as' => 'decoy::commands',
            'uses' => '\Facilitador\Decoy\Controllers\Commands@index',
        ]);

        Route::post('commands/{command}', [
            'as' => 'decoy::commands@execute',
            'uses' => '\Facilitador\Decoy\Controllers\Commands@execute',
        ]);
    }

    /**
     * Workers
     *
     * @return void
     */
    public function registerWorkers()
    {
        Route::get('workers', [
            'as' => 'decoy::workers',
            'uses' => '\Facilitador\Decoy\Controllers\Workers@index',
        ]);

        Route::get('workers/tail/{worker}', [
            'as' => 'decoy::workers@tail',
            'uses' => '\Facilitador\Decoy\Controllers\Workers@tail',
        ]);
    }

    /**
     * Get the status of an encode
     *
     * @return void
     */
    public function registerEncode()
    {
        Route::get('encode/{id}/progress', [
            'as' => 'decoy::encode@progress',
            'uses' => '\Facilitador\Decoy\Controllers\Encoder@progress',
        ]);
    }

    /**
     * Elements system
     *
     * @return void
     */
    public function registerElements()
    {
        Route::get('elements/field/{key}', [
            'as' => 'decoy::elements@field',
            'uses' => '\Facilitador\Decoy\Controllers\Elements@field',
        ]);

        Route::post('elements/field/{key}', [
            'as' => 'decoy::elements@field-update',
            'uses' => '\Facilitador\Decoy\Controllers\Elements@fieldUpdate',
        ]);

        Route::get('elements/{locale?}/{tab?}', [
            'as' => 'decoy::elements',
            'uses' => '\Facilitador\Decoy\Controllers\Elements@index',
        ]);

        Route::post('elements/{locale?}/{tab?}', [
            'as' => 'decoy::elements@store',
            'uses' => '\Facilitador\Decoy\Controllers\Elements@store',
        ]);
    }

    /**
     * Upload handling for Redactor
     * @link http://imperavi.com/redactor/
     *
     * @return void
     */
    public function registerRedactor()
    {
        Route::post('redactor', '\Facilitador\Decoy\Controllers\Redactor@store');
    }

    /**
     * Web service callback endpoints
     *
     * @return void
     */
    public function registerExternalEndpoints()
    {
        Route::post('encode/notify', [
            'as' => 'decoy::encode@notify',
            'uses' => '\Facilitador\Decoy\Controllers\Encoder@notify',
        ]);
    }

    /**
     * Set and get the action for this request
     *
     * @return string '\Facilitador\Decoy\Controllers\Account@forgot'
     */
    public function action($name = null)
    {
        if ($name) {
            $this->action = $name;
        }

        if ($this->action) {
            return $this->action;
        }

        // Wildcard
        return Route::currentRouteAction();
    }
}
