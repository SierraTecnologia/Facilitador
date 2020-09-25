<?php

use Illuminate\Database\Seeder;
use Facilitador\Models\Menu;
use Facilitador\Models\MenuItem;

class MenuItemsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        $menu = Menu::where('name', 'admin')->firstOrFail();

        $menuItem = MenuItem::firstOrNew(
            [
            'menu_id' => $menu->id,
            'title'   => __('facilitador::seeders.menu_items.dashboard'),
            'url'     => '',
            'route'   => 'rica.dashboard',
            ]
        );
        if (!$menuItem->exists) {
            $menuItem->fill(
                [
                'target'     => '_self',
                'icon_class' => 'facilitador-boat',
                'color'      => null,
                'parent_id'  => null,
                'order'      => 1,
                ]
            )->save();
        }

        $menuItem = MenuItem::firstOrNew(
            [
            'menu_id' => $menu->id,
            'title'   => __('facilitador::seeders.menu_items.media'),
            'url'     => '',
            'route'   => 'master.media.index',
            ]
        );
        if (!$menuItem->exists) {
            $menuItem->fill(
                [
                'target'     => '_self',
                'icon_class' => 'facilitador-images',
                'color'      => null,
                'parent_id'  => null,
                'order'      => 5,
                ]
            )->save();
        }

        $menuItem = MenuItem::firstOrNew(
            [
            'menu_id' => $menu->id,
            'title'   => __('facilitador::seeders.menu_items.users'),
            'url'     => '',
            'route'   => 'facilitador.users.index',
            ]
        );
        if (!$menuItem->exists) {
            $menuItem->fill(
                [
                'target'     => '_self',
                'icon_class' => 'facilitador-person',
                'color'      => null,
                'parent_id'  => null,
                'order'      => 3,
                ]
            )->save();
        }

        $menuItem = MenuItem::firstOrNew(
            [
            'menu_id' => $menu->id,
            'title'   => __('facilitador::seeders.menu_items.roles'),
            'url'     => '',
            'route'   => 'facilitador.roles.index',
            ]
        );
        if (!$menuItem->exists) {
            $menuItem->fill(
                [
                'target'     => '_self',
                'icon_class' => 'facilitador-lock',
                'color'      => null,
                'parent_id'  => null,
                'order'      => 2,
                ]
            )->save();
        }

        $toolsMenuItem = MenuItem::firstOrNew(
            [
            'menu_id' => $menu->id,
            'title'   => __('facilitador::seeders.menu_items.tools'),
            'url'     => '',
            ]
        );
        if (!$toolsMenuItem->exists) {
            $toolsMenuItem->fill(
                [
                'target'     => '_self',
                'icon_class' => 'facilitador-tools',
                'color'      => null,
                'parent_id'  => null,
                'order'      => 9,
                ]
            )->save();
        }

        // $menuItem = MenuItem::firstOrNew(
        //     [
        //     'menu_id' => $menu->id,
        //     'title'   => __('facilitador::seeders.menu_items.menu_builder'),
        //     'url'     => '',
        //     'route'   => 'facilitador.menus.index',
        //     ]
        // );
        // if (!$menuItem->exists) {
        //     $menuItem->fill(
        //         [
        //         'target'     => '_self',
        //         'icon_class' => 'facilitador-list',
        //         'color'      => null,
        //         'parent_id'  => $toolsMenuItem->id,
        //         'order'      => 10,
        //         ]
        //     )->save();
        // }

        $menuItem = MenuItem::firstOrNew(
            [
            'menu_id' => $menu->id,
            'title'   => __('facilitador::seeders.menu_items.database'),
            'url'     => '',
            'route'   => 'facilitador.database.index',
            ]
        );
        if (!$menuItem->exists) {
            $menuItem->fill(
                [
                'target'     => '_self',
                'icon_class' => 'facilitador-data',
                'color'      => null,
                'parent_id'  => $toolsMenuItem->id,
                'order'      => 11,
                ]
            )->save();
        }

        $menuItem = MenuItem::firstOrNew(
            [
            'menu_id' => $menu->id,
            'title'   => __('facilitador::seeders.menu_items.compass'),
            'url'     => '',
            'route'   => 'facilitador.compass.index',
            ]
        );
        if (!$menuItem->exists) {
            $menuItem->fill(
                [
                'target'     => '_self',
                'icon_class' => 'facilitador-compass',
                'color'      => null,
                'parent_id'  => $toolsMenuItem->id,
                'order'      => 12,
                ]
            )->save();
        }

        $menuItem = MenuItem::firstOrNew(
            [
            'menu_id' => $menu->id,
            'title'   => __('facilitador::seeders.menu_items.bread'),
            'url'     => '',
            'route'   => 'facilitador.bread.index',
            ]
        );
        if (!$menuItem->exists) {
            $menuItem->fill(
                [
                'target'     => '_self',
                'icon_class' => 'facilitador-bread',
                'color'      => null,
                'parent_id'  => $toolsMenuItem->id,
                'order'      => 13,
                ]
            )->save();
        }

        $menuItem = MenuItem::firstOrNew(
            [
            'menu_id' => $menu->id,
            'title'   => __('facilitador::seeders.menu_items.settings'),
            'url'     => '',
            'route'   => 'rica.facilitador.settings.index',
            ]
        );
        if (!$menuItem->exists) {
            $menuItem->fill(
                [
                'target'     => '_self',
                'icon_class' => 'facilitador-settings',
                'color'      => null,
                'parent_id'  => null,
                'order'      => 14,
                ]
            )->save();
        }
    }
}
