<?php

namespace Facilitador\Http;

use JeroenNoten\LaravelAdminLte\Menu\Builder;
use JeroenNoten\LaravelAdminLte\Menu\Filters\FilterInterface;
use Illuminate\Support\Facades\Auth;
use Laratrust;

class MenuFilter implements FilterInterface
{
    public function transform($item)
    {
        // if (isset($item['permission']) && ! Laratrust::can($item['permission'])) {
        //     return false;
        // }

        $user = Auth::user();

        // if (!$this->verifyLevel($item, $user)) {
        //     return false;
        // }

        // if (!$this->verifySpace($item, $user)) {
        //     return false;
        // }

        // Translate
        if (isset($item["text"])) {
            $item["text"] = _t($item["text"]);
        }
        if (isset($item["header"])) {
            $item["header"] = _t($item["header"]);
        }
        return $item;
    }

    private function verifySpace($item, $user)
    {
        $feature = null;
        if (isset($item['space'])) {
            $space = $item['space'];
        }

        if (empty($space)){
            return true;
        }

        return $space == Session::get('space');
    }

    private function verifyLevel($item, $user)
    {
        $level = 0;
        if (isset($item['level'])) {
            $level = (int) $item['level'];
        }

        // Possui level inteiro e usuario nao logado
        if ($level>0 && !$user) {
            return false;
        }
        if ($level<=0) {
            return true;
        }

        if (!$user || $level > $user->getLevelForAcessInBusiness()) {
            return false;
        }

        return true;
    }
}