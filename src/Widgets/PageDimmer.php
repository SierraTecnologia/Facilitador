<?php

namespace Facilitador\Widgets;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Facilitador\Facades\Facilitador;

class PageDimmer extends BaseDimmer
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
     */
    public function run()
    {
        $count = Facilitador::model('Page')->count();
        $string = trans_choice('facilitador::dimmer.page', $count);

        return view(
            'facilitador::dimmer', array_merge(
                $this->config, [
                'icon'   => 'facilitador-file-text',
                'title'  => "{$count} {$string}",
                'text'   => __('pedreiro::dimmer.page_text', ['count' => $count, 'string' => Str::lower($string)]),
                'button' => [
                'text' => __('pedreiro::dimmer.page_link_text'),
                'link' => route('facilitador.pages.index'),
                ],
                'image' => facilitador_asset('images/widget-backgrounds/03.jpg'),
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
        return Auth::user()->can('browse', Facilitador::model('Page'));
    }
}
