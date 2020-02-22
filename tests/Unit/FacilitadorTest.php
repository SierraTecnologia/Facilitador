<?php

namespace Facilitador\Tests\Unit;

use Illuminate\Support\Facades\Config;
use Facilitador\Facades\Facilitador;
use Facilitador\Tests\TestCase;

class FacilitadorTest extends TestCase
{
    /**
     * Dimmers returns collection of widgets.
     *
     * This test will make sure that the dimmers method will give us a
     * collection of the configured widgets.
     */
    public function testDimmersReturnsCollectionOfConfiguredWidgets()
    {
        Config::set('facilitador.dashboard.widgets', [
            'Facilitador\\Tests\\Stubs\\Widgets\\AccessibleDimmer',
            'Facilitador\\Tests\\Stubs\\Widgets\\AccessibleDimmer',
        ]);

        $dimmers = Facilitador::dimmers();

        $this->assertEquals(2, $dimmers->count());
    }

    /**
     * Dimmers returns collection of widgets which should be displayed.
     *
     * This test will make sure that the dimmers method will give us a
     * collection of the configured widgets which also should be displayed.
     */
    public function testDimmersReturnsCollectionOfConfiguredWidgetsWhichShouldBeDisplayed()
    {
        Config::set('facilitador.dashboard.widgets', [
            'Facilitador\\Tests\\Stubs\\Widgets\\AccessibleDimmer',
            'Facilitador\\Tests\\Stubs\\Widgets\\InAccessibleDimmer',
            'Facilitador\\Tests\\Stubs\\Widgets\\InAccessibleDimmer',
        ]);

        $dimmers = Facilitador::dimmers();

        $this->assertEquals(1, $dimmers->count());
    }
}
