<?php

namespace Facilitador\Widgets;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Facilitador\Facades\Facilitador;

class UserDimmer extends BaseDimmer
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     *
     * @return \Illuminate\View\View
     */
    public function run(): \Illuminate\View\View
    {
        $count = Facilitador::model('User')->count();
        $string = trans_choice('facilitador::dimmer.user', $count);

        return view(
            'facilitador::dimmer', array_merge(
                $this->config, [
                'icon'   => 'facilitador-group',
                'title'  => "{$count} {$string}",
                'text'   => __('facilitador::dimmer.user_text', ['count' => $count, 'string' => Str::lower($string)]),
                'button' => [
                'text' => __('facilitador::dimmer.user_link_text'),
                'link' => route('facilitador.users.index'),
                ],
                'image' => facilitador_asset('images/widget-backgrounds/01.jpg'),
                ]
            )
        );
    }

    /**
     * Determine if the widget should be displayed.
     *
     * @return bool
     */
    public function shouldBeDisplayed()
    {
        return Auth::user()->can('browse', Facilitador::model('User'));
    }
}
