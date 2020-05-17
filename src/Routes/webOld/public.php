<?php

/*
|--------------------------------------------------------------------------
| Basic WriteLabels Pages
|--------------------------------------------------------------------------
*/
Route::get('cms', 'SitecFeatureController@sendHome');
Route::get('cms', 'SitecFeatureController@sendHome');
Route::get('{module}/rss', 'RssController@index');
Route::get('site-map', 'SiteMapController@index');
Route::get('cms'.'/hero-images/delete/{entity}/{entity_id}', 'SitecFeatureController@deleteHero');

/*
|--------------------------------------------------------------------------
| Config Pages
|--------------------------------------------------------------------------
*/

Route::get('language/set/{language}', 'SitecFeatureController@setLanguage')->name('language.set');

/*
|--------------------------------------------------------------------------
| Public Assets
|--------------------------------------------------------------------------
*/

Route::get('public-preview/{encFileName}', 'AssetController@asPreview');
Route::get('public-asset/{encFileName}', 'AssetController@asPublic');
Route::get('public-download/{encFileName}/{encRealFileName}', 'AssetController@asDownload');
Route::get('asset/{path}/{contentType}', 'AssetController@asset');
Route::group(
    ['prefix' => 'sitec'], function () {
        Route::get('asset/{path}/{contentType}', 'AssetController@asset');
    }
);


Route::get('midia-preview/{encFileName}', 'MidiaController@asPreview');
Route::get('midia-full/{encFileName}', 'MidiaController@asFull');
Route::get('midia-download/{encFileName}/{encRealFileName}', 'MidiaController@asDownload');




/*
|--------------------------------------------------------------------------
| Features Routes
|--------------------------------------------------------------------------
*/

Route::group(
    ['namespace' => 'Features', 'middleware' => ['language', 'analytics']/*, 'as' => 'public.'*/], function () {

    
        /**
         * Writelabel
         */
        Route::group(
            ['namespace' => 'Writelabel', 'as' => 'writelabel.'], function () {
                Route::get('', 'PagesController@home');
                Route::get('home', 'PagesController@home');
                Route::get('pages', 'PagesController@all');
                Route::get('page/{url}', 'PagesController@show');
                Route::get('p/{url}', 'PagesController@show');

                Route::get('faqs', 'FaqController@all');
            }
        );

        /**
         * Midia
         */
        Route::group(
            ['namespace' => 'Midia', 'as' => 'midia.'], function () {
                Route::get('gallery', 'GalleryController@all');
                Route::get('gallery/{tag}', 'GalleryController@show');
        
                Route::get('midia-preview/{midiaId}', 'MidiaController@asPreview');
                Route::get('midia-full/{midiaId}', 'MidiaController@asFull');
                Route::get('midia-download/{midiaId}/{encRealFileName}', 'MidiaController@asDownload');
            }
        );

        /**
         * Blog
         */
        Route::group(
            ['namespace' => 'Blog', 'as' => 'blog.'], function () {
                Route::get('blog', 'BlogController@all');
                Route::get('blog/{url}', 'BlogController@show');
                Route::get('blog/tags/{tag}', 'BlogController@tag');
            }
        );

        /**
         * Calendar
         */
        Route::group(
            ['namespace' => 'Calendar', 'as' => 'calendar.'], function () {
                Route::get('events', 'EventsController@calendar');
                Route::get('events/{month}', 'EventsController@calendar');
                Route::get('events/all', 'EventsController@all');
                Route::get('events/date/{date}', 'EventsController@date');
                Route::get('events/event/{id}', 'EventsController@show');
            }
        );

        /**
         * Commerce
         */
        Route::group(
            ['namespace' => 'Commerce', 'as' => 'commerce.'], function () {
                include dirname(__FILE__) . DIRECTORY_SEPARATOR . "public". DIRECTORY_SEPARATOR . "commerce.php";
            }
        );
    }
);


