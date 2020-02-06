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

//Guild
Route::get('/guilds', 'GuildController@index')->middleware('auth')->name('guilds');
Route::post('/guild_add', 'GuildController@store')->middleware('auth');

//Quest
Route::get('/guild/{token}', 'QuestController@index')->middleware('auth')->name('quests');
Route::get('/quest_create/{token}', 'QuestController@create')->middleware('auth')->name('quest_create');
Route::get('/quest_edit/{id}', 'QuestController@edit')->middleware('auth')->name('quest_edit');
Route::post('/quest_add', 'QuestController@store')->middleware('auth');
Route::post('/quest_update', 'QuestController@update')->middleware('auth');
Route::get('/quest/{id}', 'QuestController@show')->middleware('auth')->name('quest_show');


// Route::get( '/{path?}', function(){
//     return view('welcome');
// } )->where('path', '.*');
