<?php

namespace Facilitador\Http\Controllers\RiCa;

use Facilitador\Services\FacilitadorService;
use Facilitador\Http\Controllers\Controller as BaseController;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Pedreiro\Events\FileDeleted;
use Pedreiro\Elements\ContentTypes\Checkbox;
use Pedreiro\Elements\ContentTypes\Coordinates;
use Pedreiro\Elements\ContentTypes\File;
use Pedreiro\Elements\ContentTypes\Image as ContentImage;
use Pedreiro\Elements\ContentTypes\MultipleCheckbox;
use Pedreiro\Elements\ContentTypes\MultipleImage;
use Pedreiro\Elements\ContentTypes\Password;
use Pedreiro\Elements\ContentTypes\Relationship;
use Pedreiro\Elements\ContentTypes\SelectMultiple;
use Pedreiro\Elements\ContentTypes\Text;
use Pedreiro\Elements\ContentTypes\Timestamp;
use Facilitador\Traits\AlertsMessages;
use Validator;

class Controller extends BaseController
{

}