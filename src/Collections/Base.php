<?php

namespace Facilitador\Collections;

use Illuminate\Database\Eloquent\Collection;
use Facilitador\Models\Decoy\Traits\SerializeWithImages;
use Facilitador\Models\Decoy\Traits\CanSerializeTransform;

/**
 * The collection that is returned from queries on models that extend from
 * Decoy's base model.  Adds methods to tweak the serialized output
 */
class Base extends Collection
{
    use CanSerializeTransform,
        SerializeWithImages;
}
