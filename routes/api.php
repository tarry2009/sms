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


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::get('getServerKey', 'SmsAccessController@getServerKey');
Route::post('getServerKey', 'SmsAccessController@getServerKey');

Route::post('register', 'SmsAccessController@register');
Route::post('storeSecret', 'SmsAccessController@storeSecret');
Route::post('getSecret', 'SmsAccessController@getSecret');

Route::post('getEncripted', 'SmsAccessController@getEncripted');
Route::post('getDecrypt', 'SmsAccessController@getDecrypt');

Route::get('getEncripted', 'SmsAccessController@getEncripted');
Route::get('getDecrypt', 'SmsAccessController@getDecrypt');