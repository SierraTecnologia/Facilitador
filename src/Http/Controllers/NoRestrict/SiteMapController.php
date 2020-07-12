<?php

namespace Facilitador\Http\Controllers\NoRestrict;

use Siravel\Services\SiravelService;
use Illuminate\Http\Response;

class SiteMapController extends Controller
{
    protected $service;

    public function __construct(SiravelService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    public function index()
    {
        $items = $this->service->collectSiteMapItems();

        $contents = view('site-map', compact('items'));

        return new Response(
            $contents, 200, [
            'Content-Type' => 'application/xml;charset=UTF-8',
            ]
        );
    }
}
