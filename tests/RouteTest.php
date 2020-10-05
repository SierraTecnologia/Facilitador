<?php

namespace Facilitador\Tests;

class RouteTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testGetRoutes()
    {
        $this->disableExceptionHandling();

        $this->visit(route('rica.login'));
        $this->type('admin@admin.com', 'email');
        $this->type('password', 'password');
        $this->press(__('pedreiro::generic.login'));

        $urls = [
            route('rica.dashboard'),
            route('rica.stalker.media.index'),
            route('rica.facilitador.settings.index'),
            route('facilitador.roles.index'),
            route('facilitador.roles.create'),
            route('facilitador.roles.show', 1),
            route('facilitador.roles.edit', 1),
            route('facilitador.users.index'),
            route('facilitador.users.create'),
            route('facilitador.users.show', 1),
            route('facilitador.users.edit', 1),
            route('facilitador.posts.index'),
            route('facilitador.posts.create'),
            route('facilitador.posts.show', 1),
            route('facilitador.posts.edit', 1),
            route('facilitador.pages.index'),
            route('facilitador.pages.create'),
            route('facilitador.pages.show', 1),
            route('facilitador.pages.edit', 1),
            route('facilitador.categories.index'),
            route('facilitador.categories.create'),
            route('facilitador.categories.show', 1),
            route('facilitador.categories.edit', 1),
            route('facilitador.menus.index'),
            route('facilitador.menus.create'),
            route('facilitador.menus.show', 1),
            route('facilitador.menus.edit', 1),
            route('facilitador.database.index'),
            route('facilitador.bread.edit', 'categories'),
            route('facilitador.database.edit', 'categories'),
            route('facilitador.database.create'),
        ];

        foreach ($urls as $url) {
            $response = $this->call('GET', $url);
            $this->assertEquals(200, $response->status(), $url.' did not return a 200');
        }
    }
}
