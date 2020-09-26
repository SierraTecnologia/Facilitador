<?php

namespace Facilitador\Widgets;

use Arrilot\Widgets\AbstractWidget;

abstract class BaseDimmer extends AbstractWidget
{
    /**
     * Determine if the widget should be displayed.
     *
     * @return true
     */
    public function shouldBeDisplayed()
    {
        return true;
    }
}
