<?php

namespace Facilitador\Tests\Feature;

use Illuminate\Support\Facades\Auth;
use Facilitador\Facades\Facilitador;
use Facilitador\Tests\TestCase;

class DashboardTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->install();
    }

    /**
     * Test Dashboard Widgets.
     *
     * This test will make sure the configured widgets are being shown on
     * the dashboard page.
     */
    public function testWidgetsAreBeingShownOnDashboardPage()
    {
        // We must first login and visit the dashboard page.
        Auth::loginUsingId(1);

        $this->visit(route('rica.dashboard'))
            ->see(__('pedreiro::generic.dashboard'));

        // Test UserDimmer widget
        $this->see(trans_choice('facilitador::dimmer.user', 1))
            ->click(__('pedreiro::dimmer.user_link_text'))
            ->seePageIs(route('rica.facilitador.users.index'))
            ->click(__('pedreiro::generic.dashboard'))
            ->seePageIs(route('rica.dashboard'));

        // Test PostDimmer widget
        $this->see(trans_choice('facilitador::dimmer.post', 4))
            ->click(__('pedreiro::dimmer.post_link_text'))
            ->seePageIs(route('rica.facilitador.posts.index'))
            ->click(__('pedreiro::generic.dashboard'))
            ->seePageIs(route('rica.dashboard'));

        // Test PageDimmer widget
        $this->see(trans_choice('facilitador::dimmer.page', 1))
            ->click(__('pedreiro::dimmer.page_link_text'))
            ->seePageIs(route('rica.facilitador.pages.index'))
            ->click(__('pedreiro::generic.dashboard'))
            ->seePageIs(route('rica.dashboard'))
            ->see(__('pedreiro::generic.dashboard'));
    }

    /**
     * UserDimmer widget isn't displayed without the right permissions.
     */
    public function testUserDimmerWidgetIsNotShownWithoutTheRightPermissions()
    {
        // We must first login and visit the dashboard page.
        $user = \Auth::loginUsingId(1);

        // Remove `browse_users` permission
        $user->role->permissions()->detach(
            $user->role->permissions()->where('key', 'browse_users')->first()
        );

        $this->visit(route('rica.dashboard'))
            ->see(__('pedreiro::generic.dashboard'));

        // Test UserDimmer widget
        $this->dontSee('<h4>1 '.trans_choice('facilitador::dimmer.user', 1).'</h4>')
            ->dontSee(__('pedreiro::dimmer.user_link_text'));
    }

    /**
     * PostDimmer widget isn't displayed without the right permissions.
     */
    public function testPostDimmerWidgetIsNotShownWithoutTheRightPermissions()
    {
        // We must first login and visit the dashboard page.
        $user = \Auth::loginUsingId(1);

        // Remove `browse_users` permission
        $user->role->permissions()->detach(
            $user->role->permissions()->where('key', 'browse_posts')->first()
        );

        $this->visit(route('rica.dashboard'))
            ->see(__('pedreiro::generic.dashboard'));

        // Test PostDimmer widget
        $this->dontSee('<h4>1 '.trans_choice('facilitador::dimmer.post', 1).'</h4>')
            ->dontSee(__('pedreiro::dimmer.post_link_text'));
    }

    /**
     * PageDimmer widget isn't displayed without the right permissions.
     */
    public function testPageDimmerWidgetIsNotShownWithoutTheRightPermissions()
    {
        // We must first login and visit the dashboard page.
        $user = \Auth::loginUsingId(1);

        // Remove `browse_users` permission
        $user->role->permissions()->detach(
            $user->role->permissions()->where('key', 'browse_pages')->first()
        );

        $this->visit(route('rica.dashboard'))
            ->see(__('pedreiro::generic.dashboard'));

        // Test PageDimmer widget
        $this->dontSee('<h4>1 '.trans_choice('facilitador::dimmer.page', 1).'</h4>')
            ->dontSee(__('pedreiro::dimmer.page_link_text'));
    }

    /**
     * Test See Correct Footer Version Number.
     *
     * This test will make sure the footer contains the correct version number.
     */
    public function testSeeingCorrectFooterVersionNumber()
    {
        // We must first login and visit the dashboard page.
        Auth::loginUsingId(1);

        $this->visit(route('rica.dashboard'))
            ->see(Facilitador::getVersion());
    }
}
