<?php

namespace Facilitador\Http\Controllers\RiCa;

use Exception;
use Facilitador\Facades\Facilitador;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Pedreiro\Http\Controllers\Admin\PedreiroBaseController as BaseController;
use Support\Components\Database\Schema\SchemaManager;
use Support\Events\BreadDataAdded;
use Support\Events\BreadDataDeleted;
use Support\Events\BreadDataRestored;
use Support\Events\BreadDataUpdated;
use Support\Events\BreadImagesDeleted;

/**
 * The base controller is gives Decoy most of the magic/for-free mojo
 * It's not abstract because it can't be instantiated with PHPUnit like that
 */
class FacilitadorBaseController extends BaseController
{
}
