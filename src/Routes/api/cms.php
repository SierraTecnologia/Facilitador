<?php

/*
* --------------------------------------------------------------------------
* Internal APIs
* --------------------------------------------------------------------------
*/
Route::group(
    ['middleware' => 'auth'], function () {
        Route::group(
            ['prefix' => 'admin/api'], function () {
                Route::get('images/list', 'ImagesController@apiList');
                Route::post('images/store', 'ImagesController@apiStore');
                Route::get('files/list', 'FilesController@apiList');
            }
        );

        Route::group(
            ['prefix' => 'cms'], function () {
                Route::get('images/bulk-delete/{ids}', 'ImagesController@bulkDelete');
                Route::post('images/upload', 'ImagesController@upload');
                Route::post('files/upload', 'FilesController@upload');
            }
        );
    }
);



/*
|--------------------------------------------------------------------------
| APIs
|--------------------------------------------------------------------------
*/

Route::group(
    ['prefix' => 'admin/api'], function () {
        Route::get('images/list', 'ImagesController@apiList');
        Route::post('images/store', 'ImagesController@apiStore');
        Route::get('files/list', 'FilesController@apiList');

        Route::group(
            ['middleware' => ['cms-api']], function () {
                Route::get('blog', 'ApiController@all');
                Route::get('blog/{id}', 'ApiController@find');

                Route::get('events', 'ApiController@all');
                Route::get('events/{id}', 'ApiController@find');

                Route::get('faqs', 'ApiController@all');
                Route::get('faqs/{id}', 'ApiController@find');

                Route::get('files', 'ApiController@all');
                Route::get('files/{id}', 'ApiController@find');

                Route::get('images', 'ApiController@all');
                Route::get('images/{id}', 'ApiController@find');

                Route::get('pages', 'ApiController@all');
                Route::get('pages/{id}', 'ApiController@find');

                Route::get('widgets', 'ApiController@all');
                Route::get('widgets/{id}', 'ApiController@find');
            }
        );
    }
);