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
Route::post('/quest_sync', 'QuestController@sync')->middleware('auth')->name('quest_sync');
Route::get('/quest/{id}', 'QuestController@show')->middleware('auth')->name('quest_show');

//Topic
Route::get('/topics', 'TopicController@index')->middleware('auth')->name('topics');
Route::get('/topic_create', 'TopicController@create')->middleware('auth')->name('topic_create');
Route::get('/topic_edit/{id}', 'TopicController@edit')->middleware('auth')->name('topic_edit');
Route::post('/topic_add', 'TopicController@store')->middleware('auth');
Route::post('/topic_update', 'TopicController@update')->middleware('auth');

//Question
Route::get('/topic/{id}', 'QuestionController@index')->middleware('auth')->name('questions');
Route::get('/question_create/{id}', 'QuestionController@create')->middleware('auth')->name('question_create');
Route::post('/question_add', 'QuestionController@store')->middleware('auth');
Route::post('/question_update', 'QuestionController@update')->middleware('auth');
Route::get('/question_edit/{id}', 'QuestionController@edit')->middleware('auth')->name('question_edit');

// Route::get( '/{path?}', function(){
//     return view('welcome');
// } )->where('path', '.*');
