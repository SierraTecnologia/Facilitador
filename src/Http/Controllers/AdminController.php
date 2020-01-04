<?php

namespace Facilitador\Http\Controllers;

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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $models = $this->facilitadorService->getModelServicesToArray(); //->sortByDesc('field', [], true);
        $models = $models->reject(function ($item) {
            return empty($item['count']);
        })->SortByDesc('count');
dd($models);
        $htmlGenerator = new \Facilitador\Generators\FacilitadorGenerator($this->facilitadorService);
        
        return view(
            'facilitador::dash.home',
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
            'facilitador::dash.search',
            compact('registros')
        );
    }
}
