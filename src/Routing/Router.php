<?php

namespace Facilitador\Routing;

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
            'middleware' => 'facilitador.public',
        ], function () {
            $this->registerLogin();
            $this->registerResetPassword();
        });

        // Routes that don't require auth or CSRF
        Route::group([
            'prefix' => $this->dir,
            'middleware' => 'facilitador.endpoint',
        ], function () {
            $this->registerExternalEndpoints();
        });

        // Protected, admin routes
        Route::group([
            'prefix' => $this->dir,
            'middleware' => 'facilitador.protected',
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
            'as' => 'facilitador::account@login',
            'uses' => '\Facilitador\Http\Controllers\Decoy\Login@showLoginForm',
        ]);

        Route::post('/', [
            'as' => 'facilitador::account@postLogin',
            'uses' => '\Facilitador\Http\Controllers\Decoy\Login@login',
        ]);

        Route::get('logout', [
            'as' => 'facilitador::account@logout',
            'uses' => '\Facilitador\Http\Controllers\Decoy\Login@logout',
        ]);
    }

    /**
     * Reset password routes
     *
     * @return void
     */
    public function registerResetPassword()
    {
        Route::get('forgot', ['as' => 'facilitador::account@forgot',
            'uses' => '\Facilitador\Http\Controllers\Decoy\ForgotPassword@showLinkRequestForm',
        ]);

        Route::post('forgot', ['as' => 'facilitador::account@postForgot',
            'uses' => '\Facilitador\Http\Controllers\Decoy\ForgotPassword@sendResetLinkEmail',
        ]);

        Route::get('password/reset/{code}', ['as' => 'facilitador::account@reset',
            'uses' => '\Facilitador\Http\Controllers\Decoy\ResetPassword@showResetForm',
        ]);

        Route::post('password/reset/{code}', ['as' => 'facilitador::account@postReset',
            'uses' => '\Facilitador\Http\Controllers\Decoy\ResetPassword@reset',
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
        Route::any('{path}', ['as' => 'facilitador::wildcard', function ($path) {

            // Remember the detected route
            App::make('events')->listen('wildcard.detection', function ($controller, $action) {
                $this->action($controller.'@'.$action);
            });

            // Do the detection
            $router = App::make('facilitador.wildcard');
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
            'as' => 'facilitador::admins@disable',
            'uses' => '\Facilitador\Http\Controllers\Decoy\Admins@disable',
        ]);

        Route::get('admins/{id}/enable', [
            'as' => 'facilitador::admins@enable',
            'uses' => '\Facilitador\Http\Controllers\Decoy\Admins@enable',
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
            'as' => 'facilitador::commands',
            'uses' => '\Facilitador\Http\Controllers\Decoy\Commands@index',
        ]);

        Route::post('commands/{command}', [
            'as' => 'facilitador::commands@execute',
            'uses' => '\Facilitador\Http\Controllers\Decoy\Commands@execute',
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
            'as' => 'facilitador::workers',
            'uses' => '\Facilitador\Http\Controllers\Decoy\Workers@index',
        ]);

        Route::get('workers/tail/{worker}', [
            'as' => 'facilitador::workers@tail',
            'uses' => '\Facilitador\Http\Controllers\Decoy\Workers@tail',
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
            'as' => 'facilitador::encode@progress',
            'uses' => '\Facilitador\Http\Controllers\Decoy\Encoder@progress',
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
            'as' => 'facilitador::elements@field',
            'uses' => '\Facilitador\Http\Controllers\Decoy\Elements@field',
        ]);

        Route::post('elements/field/{key}', [
            'as' => 'facilitador::elements@field-update',
            'uses' => '\Facilitador\Http\Controllers\Decoy\Elements@fieldUpdate',
        ]);

        Route::get('elements/{locale?}/{tab?}', [
            'as' => 'facilitador::elements',
            'uses' => '\Facilitador\Http\Controllers\Decoy\Elements@index',
        ]);

        Route::post('elements/{locale?}/{tab?}', [
            'as' => 'facilitador::elements@store',
            'uses' => '\Facilitador\Http\Controllers\Decoy\Elements@store',
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
        Route::post('redactor', '\Facilitador\Http\Controllers\Decoy\Redactor@store');
    }

    /**
     * Web service callback endpoints
     *
     * @return void
     */
    public function registerExternalEndpoints()
    {
        Route::post('encode/notify', [
            'as' => 'facilitador::encode@notify',
            'uses' => '\Facilitador\Http\Controllers\Decoy\Encoder@notify',
        ]);
    }

    /**
     * Set and get the action for this request
     *
     * @return string '\Facilitador\Http\Controllers\Decoy\Account@forgot'
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
