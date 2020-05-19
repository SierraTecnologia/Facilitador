<?php

namespace Facilitador\Http\Controllers\System;

use App\Http\Requests;
use App\Models\Admin;
use App\Models\Banner;
use App\Models\Link;
use App\Models\ActiveUser;
use App\Models\HotTopic;
use App\Models\Image;
use Illuminate\Http\Request;
use Auth;
use Population\Models\Identity\Actors;

class AdminController extends Controller
{
    /**
     * Controller Class ou array
     */
    public $topBarParent = [
        'name' => 'Inicio',
        'url' => '/',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $models = $this->facilitadorService->getModelServicesToArray(false); //->sortByDesc('field', [], true);
        
        dd($models);
        
        $models = $models->reject(
            function ($item) {
                return false;
                // return empty($item['count']);
            }
        )->SortByDesc('count')
        ->groupBy('group_type');
        $htmlGenerator = new \Facilitador\Generators\FacilitadorGenerator($this->facilitadorService);
        // dd($models, 'Debug AdminController');
        return view(
            'facilitador::components.dash.home',
            compact('models', 'htmlGenerator')
        );
    }

    /**
     * Display a listing of the resource searched.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {

        $registros = $this->facilitadorService->search($request->user()->id, $request->search);

        return view(
            'facilitador::components.dash.search',
            compact('registros')
        );
    }
}
