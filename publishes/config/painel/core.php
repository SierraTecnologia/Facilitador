<?php

return [

    /**
     * The name of the site is shown in the header of all pages
     *
     * @var string
     */
    'name' => \Illuminate\Support\Facades\Config::get('app.name', 'SiravelAdmin'),


    /**
     * Automatically apply localization options to all models that at the root
     * level in the nav.  The thinking is that a site that is localized should
     * have everything localized but that children will inherit the localization
     * preference from a parent.
     *
     * @var boolean
     */
    'auto_localize_root_models' => true,

    /**
     * Store an entry in the database of all model changes.  Also see the
     * shouldLogChange() function that can be overriden per-model
     *
     * @var boolean
     */
    'log_changes' => true,

];
