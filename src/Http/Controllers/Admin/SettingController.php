<?php

namespace Facilitador\Http\Controllers\Admin;

use Facilitador\Models\Setting;
use Illuminate\Http\Request;
use Siravel\Http\Requests\Admin\SettingRequest;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = Setting::all();
        $otherOptions = Setting::settingsForNegocios();

        foreach ($settings as $setting) {
            unset($otherOptions[$setting->code]);
        }

        return view('admin.settings.index', compact('settings', 'otherOptions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function configure($codeSetting)
    {
        $settingInstance = Setting::where('code', $codeSetting)->first();
        $settingRules = Setting::settingsForNegocios()[$codeSetting];

        return view('admin.settings.configure', compact('settingInstance', 'settingRules', 'codeSetting'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($codeSetting, SettingRequest $request)
    {
        if ($settingInstance = Setting::where('code', $codeSetting)->first()){
            $settingInstance->update([
                'value'       => $request->value
            ]);
        } else {
            Setting::create([
                'code'       => $codeSetting,
                'value'       => $request->value
            ]);
        }

        flash()->overlay('Setting configure successfully.');
        return redirect('/admin/settings');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        $setting->delete();
        flash()->overlay('Setting deleted successfully.');

        return redirect('/admin/settings');
    }
}
