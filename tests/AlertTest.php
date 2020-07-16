<?php

namespace Facilitador\Tests;

use Support\Alert;
use Facilitador\Facades\Facilitador;

class AlertTest extends TestCase
{
    public function testAlertsAreRegistered()
    {
        $alert = (new Alert('test', 'warning'))
            ->title('Title');

        Facilitador::addAlert($alert);

        $alerts = Facilitador::alerts();

        $this->assertCount(1, $alerts);
    }

    public function testComponentRenders()
    {
        Facilitador::addAlert(
            (new Alert('test', 'warning'))
                ->title('Title')
                ->text('Text')
                ->button('Button', 'http://example.com', 'danger')
        );

        $alerts = Facilitador::alerts();

        $this->assertEquals('<strong>Title</strong>', $alerts[0]->components[0]->render());
        $this->assertEquals('<p>Text</p>', $alerts[0]->components[1]->render());
        $this->assertEquals("<a href='http://example.com' class='btn btn-danger'>Button</a>", $alerts[0]->components[2]->render());
    }

    public function testAlertsRenders()
    {
        Facilitador::addAlert(
            (new Alert('test', 'warning'))
                ->title('Title')
                ->text('Text')
                ->button('Button', 'http://example.com', 'danger')
        );

        Facilitador::addAlert(
            (new Alert('foo'))
                ->title('Bar')
                ->text('Foobar')
                ->button('Link', 'http://example.org')
        );

        $this->assertXmlStringEqualsXmlFile(
            __DIR__.'/rendered_alerts.html',
            view('facilitador::alerts')->render()
        );
    }
}
