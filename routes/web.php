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
    // $router->group(['prefix' => 'api/v1', ], function () use ($router)
    // {		
    
    // },

    $router->get('/loging', 'Api\v1\LogController@get_list_status');
    $router->get('/log', 'Api\v1\LogController@get_list');
    $router->get('/log/get_list_status', 'Api\v1\LogController@get_list_status');
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
	
	$router->get('/company', 'Api\v1\CompanyController@get_list');
	$router->get('/company/get_list', 'Api\v1\CompanyController@get_list');
	$router->get('/company/{id}', 'Api\v1\CompanyController@get');
	$router->post('/company', 'Api\v1\CompanyController@save');
	$router->put('/company', 'Api\v1\CompanyController@update');
    $router->delete('/company', 'Api\v1\CompanyController@delete');

    $router->get('/user', 'Api\v1\UserController@get_list');
	$router->get('/user/get_list', 'Api\v1\UserController@get_list');
	$router->get('/user/{id}', 'Api\v1\UserController@get');
	$router->post('/user', 'Api\v1\UserController@save');
	$router->put('/user', 'Api\v1\UserController@update');
    $router->delete('/user', 'Api\v1\UserController@delete');
	
	$router->get('/site', 'Api\v1\SiteController@get_list');
	$router->get('/site/get_list', 'Api\v1\SiteController@get_list');
	$router->get('/site/{id}', 'Api\v1\SiteController@get');
	$router->post('/site', 'Api\v1\SiteController@save');
	$router->put('/site', 'Api\v1\SiteController@update');
    $router->delete('/site', 'Api\v1\SiteController@delete');
	
	$router->get('/pic', 'Api\v1\PicController@get_list');
	$router->get('/pic/get_list', 'Api\v1\PicController@get_list');
	$router->get('/pic/{id}', 'Api\v1\PicController@get');
	$router->post('/pic', 'Api\v1\PicController@save');
	$router->put('/pic', 'Api\v1\PicController@update');
    $router->delete('/pic', 'Api\v1\PicController@delete');
	
	$router->get('/level', 'Api\v1\LevelController@get_list');
	$router->get('/level/get_list', 'Api\v1\LevelController@get_list');
	$router->get('/level/{id}', 'Api\v1\LevelController@get');
	$router->post('/level', 'Api\v1\LevelController@save');
	$router->put('/level', 'Api\v1\LevelController@update');
    $router->delete('/level', 'Api\v1\LevelController@delete');
	
	$router->get('/reason', 'Api\v1\ReasonController@get_list');
	$router->get('/reason/get_list', 'Api\v1\ReasonController@get_list');
	$router->get('/reason/{id}', 'Api\v1\ReasonController@get');
	$router->post('/reason', 'Api\v1\ReasonController@save');
	$router->put('/reason', 'Api\v1\ReasonController@update');
    $router->delete('/reason', 'Api\v1\ReasonController@delete');

    // $router->get('/', 'Api\v1\Controller@get_list');
	// $router->get('/get_list', 'Api\v1\Controller@get_list');
	// $router->get('/{id}', 'Api\v1\Controller@get');
	// $router->post('/', 'Api\v1\Controller@save');
	// $router->put('/', 'Api\v1\Controller@update');
    // $router->delete('/', 'Api\v1\Controller@delete');
});