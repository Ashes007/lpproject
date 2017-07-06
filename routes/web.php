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
    return view('welcome');
});

Route::group(array('middleware' => 'user'),function(){
	Route::get('/dashboard',				array('as' => 'dashboard', 		'uses' => 'UserController@index' ));
});

Route::get('/login',					array('as' => 'login', 			'uses' => 'UserController@login' ));
Route::post('/login',					array('as' => 'dologin', 		'uses' => 'UserController@dologin' ));
Route::get('/logout',					array('as' => 'logout', 		'uses' => 'UserController@logout' ));

Route::get('/admin',					array('as' => 'admin_login', 	'uses' => 'admin\DashboardController@login'));
Route::post('/admin',					array('as' => 'admin_dologin', 	'uses' => 'admin\DashboardController@doLogin'));
Route::get('/admin/logout',				array('as' => 'admin_logout', 	'uses' => 'admin\DashboardController@logout'));

Route::group(array('prefix' => 'admin', 'namespace' => 'admin', 'middleware' => 'admin'),function(){

	Route::get('/dashboard',					array('as' => 'admin_dashboard', 	'uses' => 'DashboardController@index'));
	
	Route::group(array('prefix' => 'country'), function(){
		Route::get('/',					array('as' => 'country', 			'uses' => 'CountryController@index'));
		Route::get('//add',				array('as' => 'country_add', 		'uses' => 'CountryController@add'));
		Route::post('/add',				array('as' => 'country_store', 		'uses' => 'CountryController@store'));
		Route::get('/edit/{id}',		array('as' => 'country_edit', 		'uses' => 'CountryController@edit'));
		Route::post('/edit/{id}',		array('as' => 'country_update', 	'uses' => 'CountryController@update'));
	});

	Route::group(array('prefix' => 'state'), function(){
		Route::get('/',					array('as' => 'state', 				'uses' => 'StateController@index'));
		Route::get('/add',				array('as' => 'state_add', 			'uses' => 'StateController@add'));
		Route::post('/add',				array('as' => 'state_store', 		'uses' => 'StateController@store'));
		Route::get('/edit/{id}',		array('as' => 'state_edit', 		'uses' => 'StateController@edit'));
		Route::post('/edit/{id}',		array('as' => 'state_update', 		'uses' => 'StateController@update'));
		Route::get('/delete/{id}',		array('as' => 'state_delete', 		'uses' => 'StateController@delete'));
	});

	Route::group(array('prefix' => 'city'), function(){
		Route::get('/',					array('as' => 'city', 				'uses' => 'CityController@index'));
		Route::get('/add',				array('as' => 'city_add', 			'uses' => 'CityController@add'));
		Route::post('/add',				array('as' => 'city_store', 		'uses' => 'CityController@store'));
		Route::get('/edit/{id}',		array('as' => 'city_edit', 			'uses' => 'CityController@edit'));
		Route::post('/edit/{id}',		array('as' => 'city_update', 		'uses' => 'CityController@update'));
		Route::get('/delete/{id}',		array('as' => 'city_delete', 		'uses' => 'CityController@delete'));
		Route::any('/getstate',			array('as' => 'get_state', 			'uses' => 'CityController@getState'));
	});

	Route::group(array('prefix' => 'category'), function(){
		Route::get('/',					array('as' => 'category', 				'uses' => 'CategoryController@index'));
		Route::get('/add',				array('as' => 'category_add', 			'uses' => 'CategoryController@add'));
		Route::post('/add',				array('as' => 'category_store', 		'uses' => 'CategoryController@store'));
		Route::get('/edit/{id}',		array('as' => 'category_edit', 			'uses' => 'CategoryController@edit'));
		Route::post('/edit/{id}',		array('as' => 'category_update', 		'uses' => 'CategoryController@update'));
		Route::get('/delete/{id}',		array('as' => 'category_delete', 		'uses' => 'CategoryController@delete'));
	});

});
