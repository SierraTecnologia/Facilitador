<?php

namespace Facilitador\Http\Controllers\User;

use Facilitador\Http\Controllers\Controller as BaseController;

class Controller extends BaseController
{
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        parent::__construct();
    }
}
