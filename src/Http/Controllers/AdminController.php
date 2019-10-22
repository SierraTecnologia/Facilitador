<?php

namespace Siravel\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Banner;
use App\Models\Link;
use App\Models\ActiveUser;
use App\Models\HotTopic;
use App\Models\Image;
use Illuminate\Http\Request;
use Auth;
use Siravel\Models\Identity\Person;

class AdminController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($modulo, Request $request)
    {
        // $fcode
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($modulo, Request $request)
    {
        $modulos = [
            'persons' => Person::class,
        ];

        $loadClass = $modulos[$modulo];

        return (new \SierraTecnologia\Facilitador\Http\Controllers\Universal\RepositoryController(
            new \SierraTecnologia\Facilitador\Services\RepositoryService($loadClass)
        ))->index($request);
    }

}
