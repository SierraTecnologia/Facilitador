<?php

namespace Facilitador\Widgets;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Facilitador\Facades\Facilitador;

class PostDimmer extends BaseDimmer
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function run()
    {
        $count = Facilitador::model('Post')->count();
        $string = trans_choice('facilitador::dimmer.post', $count);

        return view(
            'facilitador::dimmer', array_merge(
                $this->config, [
                'icon'   => 'facilitador-news',
                'title'  => "{$count} {$string}",
                'text'   => __('pedreiro::dimmer.post_text', ['count' => $count, 'string' => Str::lower($string)]),
                'button' => [
                'text' => __('pedreiro::dimmer.post_link_text'),
                'link' => route('rica.facilitador.posts.index'),
                ],
                'image' => facilitador_asset('images/widget-backgrounds/02.jpg'),
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
        return Auth::user()->can('browse', Facilitador::model('Post'));
    }
}
