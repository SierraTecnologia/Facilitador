<?php

namespace Facilitador\Tests;

use Illuminate\Support\Facades\Auth;
use Facilitador\Models\Setting;

class SettingsTest extends TestCase
{
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = Auth::loginUsingId(1);
        session()->setPreviousUrl(route('rica.facilitador.settings.index'));
    }

    public function testCanUpdateSettings()
    {
        $key = 'site.title';
        $newTitle = 'Just Another LaravelFacilitador.com Site';

        $this->visit(route('rica.facilitador.settings.index'))
            ->seeInField($key, Setting::where('key', '=', $key)->first()->value)
            ->type($newTitle, $key)
            ->seeInElement('button', __('pedreiro::settings.save'))
            ->press(__('pedreiro::settings.save'))
            ->seePageIs(route('rica.facilitador.settings.index'))
            ->seeInDatabase(
                'settings', [
                'key'   => $key,
                'value' => $newTitle,
                 ]
            );
    }

    public function testCanCreateSetting()
    {
        $this->visitRoute('rica.facilitador.settings.index')
            ->type('New Setting', 'display_name')
            ->type('new_setting', 'key')
            ->select('text', 'type')
            ->select('Site', 'group')
            ->press(__('pedreiro::settings.add_new'))
            ->seePageIs(route('rica.facilitador.settings.index'))
            ->seeInDatabase(
                'settings', [
                'display_name' => 'New Setting',
                'key'          => 'site.new_setting',
                'type'         => 'text',
                'group'        => 'Site',
                 ]
            );
    }

    public function testCanDeleteSetting()
    {
        $setting = Setting::firstOrFail();

        $this->call('DELETE', route('rica.facilitador.settings.delete', ['id' => $setting->setting_key]));

        $this->notSeeInDatabase(
            'settings', [
            'setting_key'    => $setting->setting_key,
            ]
        );
    }

    public function testCanDeleteSettingsValue()
    {
        $setting = Setting::firstOrFail();
        $this->assertFalse(Setting::find($setting->setting_key)->value == null);

        $this->call('PUT', route('rica.facilitador.settings.delete_value', ['id' => $setting->setting_key]));

        $this->seeInDatabase(
            'settings', [
            'setting_key'    => $setting->isetting_key,
            'value' => '',
            ]
        );
    }

    public function testCanMoveSettingUp()
    {
        $setting = Setting::where('order', '!=', 1)->first();

        $this->call('GET', route('rica.facilitador.settings.move_up', ['id' => $setting->setting_key]));

        $this->seeInDatabase(
            'settings', [
            'setting_key'    => $setting->setting_key,
            'order' => ($setting->order - 1),
            ]
        );
    }

    public function testCanMoveSettingDown()
    {
        $setting = Setting::where('order', '!=', 1)->first();

        $this->call('GET', route('rica.facilitador.settings.move_down', ['id' => $setting->setting_key]));

        $this->seeInDatabase(
            'settings', [
            'setting_key'    => $setting->setting_key,
            'order' => ($setting->order + 1),
            ]
        );
    }
}
