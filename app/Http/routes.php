<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('orders/add','OrdersController@add');
Route::post('orders/add','OrdersController@storeorder');
Route::get('invoices/add','OrdersController@addinvoice');
Route::post('invoices/add','OrdersController@storeinvoice');

Route::get('orders/draft','OrdersController@index'); // Draft orders
Route::get('order/{id}','OrdersController@show');
Route::get('order/{id}/delete','OrdersController@deleteOrder');

Route::get('order/{id}/edit','OrdersController@edit');

Route::patch('order/{id}','OrdersController@update');
// Route::get('order/{id}/confirm','OrdersController@confirm');

// See all confirmed orders (order_status = 'confirmed')
Route::get('orders/confirmed','OrdersController@indexConfirmed');
Route::get('orders/lost','OrdersController@indexLost');
Route::get('orders/received','OrdersController@indexReceived');


// Route::get('customers','CustomersController@index');
// Route::post('customers','CustomersController@store');
Route::get('customers/{customer}/orders','CustomersController@orders');
Route::get('customers/orderstotal','CustomersController@orderstotal');

Route::resource('products','ProductsController');
Route::resource('customers','CustomersController');
Route::resource('prices','PricesController');
Route::resource('customers','CustomersController');
Route::resource('colours','ColoursController');
Route::auth();

Route::get('/home', 'HomeController@index');


Route::resource('payments/receivable','PaymentsReceivableController');
Route::resource('hisab','HisabsController');