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
    if (Auth::check())
        return view('home');
    else
        return view('auth/login');
});

Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');

Route::get('/guilds', 'GuildController@index')->middleware('auth')->name('guilds');
Route::post('/guild_add', 'GuildController@create')->middleware('auth');
Route::get('/guild/{token}', 'QuestController@index')->middleware('auth')->name('quests');

// Route::get( '/{path?}', function(){
//     return view('welcome');
// } )->where('path', '.*');
