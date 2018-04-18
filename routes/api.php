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

Route::get('fencers', function () {
    return App\fencer::all()->load('person', 'person.sex');
});

Route::get('fencer/{id}', function ($id) {
    return App\fencer::find($id)->load('person', 'person.sex');
});