<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('videoSize/{videoSize}', 'VideosController@videoSize');

Route::get('videoMetadata/{videoMetadata}', 'VideosController@videoMetadata');

Route::patch('videoMetadata/{videoMetadata}', 'VideosController@videoMetadata');

Route::resource('videos', 'VideosController');
