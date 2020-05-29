<?php
/**
 * 
 */

return [


    /**
     * Roles that super admins can assign other admins to on the admin edit page.
     * If left empty, all admins will be assigned to the default level of "admin".
     *
     * @var array
     */
    'roles' => [
        // 'super' => '<b>Super admin</b> - Can manage all content.',
        // 'general' => '<b>General</b> - Can manage sub pages of services and buildings (except for forms).',
        // 'forms' => '<b>Forms</b> - Can do everything a general admin can but can also manage forms.',
    ],

    /**
     * Permissions rules.  These are described in more detail in the README.
     *
     * @var array
     */
    'permissions' => [
        // 'general' => [
        //     'cant' => [
        //         'create.categories',
        //         'destroy.categories',
        //         'manage.slides',
        //         'manage.sub-categories',
        //         'manage.forms',
        //     ],
        // ],
    ],

];

