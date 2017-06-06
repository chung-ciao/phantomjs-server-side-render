<?php

use Illuminate\Http\Request;

/**
 *  public
 */

if(env('APP_DEBUG') == true) {
	Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
}

Route::get('/', function () {
  return view('base');
});

Route::group([ 'prefix' => 'seo' ], function() {
	Route::get('/', function () {
	    return 'seo';
    });
});