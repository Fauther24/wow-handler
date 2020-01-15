<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/


/** Callback Arena Team handler */
$router->group(['namespace' => 'Arena', 'prefix' => 'arena', 'as' => 'arena.'], function() use ($router) {
    $router->post('team', ['as' => 'team', 'uses' => 'ArenaTeamController@handler']);
    $router->post('member', ['as' => 'member', 'uses' => 'ArenaMemberController@handler']);
});
