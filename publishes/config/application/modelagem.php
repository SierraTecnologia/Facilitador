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
            'persons' => \Population\Models\Identity\Actors\Person::class,
        ],
        'attributes' => [
            'attribute' => \Facilitador\Models\Attribute::class,
            'attribute_entity' => \Facilitador\Models\AttributeEntity::class,
        ],
    ],
    
    /**
     * 
     */
];