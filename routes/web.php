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



Route::post('/postlogin','AuthController@postlogin');
 Route::get('/logout', 'AuthController@logout' );
Route::get('/','AuthController@login')->name('login');



Route::middleware('auth')->group(function () {
 Route::get('/dashboard', 'AdminController@dashboard' );
 Route::get('/menu','MenuController@menu');
 Route::post('/menu/create','MenuController@create');
 Route::post('/menu/edit','MenuController@edit');
 Route::post('/menu/delete','MenuController@delete');


 Route::get('/order','OrderController@order');
  Route::post('/order/createorder','OrderController@createorder');
  Route::post('/order/payment','OrderController@payment');

 Route::get('/warehouse','WarehouseController@warehouse');
Route::post('/warehouse/create','WarehouseController@createwarehouse');

});