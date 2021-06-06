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
            route('rica.facilitador.roles.index'),
            route('rica.facilitador.roles.create'),
            route('rica.facilitador.roles.show', 1),
            route('rica.facilitador.roles.edit', 1),
            route('rica.facilitador.users.index'),
            route('rica.facilitador.users.create'),
            route('rica.facilitador.users.show', 1),
            route('rica.facilitador.users.edit', 1),
            route('rica.facilitador.posts.index'),
            route('rica.facilitador.posts.create'),
            route('rica.facilitador.posts.show', 1),
            route('rica.facilitador.posts.edit', 1),
            route('rica.facilitador.pages.index'),
            route('rica.facilitador.pages.create'),
            route('rica.facilitador.pages.show', 1),
            route('rica.facilitador.pages.edit', 1),
            route('rica.facilitador.categories.index'),
            route('rica.facilitador.categories.create'),
            route('rica.facilitador.categories.show', 1),
            route('rica.facilitador.categories.edit', 1),
            route('rica.facilitador.menus.index'),
            route('rica.facilitador.menus.create'),
            route('rica.facilitador.menus.show', 1),
            route('rica.facilitador.menus.edit', 1),
            route('rica.facilitador.database.index'),
            route('rica.facilitador.bread.edit', 'categories'),
            route('rica.facilitador.database.edit', 'categories'),
            route('rica.facilitador.database.create'),
        ];

        foreach ($urls as $url) {
            $response = $this->call('GET', $url);
            $this->assertEquals(200, $response->status(), $url.' did not return a 200');
        }
    }
}