// /****************   Model binding into route **************************/
// Route::model('article', 'App\Model\Blog\Article');
// Route::model('articlecategory', 'App\Model\Blog\Category');
// Route::model('language', 'App\Model\System\Language');
// Route::model('photoalbum', 'App\Model\Midia\PhotoAlbum');
// Route::model('photo', 'App\Model\Midia\Photo');
// Route::model('user', 'App\Model\User');
// Route::pattern('id', '[0-9]+');
// Route::pattern('slug', '[0-9a-z-_]+');

// /***************    Site routes  **********************************/
// Route::get('/', 'HomeController@index');
// Route::get('home', 'HomeController@index');
// Route::get('about', 'PagesController@about');
// Route::get('contact', 'PagesController@contact');
// Route::get('articles', 'ArticlesController@index');
// Route::get('article/{slug}', 'ArticlesController@show');
// Route::get('video/{id}', 'VideoController@show');
// Route::get('photo/{id}', 'PhotoController@show');

// Route::controllers([
//     'auth' => 'Auth\AuthController',
//     'password' => 'Auth\PasswordController',
// ]);

// /***************    Girl routes  **********************************/
// Route::group(['prefix' => 'girl', 'middleware' => 'girl'], function() {

//     # Girl Dashboard
//     Route::get('dashboard', 'Girl\DashboardController@index');

//     # Language
//     Route::get('language/data', 'Girl\LanguageController@data');
//     Route::get('language/{language}/show', 'Girl\LanguageController@show');
//     Route::get('language/{language}/edit', 'Girl\LanguageController@edit');
//     Route::get('language/{language}/delete', 'Girl\LanguageController@delete');
//     Route::resource('language', 'Girl\LanguageController');

//     # Category
//     Route::get('category/data', 'Girl\ArticleCategoriesController@data');
//     Route::get('category/{category}/show', 'Girl\ArticleCategoriesController@show');
//     Route::get('category/{category}/edit', 'Girl\ArticleCategoriesController@edit');
//     Route::get('category/{category}/delete', 'Girl\ArticleCategoriesController@delete');
//     Route::get('category/reorder', 'ArticleCategoriesController@getReorder');
//     Route::resource('category', 'Girl\ArticleCategoriesController');

//     # Articles
//     Route::get('article/data', 'Girl\ArticleController@data');
//     Route::get('article/{article}/show', 'Girl\ArticleController@show');
//     Route::get('article/{article}/edit', 'Girl\ArticleController@edit');
//     Route::get('article/{article}/delete', 'Girl\ArticleController@delete');
//     Route::get('article/reorder', 'Girl\ArticleController@getReorder');
//     Route::resource('article', 'Girl\ArticleController');

//     # Photo Album
//     Route::get('photoalbum/data', 'Girl\PhotoAlbumController@data');
//     Route::get('photoalbum/{photoalbum}/show', 'Girl\PhotoAlbumController@show');
//     Route::get('photoalbum/{photoalbum}/edit', 'Girl\PhotoAlbumController@edit');
//     Route::get('photoalbum/{photoalbum}/delete', 'Girl\PhotoAlbumController@delete');
//     Route::resource('photoalbum', 'Girl\PhotoAlbumController');

//     # Photo
//     Route::get('photo/data', 'Girl\PhotoController@data');
//     Route::get('photo/{photo}/show', 'Girl\PhotoController@show');
//     Route::get('photo/{photo}/edit', 'Girl\PhotoController@edit');
//     Route::get('photo/{photo}/delete', 'Girl\PhotoController@delete');
//     Route::resource('photo', 'Girl\PhotoController');

//     # Users
//     Route::get('user/data', 'Girl\UserController@data');
//     Route::get('user/{user}/show', 'Girl\UserController@show');
//     Route::get('user/{user}/edit', 'Girl\UserController@edit');
//     Route::get('user/{user}/delete', 'Girl\UserController@delete');
//     Route::resource('user', 'Girl\UserController');
// });