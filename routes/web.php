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
Auth::routes();

Route::get('/', 'DashboardController@home');

/* ABM Usuarios */
Route::get('/users', 'UserController@listUsers');
Route::get('/profile/{id}', 'UserController@getEditUser');
Route::post('/editUser', 'UserController@postEditUser');
Route::get('/adduser', 'UserController@getAddUser');
Route::post('/adduser', 'UserController@postAddUser');
Route::get('/deleteUser/{id}', 'UserController@deleteUser');

/* ABM Servicios */
Route::get('/services', 'ServicesController@index');
Route::get('/service/{id}', 'ServicesController@getEditService');
Route::post('/editService', 'ServicesController@postUpdateService');
Route::get('/addservice', 'ServicesController@getAddService');
Route::post('/addservice', 'ServicesController@postAddService');
Route::get('/deleteService/{id}', 'ServicesController@deleteService');
Route::get('/services/search', 'ServicesController@searchService');


/* ABM Compras */
Route::get('/buy/search', 'BuyController@searchBuy');
Route::get('/buy', 'BuyController@index');
Route::get('/buy/{id}', 'BuyController@getEditBuy');
Route::post('/editbuy', 'BuyController@postUpdateBuy');
Route::post('/updateStatusBuy', 'BuyController@postUpdateStatus');
Route::get('/addbuy', 'BuyController@getAddBuy');
Route::post('/addbuy', 'BuyController@postAddBuy');
Route::get('/deleteBuy/{id}', 'BuyController@deleteBuy');


/* ABM Ventas */
Route::get('/sales/search', 'SalesController@searchSales');
Route::get('/sales', 'SalesController@index');
Route::get('/sales/{id}', 'SalesController@getEditSales');
Route::post('/editsales', 'SalesController@postUpdateSales');
Route::post('/updateStatusSales', 'SalesController@postUpdateStatus');
Route::get('/addsales', 'SalesController@getAddSales');
Route::post('/addsales', 'SalesController@postAddSales');
Route::get('/deleteSales/{id}', 'SalesController@deleteSales');
Route::post('/updateMermaSales', 'SalesController@UpdateMermaSales');
Route::post('/updateDeadSales', 'SalesController@UpdateDeadSales');




Route::get('/apiservice/{id}', 'ServicesController@getEditServiceapi');
Route::post('/apiservice', 'ServicesController@postEditServiceapi');