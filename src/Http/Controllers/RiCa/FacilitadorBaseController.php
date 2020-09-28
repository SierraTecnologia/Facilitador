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
use Pedreiro\Events\BreadDataAdded;
use Pedreiro\Events\BreadDataDeleted;
use Pedreiro\Events\BreadDataRestored;
use Pedreiro\Events\BreadDataUpdated;
use Pedreiro\Events\BreadImagesDeleted;

/**
 * The base controller is gives Decoy most of the magic/for-free mojo
 * It's not abstract because it can't be instantiated with PHPUnit like that
 */
class FacilitadorBaseController extends BaseController
{
}
