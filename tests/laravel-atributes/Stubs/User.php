<?php

declare(strict_types=1);

namespace Facilitador\Attributes\Tests\Stubs;

use Illuminate\Database\Eloquent\Model;
use Support\ClassesHelpers\Traits\Models\Attributable;

class User extends Model
{
    use Attributable;
}
