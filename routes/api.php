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

// Users
Route::post('/login', 'API\UserControllerAPI@login');
Route::post('/register', 'API\UserControllerAPI@register');

Route::post('/details', 'API\UserControllerAPI@details');

// Characters
Route::post('/character/create', 'API\CharacterControllerAPI@create');
Route::post('/character/details', 'API\CharacterControllerAPI@details');
Route::post('/character/join', 'API\CharacterControllerAPI@join_guild');
Route::post('/character/joined', 'API\CharacterControllerAPI@joined_guilds');

// Guilds
Route::post('/guild/details', 'API\GuildControllerAPI@details');

// Quests
Route::post('/quest/list', 'API\QuestControllerAPI@index');
