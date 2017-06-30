<?php

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

Route::group([
    'as'         => 'album.',
    'prefix'     => 'albums',
], function () {
    Route::get('', ['as' => 'index', 'uses' => 'AlbumsController@index']);
    Route::post('', ['as' => 'store', 'uses' => 'AlbumsController@store']);
    Route::get('{album}', ['as' => 'show', 'uses' => 'AlbumsController@show']);
    Route::put('{album}', ['as' => 'update', 'uses' => 'AlbumsController@update']);
    Route::delete('{album}', ['as' => 'destroy', 'uses' => 'AlbumsController@destroy']);
});

Route::group([
    'as'         => 'artist.',
    'prefix'     => 'artists',
], function () {
    Route::get('', ['as' => 'index', 'uses' => 'ArtistsController@index']);
    Route::post('', ['as' => 'store', 'uses' => 'ArtistsController@store']);
    Route::get('{artist}', ['as' => 'show', 'uses' => 'ArtistsController@show']);
    Route::put('{artist}', ['as' => 'update', 'uses' => 'ArtistsController@update']);
    Route::delete('{artist}', ['as' => 'destroy', 'uses' => 'ArtistsController@destroy']);
});

Route::group([
    'as'         => 'song.',
    'prefix'     => 'songs',
], function () {
    Route::get('', ['as' => 'index', 'uses' => 'SongsController@index']);
    Route::post('', ['as' => 'store', 'uses' => 'SongsController@store']);
    Route::get('{song}', ['as' => 'show', 'uses' => 'SongsController@show']);
    Route::put('{song}', ['as' => 'update', 'uses' => 'SongsController@update']);
    Route::delete('{song}', ['as' => 'destroy', 'uses' => 'SongsController@destroy']);
});
