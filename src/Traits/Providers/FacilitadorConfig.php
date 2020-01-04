<?php

namespace Facilitador\Traits\Providers;

use Config;

trait FacilitadorConfig
{
    

    /****************************************************************************************************
     ************************************************** NO BOOT *************************************
     ****************************************************************************************************/

    /**
     * Config Former
     *
     * @return void
     */
    protected function configureFormer()
    {
        // Use Bootstrap 3
        Config::set('former.framework', 'TwitterBootstrap3');

        // Reduce the horizontal form's label width
        Config::set('former.TwitterBootstrap3.labelWidths', []);

        // Change Former's required field HTML
        Config::set('former.required_text', ' <span class="glyphicon glyphicon-exclamation-sign js-tooltip required" title="' .
            __('facilitador::login.form.required') . '"></span>');

        // Make pushed checkboxes have an empty string as their value
        Config::set('former.unchecked_value', '');

        // Add Decoy's custom Fields to Former so they can be invoked using the "Former::"
        // namespace and so we can take advantage of sublassing Former's Field class.
        $this->app['former.dispatcher']->addRepository('Facilitador\\Fields\\');
    }

    

    /****************************************************************************************************
     ************************************************** NO REGISTER *************************************
     ****************************************************************************************************/
}
