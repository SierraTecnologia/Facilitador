<?php

namespace Facilitador\Http\Controllers\NoRestrict;

use Cms;
use Informate\Models\System\Archive;
use Stalker\Services\Midia\FileService;
use Translation\Services\LanguageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Constraint;
use Intervention\Image\Facades\Image;
use League\Flysystem\Util;
use Facilitador\Facades\Facilitador;

class SitecFeatureController extends Controller
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


    public function assets(Request $request)
    {
        try {
            $path = dirname(__DIR__, 4).'/publishes/assets/'.Util::normalizeRelativePath(urldecode($request->path));
        } catch (\LogicException $e) {
            abort(404);
        }

        if (File::exists($path)) {
            $mime = '';
            if (Str::endsWith($path, '.js')) {
                $mime = 'text/javascript';
            } elseif (Str::endsWith($path, '.css')) {
                $mime = 'text/css';
            } else {
                $mime = File::mimeType($path);
            }
            $response = response(File::get($path), 200, ['Content-Type' => $mime]);
            $response->setSharedMaxAge(31536000);
            $response->setMaxAge(31536000);
            $response->setExpires(new \DateTime('+1 year'));

            return $response;
        }

        return response('', 404);
    }
}
