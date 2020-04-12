<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// For best practise we should use version
// api/v1/auth/login, api/v1/auth/register ...

Route::group(['prefix' => 'v1', 'namespace' => 'API'], function ($router) {

    // These routes are public, users can access it without any restriction
    Route::group(['prefix' => 'auth'], function () {
        
        // Create a new user
        Route::post('register', 'AuthController@register');
        // Login user
        Route::post('login', 'AuthController@login');
        // Refresh jwt token
        Route::get('refresh', 'AuthController@refresh');
       
    });

    // These routes are not public, only authenticayed users can access it
    Route::group(['middleware' => 'auth:api', 'prefix' => 'auth'], function () {
        
        // Logout user
        Route::post('logout', 'AuthController@logout');
        // Get user info
        Route::get('user', 'AuthController@user');
       
    });

    /**
     * apiResource: index, store, show, update, destroy
     * resource: apiResource methods + create & edit
     */
    Route::apiResource('channels', 'ChannelsController');


    Route::apiResource('discussions', 'DiscussionController');

});