<?php

use Illuminate\Support\Facades\Route;

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

/* Route::get('/', function () {
    return view('welcome');
});
 */
Route::get('/', 'Admin\Home\HomeController@index')->name('home');

Route::get('/Category/{slug_categoryname}', 'Admin\Category\CategoryController@index')->name('category');

Route::get('/Product/{slug_productname}', 'Admin\Product\ProductController@index')->name('product');
Route::post('/Search', 'Admin\Product\ProductController@search')->name('search');
Route::get('/Search', 'Admin\Product\ProductController@search')->name('search');

Route::prefix('Basket')->group(function () {
    Route::get('/', 'Admin\Basket\BasketController@index')->name('basket');
    Route::post('/Add', 'Admin\Basket\BasketController@create')->name('basket.add');

});

Route::group(['middleware'=> 'auth'], function(){
    Route::get('/Payment', 'Admin\Payment\PaymentController@index')->name('payment');
    Route::get('/Order', 'Admin\Order\OrderController@index')->name('order');
    Route::get('/Order/{id}', 'Admin\Order\OrderController@detail')->name('order.detail');

});

Route::group(['prefix'=>'User'],function(){
    Route::get('/Login', 'User\UserController@login')->name('user.login');
    Route::post('/Login', 'User\UserController@loginPost');
    Route::post('/Logout', 'User\UserController@logoutPost')->name('user.logout');
    Route::get('/SingUp', 'User\UserController@singUp')->name('user.singup');
    Route::post('/SingUp', 'User\UserController@singUpPost');
 Route::get('/Activate/{key}','User\UserController@activate')->name('user.activate');
});