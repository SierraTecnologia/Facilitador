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

    'models_alias' => [
        'App\Models',
        // 'Support\Models',
        'Porteiro\Models',
        'Pedreiro\Models',

        'Informate\Models',
        'Translation\Models',
        'Locaravel\Models',
        'Population\Models',
        'Telefonica\Models',
        'MediaManager\Models',
        'Stalker\Models',
        'Audit\Models',
        'Tracking\Models',

        'Integrations\Models',
        'Transmissor\Models',
        'Market\Models',
        'Bancario\Models',
        'Operador\Models',
        'Fabrica\Models',
        'Finder\Models',
        'Casa\Models',

        'Trainner\Models',
        'Gamer\Models',

        'Facilitador\Models',
        'Siravel\Models',
        'Boravel\Models',
        'Socrates\Models',
    ],

];

