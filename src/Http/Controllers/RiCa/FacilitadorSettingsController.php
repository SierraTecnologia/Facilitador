<?php

namespace Facilitador\Http\Controllers\RiCa;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Facilitador\Facades\Facilitador;

class FacilitadorSettingsController extends Controller
{
    public function index(Request $request)
    {
        // Check permission
        // $this->authorize('browse', Facilitador::model('Setting'));

        $data = Facilitador::model('Setting')->orderBy('order', 'ASC')->get();

        $settings = [];
        $settings[__('pedreiro::settings.group_general')] = [];
        foreach ($data as $d) {
            if ($d->group == '' || $d->group == __('pedreiro::settings.group_general')) {
                $settings[__('pedreiro::settings.group_general')][] = $d;
            } else {
                $settings[$d->group][] = $d;
            }
        }
        if (count($settings[__('pedreiro::settings.group_general')]) == 0) {
            unset($settings[__('pedreiro::settings.group_general')]);
        }

        $groups_data = Facilitador::model('Setting')->select('group')->distinct()->get();
        $groups = [];
        foreach ($groups_data as $group) {
            if ($group->group != '') {
                $groups[] = $group->group;
            }
        }

        $active = (request()->session()->has('setting_tab')) ? request()->session()->get('setting_tab') : old('setting_tab', key($settings));

        return Facilitador::view('facilitador::settings.index', compact('settings', 'groups', 'active'));
    }

    public function store(Request $request)
    {
        // Check permission
        // $this->authorize('add', Facilitador::model('Setting'));

        $key = implode('.', [Str::slug($request->input('group')), $request->input('key')]);
        $key_check = Facilitador::model('Setting')->where('key', $key)->get()->count();

        if ($key_check > 0) {
            return back()->with(
                [
                'message'    => __('pedreiro::settings.key_already_exists', ['key' => $key]),
                'alert-type' => 'error',
                ]
            );
        }

        $lastSetting = Facilitador::model('Setting')->orderBy('order', 'DESC')->first();

        if (is_null($lastSetting)) {
            $order = 0;
        } else {
            $order = intval($lastSetting->order) + 1;
        }

        $request->merge(['order' => $order]);
        $request->merge(['value' => '']);
        $request->merge(['key' => $key]);

        Facilitador::model('Setting')->create($request->except('setting_tab'));

        request()->flashOnly('setting_tab');

        return back()->with(
            [
            'message'    => __('pedreiro::settings.successfully_created'),
            'alert-type' => 'success',
            ]
        );
    }

    public function update(Request $request)
    {
        // Check permission
        // $this->authorize('edit', Facilitador::model('Setting'));

        $settings = Facilitador::model('Setting')->all();

        foreach ($settings as $setting) {
            $content = $this->getContentBasedOnType(
                $request, 'settings', (object) [
                'type'    => $setting->type,
                'field'   => str_replace('.', '_', $setting->key),
                'group'   => $setting->group,
                ], $setting->details
            );

            if ($setting->type == 'image' && $content == null) {
                continue;
            }

            if ($setting->type == 'file' && $content == null) {
                continue;
            }

            $key = preg_replace('/^'.Str::slug($setting->group).'./i', '', $setting->key);

            $setting->group = $request->input(str_replace('.', '_', $setting->key).'_group');
            $setting->key = implode('.', [Str::slug($setting->group), $key]);
            $setting->value = $content;
            $setting->save();
        }

        request()->flashOnly('setting_tab');

        return back()->with(
            [
            'message'    => __('pedreiro::settings.successfully_saved'),
            'alert-type' => 'success',
            ]
        );
    }

    public function delete($id)
    {
        // Check permission
        // $this->authorize('delete', Facilitador::model('Setting'));

        $setting = Facilitador::model('Setting')->find($id);

        Facilitador::model('Setting')->destroy($id);

        request()->session()->flash('setting_tab', $setting->group);

        return back()->with(
            [
            'message'    => __('pedreiro::settings.successfully_deleted'),
            'alert-type' => 'success',
            ]
        );
    }

    public function move_up($id)
    {
        // Check permission
        // $this->authorize('edit', Facilitador::model('Setting'));

        $setting = Facilitador::model('Setting')->find($id);

        // Check permission
        // $this->authorize('browse', $setting);

        $swapOrder = $setting->order;
        $previousSetting = Facilitador::model('Setting')
            ->where('order', '<', $swapOrder)
            ->where('group', $setting->group)
            ->orderBy('order', 'DESC')->first();
        $data = [
            'message'    => __('pedreiro::settings.already_at_top'),
            'alert-type' => 'error',
        ];

        if (isset($previousSetting->order)) {
            $setting->order = $previousSetting->order;
            $setting->save();
            $previousSetting->order = $swapOrder;
            $previousSetting->save();

            $data = [
                'message'    => __('pedreiro::settings.moved_order_up', ['name' => $setting->display_name]),
                'alert-type' => 'success',
            ];
        }

        request()->session()->flash('setting_tab', $setting->group);

        return back()->with($data);
    }

    public function delete_value($id)
    {
        $setting = Facilitador::model('Setting')->find($id);

        // Check permission
        // $this->authorize('delete', $setting);

        if (isset($setting->id)) {
            // If the type is an image... Then delete it
            if ($setting->type == 'image') {
                if (Storage::disk(\Illuminate\Support\Facades\Config::get('sitec.facilitador.storage.disk'))->exists($setting->value)) {
                    Storage::disk(\Illuminate\Support\Facades\Config::get('sitec.facilitador.storage.disk'))->delete($setting->value);
                }
            }
            $setting->value = '';
            $setting->save();
        }

        request()->session()->flash('setting_tab', $setting->group);

        return back()->with(
            [
            'message'    => __('pedreiro::settings.successfully_removed', ['name' => $setting->display_name]),
            'alert-type' => 'success',
            ]
        );
    }

    public function move_down($id)
    {
        // Check permission
        // $this->authorize('edit', Facilitador::model('Setting'));

        $setting = Facilitador::model('Setting')->find($id);

        // Check permission
        // $this->authorize('browse', $setting);

        $swapOrder = $setting->order;

        $previousSetting = Facilitador::model('Setting')
            ->where('order', '>', $swapOrder)
            ->where('group', $setting->group)
            ->orderBy('order', 'ASC')->first();
        $data = [
            'message'    => __('pedreiro::settings.already_at_bottom'),
            'alert-type' => 'error',
        ];

        if (isset($previousSetting->order)) {
            $setting->order = $previousSetting->order;
            $setting->save();
            $previousSetting->order = $swapOrder;
            $previousSetting->save();

            $data = [
                'message'    => __('pedreiro::settings.moved_order_down', ['name' => $setting->display_name]),
                'alert-type' => 'success',
            ];
        }

        request()->session()->flash('setting_tab', $setting->group);

        return back()->with($data);
    }
}
