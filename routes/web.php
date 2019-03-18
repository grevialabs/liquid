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
    // return $router->app->version();

    $return['message'] = 'Hello world from API Liquid :D';
    return json_encode($return);
});

$router->group(['prefix' => 'api/v1', ], function () use ($router)
{		
    // $router->group(['prefix' => 'api/v1', ], function () use ($router)
    // {		
    
    // },

    $router->group(['prefix' => 'cron', ], function () use ($router)
    {
        $router->get('/', 'Api\v1\CronController@index');
    });

    $router->get('/loging', 'Api\v1\LogController@get_list_status');
    $router->get('/log', 'Api\v1\LogController@get_list');
    $router->get('/log/get_list_status', 'Api\v1\LogController@get_list_status');
    $router->get('/log/{id}', 'Api\v1\LogController@get');
    $router->post('/log', 'Api\v1\LogController@save');
    $router->put('/log', 'Api\v1\LogController@update');
    $router->delete('/log', 'Api\v1\LogController@delete');

    // $router->get('/log/list', 'Api\v1\LogController@get_list');
	
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
    $router->get('/user/get_list_dropdown', 'Api\v1\UserController@get_list_dropdown');
	$router->get('/user/get_list', 'Api\v1\UserController@get_list');
	$router->get('/user/get_level_by_user', 'Api\v1\UserController@get_level_by_user');
	$router->get('/user/{id}', 'Api\v1\UserController@get');
	$router->post('/user', 'Api\v1\UserController@save');
	$router->put('/user', 'Api\v1\UserController@update');
    $router->delete('/user', 'Api\v1\UserController@delete');
	
    $router->get('/user_attribute', 'Api\v1\UserAttributeController@get_list');
	$router->get('/user_attribute/get_list', 'Api\v1\UserAttributeController@get_list');
	$router->get('/user_attribute/{id}', 'Api\v1\UserAttributeController@get');
	$router->post('/user_attribute', 'Api\v1\UserAttributeController@save');
	$router->put('/user_attribute', 'Api\v1\UserAttributeController@update');
    $router->delete('/user_attribute', 'Api\v1\UserAttributeController@delete');
	
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
	
	$router->get('/transaction', 'Api\v1\TransactionController@get_list');
	$router->get('/transaction/get_list', 'Api\v1\TransactionController@get_list');
	$router->get('/transaction/{id}', 'Api\v1\TransactionController@get');
	$router->post('/transaction', 'Api\v1\TransactionController@save');
	$router->put('/transaction', 'Api\v1\TransactionController@update');
    $router->delete('/transaction', 'Api\v1\TransactionController@delete');

	$router->get('/article_logistic_site', 'Api\v1\ArticleLogisticSiteController@get_list');
	$router->get('/article_logistic_site/get_list', 'Api\v1\ArticleLogisticSiteController@get_list');
	$router->get('/article_logistic_site/{id}', 'Api\v1\ArticleLogisticSiteController@get');
	$router->post('/article_logistic_site', 'Api\v1\ArticleLogisticSiteController@save');
	$router->put('/article_logistic_site', 'Api\v1\ArticleLogisticSiteController@update');
    $router->delete('/article_logistic_site', 'Api\v1\ArticleLogisticSiteController@delete');
	
	$router->get('/article_logistic_site_detail', 'Api\v1\ArticleLogisticSiteDetailController@get_list');
	$router->get('/article_logistic_site_detail/get_list', 'Api\v1\ArticleLogisticSiteDetailController@get_list');
	$router->get('/article_logistic_site_detail/get_list_replenish', 'Api\v1\ArticleLogisticSiteDetailController@get_list_replenish');
	$router->get('/article_logistic_site_detail/{id}', 'Api\v1\ArticleLogisticSiteDetailController@get');
	$router->post('/article_logistic_site_detail', 'Api\v1\ArticleLogisticSiteDetailController@save');
	$router->put('/article_logistic_site_detail', 'Api\v1\ArticleLogisticSiteDetailController@update');
    $router->delete('/article_logistic_site_detail', 'Api\v1\ArticleLogisticSiteDetailController@delete');
	
	$router->get('/role', 'Api\v1\RoleController@get_list');
	$router->get('/role/get_list', 'Api\v1\RoleController@get_list');
	$router->get('/role/{id}', 'Api\v1\RoleController@get');
	$router->post('/role', 'Api\v1\RoleController@save');
	$router->put('/role', 'Api\v1\RoleController@update');
    $router->delete('/role', 'Api\v1\RoleController@delete');
	
	$router->get('/capability', 'Api\v1\CapabilityController@get_list');
	$router->get('/capability/get_list', 'Api\v1\CapabilityController@get_list');
	$router->get('/capability/{id}', 'Api\v1\CapabilityController@get');
	$router->post('/capability', 'Api\v1\CapabilityController@save');
	$router->put('/capability', 'Api\v1\CapabilityController@update');
    $router->delete('/capability', 'Api\v1\CapabilityController@delete');
	
	$router->get('/role_capability/cron_insert_role', 'Api\v1\RoleCapabilityController@cron_insert_role');
	$router->get('/role_capability/get_list', 'Api\v1\RoleCapabilityController@get_list');
	$router->get('/role_capability/get_list_detail', 'Api\v1\RoleCapabilityController@get_list_detail');
	$router->get('/role_capability/{id}', 'Api\v1\RoleCapabilityController@get');
	$router->get('/role_capability', 'Api\v1\RoleCapabilityController@get_list');
	$router->post('/role_capability/update_bulk', 'Api\v1\RoleCapabilityController@update_bulk');
	$router->post('/role_capability', 'Api\v1\RoleCapabilityController@save');
	$router->put('/role_capability', 'Api\v1\RoleCapabilityController@update');
    $router->delete('/role_capability', 'Api\v1\RoleCapabilityController@delete');
	
	$router->get('/reason_type', 'Api\v1\ReasonTypeController@get_list');
	$router->get('/reason_type/get_list', 'Api\v1\ReasonTypeController@get_list');
	$router->get('/reason_type/{id}', 'Api\v1\ReasonTypeController@get');
	$router->post('/reason_type', 'Api\v1\ReasonTypeController@save');
	$router->put('/reason_type', 'Api\v1\ReasonTypeController@update');
    $router->delete('/reason_type', 'Api\v1\ReasonTypeController@delete');
	
	$router->get('/reason_type_mapping', 'Api\v1\ReasonTypeMappingController@get_list');
	$router->get('/reason_type_mapping/get_list', 'Api\v1\ReasonTypeMappingController@get_list');
	$router->get('/reason_type_mapping/{id}', 'Api\v1\ReasonTypeMappingController@get');
	$router->post('/reason_type_mapping', 'Api\v1\ReasonTypeMappingController@save');
	$router->put('/reason_type_mapping', 'Api\v1\ReasonTypeMappingController@update');
    $router->delete('/reason_type_mapping', 'Api\v1\ReasonTypeMappingController@delete');
	
	$router->get('/article_attribute', 'Api\v1\ArticleAttributeController@get_list');
	$router->get('/article_attribute/get_list', 'Api\v1\ArticleAttributeController@get_list');
	$router->get('/article_attribute/{id}', 'Api\v1\ArticleAttributeController@get');
	$router->post('/article_attribute', 'Api\v1\ArticleAttributeController@save');
	$router->put('/article_attribute', 'Api\v1\ArticleAttributeController@update');
    $router->delete('/article_attribute', 'Api\v1\ArticleAttributeController@delete');
	
	$router->get('/article_attribute_value', 'Api\v1\ArticleAttributeValueController@get_list');
	$router->get('/article_attribute_value/get_list', 'Api\v1\ArticleAttributeValueController@get_list');
	$router->get('/article_attribute_value/{id}', 'Api\v1\ArticleAttributeValueController@get');
	$router->post('/article_attribute_value', 'Api\v1\ArticleAttributeValueController@save');
	$router->put('/article_attribute_value', 'Api\v1\ArticleAttributeValueController@update');
    $router->delete('/article_attribute_value', 'Api\v1\ArticleAttributeValueController@delete');
	
	$router->get('/article_stock', 'Api\v1\ArticleStockController@get_list');
	$router->get('/article_stock/get_list', 'Api\v1\ArticleStockController@get_list');
	$router->get('/article_stock/{id}', 'Api\v1\ArticleStockController@get');
	$router->post('/article_stock', 'Api\v1\ArticleStockController@save');
	$router->put('/article_stock', 'Api\v1\ArticleStockController@update');
    $router->delete('/article_stock', 'Api\v1\ArticleStockController@delete');
	
	$router->get('/article_po', 'Api\v1\ArticlePoController@get_list');
	$router->get('/article_po/get_list', 'Api\v1\ArticlePoController@get_list');
	$router->get('/article_po/{id}', 'Api\v1\ArticlePoController@get');
	$router->post('/article_po', 'Api\v1\ArticlePoController@save');
	$router->put('/article_po', 'Api\v1\ArticlePoController@update');
    $router->delete('/article_po', 'Api\v1\ArticlePoController@delete');
	
	$router->get('/rfid_article', 'Api\v1\RfidArticleController@get_list');
	$router->get('/rfid_article/get_list', 'Api\v1\RfidArticleController@get_list');
	$router->get('/rfid_article/{id}', 'Api\v1\RfidArticleController@get');
	$router->post('/rfid_article', 'Api\v1\RfidArticleController@save');
	$router->put('/rfid_article', 'Api\v1\RfidArticleController@update');
    $router->delete('/rfid_article', 'Api\v1\RfidArticleController@delete');
	
	$router->get('/config', 'Api\v1\ConfigController@get_list');
	$router->get('/config/get_list', 'Api\v1\ConfigController@get_list');
	$router->get('/config/{id}', 'Api\v1\ConfigController@get');
	$router->post('/config', 'Api\v1\ConfigController@save');
	$router->put('/config', 'Api\v1\ConfigController@update');
	$router->delete('/config', 'Api\v1\ConfigController@delete');

	$router->get('/movement_article', 'Api\v1\MovementArticleController@get_list');
	$router->get('/movement_article/get_list', 'Api\v1\MovementArticleController@get_list');
	$router->get('/movement_article/{id}', 'Api\v1\MovementArticleController@get');
	$router->post('/movement_article', 'Api\v1\MovementArticleController@save');
	$router->put('/movement_article', 'Api\v1\MovementArticleController@update');
	$router->delete('/movement_article', 'Api\v1\MovementArticleController@delete');

	$router->get('/movement_quota_level', 'Api\v1\MovementQuotaLevelController@get_list');
	$router->get('/movement_quota_level/get_list', 'Api\v1\MovementQuotaLevelController@get_list');
	$router->get('/movement_quota_level/{id}', 'Api\v1\MovementQuotaLevelController@get');
	$router->post('/movement_quota_level', 'Api\v1\MovementQuotaLevelController@save');
	$router->put('/movement_quota_level', 'Api\v1\MovementQuotaLevelController@update');
	$router->delete('/movement_quota_level', 'Api\v1\MovementQuotaLevelController@delete');
	
	$router->get('/prepack_bundling_header', 'Api\v1\PrepackBundlingHeaderController@get_list');
	$router->get('/prepack_bundling_header/get_list', 'Api\v1\PrepackBundlingHeaderController@get_list');
	$router->get('/prepack_bundling_header/{id}', 'Api\v1\PrepackBundlingHeaderController@get');
	$router->post('/prepack_bundling_header', 'Api\v1\PrepackBundlingHeaderController@save');
	$router->put('/prepack_bundling_header', 'Api\v1\PrepackBundlingHeaderController@update');
	$router->delete('/prepack_bundling_header', 'Api\v1\PrepackBundlingHeaderController@delete');
	
	$router->get('/prepack_bundling_detail', 'Api\v1\PrepackBundlingDetailController@get_list');
	$router->get('/prepack_bundling_detail/get_list', 'Api\v1\PrepackBundlingDetailController@get_list');
	$router->get('/prepack_bundling_detail/{id}', 'Api\v1\PrepackBundlingDetailController@get');
	$router->post('/prepack_bundling_detail', 'Api\v1\PrepackBundlingDetailController@save');
	$router->put('/prepack_bundling_detail', 'Api\v1\PrepackBundlingDetailController@update');
	$router->delete('/prepack_bundling_detail', 'Api\v1\PrepackBundlingDetailController@delete');
	
	$router->get('/article_po_history', 'Api\v1\ArticlePoHistoryController@get_list');
	$router->get('/article_po_history/get_list', 'Api\v1\ArticlePoHistoryController@get_list');
	$router->get('/article_po_history/{id}', 'Api\v1\ArticlePoHistoryController@get');
	$router->post('/article_po_history', 'Api\v1\ArticlePoHistoryController@save');
	$router->put('/article_po_history', 'Api\v1\ArticlePoHistoryController@update');
	$router->delete('/article_po_history', 'Api\v1\ArticlePoHistoryController@delete');

	$router->get('/user_role', 'Api\v1\UserRoleController@get_list');
	$router->get('/user_role/get_list', 'Api\v1\UserRoleController@get_list');
	$router->get('/user_role/{id}', 'Api\v1\UserRoleController@get');
	$router->post('/user_role', 'Api\v1\UserRoleController@save');
	$router->put('/user_role', 'Api\v1\UserRoleController@update');
    $router->delete('/user_role', 'Api\v1\UserRoleController@delete');

    // $router->get('/', 'Api\v1\Controller@get_list');
	// $router->get('/get_list', 'Api\v1\Controller@get_list');
	// $router->get('/{id}', 'Api\v1\Controller@get');
	// $router->post('/', 'Api\v1\Controller@save');
	// $router->put('/', 'Api\v1\Controller@update');
    // $router->delete('/', 'Api\v1\Controller@delete');
});