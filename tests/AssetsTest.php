<?php

namespace Facilitador\Tests;

use Illuminate\Support\Facades\Auth;

class AssetsTest extends TestCase
{
    protected $prefix = '/facilitador-assets?path=';

    protected function setUp(): void: void
    {
        parent::setUp();

        Auth::loginUsingId(1);
    }

    public function testCanOpenFileInAssets()
    {
        $url = route('rica.dashboard').$this->prefix.'css/app.css';

        $response = $this->call('GET', $url);
        $this->assertEquals(200, $response->status(), $url.' did not return a 200');
    }

    public function urlProvider()
    {
        return [
            [
                '../dummy_content/pages/page1.jpg',
                '..../dummy_content/pages/page1.jpg',
                'images/../../dummy_content/pages/page1.jpg',
                '....//dummy_content/pages/page1.jpg',
                '..\dummy_content/pages/page1.jpg',
                '....\dummy_content/pages/page1.jpg',
                'images/..\..\dummy_content/pages/page1.jpg',
                'images/....\\....\\dummy_content/pages/page1.jpg',
            ],
        ];
    }

    /**
     * @dataProvider urlProvider
     */
    public function testCannotOpenFileOutsideAssets($url)
    {
        $response = $this->call('GET', route('rica.dashboard').$this->prefix.$url);
        $this->assertEquals(404, $response->status(), $url.' did not return a 404');
    }
}
