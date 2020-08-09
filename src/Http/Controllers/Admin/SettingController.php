<?php

namespace Facilitador\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Siravel\Http\Requests\Admin\SettingRequest;
use Facilitador\Models\Setting;

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

        return view('admin.settings.index', compact('settings', 'otherOptions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function configure($slugSetting)
    {
        $settingInstance = Setting::where('slug', $slugSetting)->first();
        $settingRules = Setting::settingsForNegocios()[$slugSetting];

        return view('admin.settings.configure', compact('settingInstance', 'settingRules', 'slugSetting'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($slugSetting, SettingRequest $request)
    {
        if ($settingInstance = Setting::where('slug', $slugSetting)->first()){
            $settingInstance->update([
                'value'       => $request->value
            ]);
        } else {
            Setting::create([
                'slug'       => $slugSetting,
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
