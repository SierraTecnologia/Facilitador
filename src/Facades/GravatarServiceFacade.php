<?php

namespace Facilitador\Facades;

use Illuminate\Support\Facades\Facade;

class GravatarServiceFacade extends Facade
{

    const DEFAULT_404        = '404';
    const DEFAULT_RETRO      = 'retro';
    const DEFAULT_BLANK      = 'blank';
    const DEFAULT_WAVATAR    = 'wavatar';
    const DEFAULT_MONSTERID  = 'monsterid';
    const DEFAULT_IDENTICON  = 'identicon';
    const DEFAULT_MYSTERYMAN = 'mm';

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'GravatarService';
    }

} 