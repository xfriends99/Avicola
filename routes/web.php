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

/* ABM Clientes */
Route::get('/clients', 'ClientController@listClients');
Route::get('/editClient/{id}', 'ClientController@getEditClient');
Route::post('/editClient', 'ClientController@postEditClient');
Route::get('/addclient', 'ClientController@getAddClient');
Route::post('/addclient', 'ClientController@postAddClient');
Route::get('/deleteClient/{id}', 'ClientController@deleteClient');

/* ABM Proveedores */
Route::get('/providers', 'ProviderController@listProviders');
Route::get('/editProvider/{id}', 'ProviderController@getEditProvider');
Route::post('/editProvider', 'ProviderController@postEditProvider');
Route::get('/addprovider', 'ProviderController@getAddProvider');
Route::post('/addprovider', 'ProviderController@postAddProvider');
Route::get('/deleteProvider/{id}', 'ProviderController@deleteProvider');

/* ABM Productos */
Route::get('/products', 'ProductController@index');
Route::get('/product/{id}', 'ProductController@getEditProduct');
Route::post('/editProduct', 'ProductController@postUpdateProduct');
Route::get('/addproduct', 'ProductController@getAddProduct');
Route::post('/addproduct', 'ProductController@postAddProduct');
Route::get('/deleteProduct/{id}', 'ProductController@deleteProduct');
Route::get('/products/search', 'ProductController@searchProduct');

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