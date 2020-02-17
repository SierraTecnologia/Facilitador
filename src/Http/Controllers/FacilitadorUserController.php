<?php

namespace Facilitador\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Facilitador\Facades\Facilitador;
use Facilitador\Routing\UrlGenerator;

class FacilitadorUserController extends FacilitadorBaseController
{
    public function profile(Request $request)
    {
        $route = '';
        $dataType = Facilitador::model('DataType')->where('model_name', Auth::guard(app('FacilitadorGuard'))->getProvider()->getModel())->first();
        if (!$dataType && app('FacilitadorGuard') == 'web') {
            $route = route('facilitador.users.edit', Auth::user()->getKey());
        } elseif ($dataType) {
            $route = UrlGenerator::managerRoute($dataType->slug, 'edit', Auth::user()->getKey());
            // $route = route('facilitador.'.$dataType->slug.'.edit', Auth::user()->getKey());
        }

        return Facilitador::view('facilitador::profile', compact('route'));
    }

    // POST BR(E)AD
    public function update(Request $request, $id)
    {
        if (Auth::user()->getKey() == $id) {
            $request->merge([
                'role_id'                              => Auth::user()->role_id,
                'user_belongstomany_role_relationship' => Auth::user()->roles->pluck('id')->toArray(),
            ]);
        }

        return parent::update($request, $id);
    }
}
