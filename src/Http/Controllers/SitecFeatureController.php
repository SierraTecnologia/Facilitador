<?php

namespace Facilitador\Http\Controllers;

use Cms;
use App\Models\Archive;
use App\Services\Midia\FileService;
use Siravel\Services\System\LanguageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;

class SitecFeatureController extends SitecController
{
    /**
     * Set the default lanugage for the session.
     *
     * @param Request $request
     * @param string  $lang
     */
    public function setLanguage(Request $request, $lang)
    {
        LanguageService::setLanguage($lang);
        return back()->withCookie('language', $lang);
    }
}
