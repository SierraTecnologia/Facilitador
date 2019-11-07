<?php

/**
 * Created by Cristian.
 * Date: 11/09/16 09:26 PM.
 */

namespace Facilitador\Support\Reliese\Coders\Model\Relations;

use Illuminate\Support\Fluent;
use Facilitador\Support\Reliese\Coders\Model\Model;
use Facilitador\Support\Reliese\Coders\Model\Relation;

class HasOneOrManyStrategy implements Relation
{
    /**
     * @var \Facilitador\Support\Reliese\Coders\Model\Relation
     */
    protected $relation;

    /**
     * HasManyWriter constructor.
     *
     * @param \Illuminate\Support\Fluent $command
     * @param \Facilitador\Support\Reliese\Coders\Model\Model $parent
     * @param \Facilitador\Support\Reliese\Coders\Model\Model $related
     */
    public function __construct(Fluent $command, Model $parent, Model $related)
    {
        if (
            $related->isPrimaryKey($command) ||
            $related->isUniqueKey($command)
        ) {
            $this->relation = new HasOne($command, $parent, $related);
        } else {
            $this->relation = new HasMany($command, $parent, $related);
        }
    }

    /**
     * @return string
     */
    public function hint()
    {
        return $this->relation->hint();
    }

    /**
     * @return string
     */
    public function name()
    {
        return $this->relation->name();
    }

    /**
     * @return string
     */
    public function body()
    {
        return $this->relation->body();
    }
}
