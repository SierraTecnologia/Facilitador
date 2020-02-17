<?php

namespace Facilitador\Listeners;

use Facilitador\Events\BreadDeleted;
use Facilitador\Facades\Facilitador;

class DeleteBreadMenuItem
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
     * Delete a MenuItem for a given BREAD.
     *
     * @param BreadDeleted $bread
     *
     * @return void
     */
    public function handle(BreadDeleted $bread)
    {
        if (config('facilitador.bread.add_menu_item')) {
            $menuItem = Facilitador::model('MenuItem')->where('route', 'facilitador.'.$bread->dataType->slug.'.index');

            if ($menuItem->exists()) {
                $menuItem->delete();
            }
        }
    }
}
