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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api/v1', ], function () use ($router)
{		
	$router->get('/loging', 'Api\v1\LogController@get_list_status');
	$router->get('/log', 'Api\v1\LogController@get_list');
	$router->get('/log/{id}', 'Api\v1\LogController@get');
	$router->post('/log', 'Api\v1\LogController@save');
	$router->put('/log', 'Api\v1\LogController@update');
    $router->delete('/log', 'Api\v1\LogController@delete');
    
    // $router->get('/log/list', 'Api\v1\LogController@get_list');
	
	// Route::delete('/log/delete', 'Api\V1Controller@log')->name('log4');
	
	$router->get('/article', 'Api\v1\ArticleController@get_list');
	$router->get('/article/get_list', 'Api\v1\ArticleController@get_list');
	$router->get('/article/{id}', 'Api\v1\ArticleController@get');
	$router->post('/article', 'Api\v1\ArticleController@save');
	$router->put('/article', 'Api\v1\ArticleController@update');
    $router->delete('/article', 'Api\v1\ArticleController@delete');
});