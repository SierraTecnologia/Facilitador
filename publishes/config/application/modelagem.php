<?php

return [

    'models' => [
        /*
        |--------------------------------------------------------------------------
        | Alias Blacklist
        |--------------------------------------------------------------------------
        |
        | Typically, Tinker automatically aliases classes as you require them in
        | Tinker. However, you may wish to never alias certain classes, which
        | you may accomplish by listing the classes in the following array.
        |
        */
        'importants' => [
            'persons' => \Telefonica\Models\Actors\Person::class,
        ],
        'attributes' => [
            'attribute' => \Pedreiro\Models\Attribute::class,
            'attribute_entity' => \Facilitador\Models\AttributeEntity::class,
        ],
    ],
    
    /**
     * Dont Audit Models
     */
    'dontLog' => [
        \Aschmelyun\Larametrics\Models\LarametricsLog::class,
        \Illuminate\Database\Eloquent\Relations\Pivot::class,
    ],
    'dontLogAlias' => [
        'Tracking\Models',
        'Analytics',
        'Activitys',
        'Spatie\Analytics',
        'Spatie\Activitylog\Models',
        'Wnx\LaravelStats',
        'Aschmelyun\Larametrics\Models',
        'Laravel\Horizon',
        'Support\Models\Application',
        'Support\Models\Ardent',
        'Support\Models\Code',
    ],

];