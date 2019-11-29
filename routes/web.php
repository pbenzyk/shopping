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
/* Logout */
Route::get('/logout', 'UserController@logout');
/* login */
Route::post('/login', "UserController@UserLogin");

/* Admin */
Route::resource('/admin/index', 'TypeProductController');
Route::resource('/admin/product', 'ProductController');

/* User */
Route::get('/user/view', "TypeProductController@view");
Route::get('/user/show/{id_type}', "TypeProductController@show");
Route::get('/user/show_stock/{id_product}', "ProductController@show");

/* Order */
Route::resource('/user/order', 'OrderController');

Route::post('/user/checkout', 'OrderController@check');
Route::post('/user/checkcard', 'OrderController@checkCard');

Route::get('/view/order/{id}', 'OrderController@show');