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

$router->group(['middleware' => 'token'], function() use ($router) {
    $router->group(['prefix' => 'app', 'as' => 'app.'], function() use ($router) {
        $router->post('handler', ['as' => 'handler', 'uses' => 'Controller@pingHandler']);
    });

    /** Callback Arena Team handler */
    $router->group(['namespace' => 'Arena', 'prefix' => 'arena', 'as' => 'arena.'], function() use ($router) {
        $router->post('player', ['as' => 'team', 'uses' => 'ArenaTopPlayerController@handler']);
    });

    /** Callback Arena Team handler */
    $router->group(['namespace' => 'Statistics', 'prefix' => 'statistics', 'as' => 'statistics.'], function() use ($router) {
        $router->post('online', ['as' => 'online', 'uses' => 'OnlineWorldController@handler']);
    });

    $router->group(['namespace' => 'User', 'prefix' => 'user', 'as' => 'user.'], function() use ($router) {
        $router->post('info', ['as' => 'info', 'uses' => 'AccountController@handler']);
        $router->post('characters', ['as' => 'characters', 'uses' => 'CharacterController@handler']);
    });
});

