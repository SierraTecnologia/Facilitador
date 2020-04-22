<?php

namespace Facilitador\Listeners;

use Facilitador\Events\BreadAdded;
use Facilitador\Facades\Facilitador;

class AddBreadMenuItem
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Create a MenuItem for a given BREAD.
     *
     * @param BreadAdded $event
     *
     * @return void
     */
    public function handle(BreadAdded $bread)
    {
        if (config('sitec.facilitador.bread.add_menu_item') && file_exists(base_path('routes/web.php'))) {
            $menu = Facilitador::model('Menu')->where('name', config('sitec.facilitador.bread.default_menu'))->firstOrFail();

            $menuItem = Facilitador::model('MenuItem')->firstOrNew([
                'menu_id' => $menu->id,
                'title'   => $bread->dataType->getTranslatedAttribute('display_name_plural'),
                'url'     => '',
                'route'   => 'facilitador.'.$bread->dataType->slug.'.index',
            ]);

            $order = Facilitador::model('MenuItem')->highestOrderMenuItem();

            if (!$menuItem->exists) {
                $menuItem->fill([
                    'target'     => '_self',
                    'icon_class' => $bread->dataType->icon,
                    'color'      => null,
                    'parent_id'  => null,
                    'order'      => $order,
                ])->save();
            }
        }
    }
}
