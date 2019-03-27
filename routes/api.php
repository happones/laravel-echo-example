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

Route::post('login', 'AuthController@login');

Route::middleware('auth:api')->post('/send-all', function () {
    $message = \request('message') ?: '';
    broadcast(new \App\Events\NewMessage($message));
});

Route::middleware('auth:api')->post('/send-others', function () {
    $message = \request('message') ?: '';
    broadcast(new \App\Events\NewMessage($message))->toOthers();
});