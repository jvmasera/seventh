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

/*oute::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::post('auth/register', 'AuthController@register');
Route::post('auth/login', 'AuthController@authenticate');
Route::get('auth/open', 'DataController@open');

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('auth/user', 'AuthController@getAuthenticatedUser');
    Route::get('auth/closed', 'DataController@closed');
});
