<?php

namespace Facilitador\Traits\Providers;

use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

trait AppEventsProvider
{
    /****************************************************************************************************
     * ************************************************* NO REGISTER *************************************
     ****************************************************************************************************/


    /****************************************************************************************************
     * ************************************************* NO BOOT *************************************
     ****************************************************************************************************/

    /**
     * Delegate events to Decoy observers
     *
     * @return void
     */
    protected function delegateAdminObservers()
    {
        $this->app['events']->listen(
            'facilitador::model.validating:*',
            '\Facilitador\Observers\ValidateExistingFiles@onValidating'
        );
    }


    protected function bootEvents(Dispatcher $events): void
    {


        // Wire up model event callbacks even if request is not for admin.  Do this
        // after the usingAdmin call so that the callbacks run after models are
        // mutated by Decoy logic.  This is important, in particular, so the
        // Validation observer can alter validation rules before the onValidation
        // callback runs.
        $this->app['events']->listen(
            'eloquent.*',
            'Facilitador\Observers\ModelCallbacks'
        );
        $this->app['events']->listen(
            'facilitador::model.*',
            'Facilitador\Observers\ModelCallbacks'
        );
    }
}
