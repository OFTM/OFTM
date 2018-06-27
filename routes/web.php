<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('base');
});

Route::resource('fencers', 'FencerController');
Route::get('tournament/{tournament}/participants/edit', array('uses' => 'TournamentController@participants_edit'))->name('tournament.participants_edit');
Route::put('tournament/{tournament}/participants', array('uses' => 'TournamentController@participants_store'))->name('tournament.participants_store');
Route::get('tournament/{tournament}/combats/create', array('uses' => 'TournamentController@combats_create'))->name('tournament.combats_create');
Route::put('tournament/{tournament}/combats', array('uses' => 'TournamentController@combats_store'))->name('tournament.combats_store');
Route::post('tournament/{tournament}/end_round', array('uses' => 'TournamentController@end_round'))->name('tournament.end_round');
Route::resource('tournament', 'TournamentController');