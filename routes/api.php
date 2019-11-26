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

Route::get('/url', ['uses' => 'Api\v1\UrlShorterController@index']);
Route::post('/url', ['uses' => 'Api\v1\UrlShorterController@create']);
Route::get('/url/{url_id}', ['uses' => 'Api\v1\UrlShorterController@view']);
Route::put('/url/{url_id}', ['uses' => 'Api\v1\UrlShorterController@update']);
Route::delete('/url/{url_id}', ['uses' => 'Api\v1\UrlShorterController@delete']);
