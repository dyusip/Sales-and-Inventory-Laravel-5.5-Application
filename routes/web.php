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
    $inventories = \App\Inventory::all();
    return view('User.home',compact('inventories'));
});
Route::get('/sales','SalesController@index');//Sales Controller
Route::get('/sales/{id}','SalesController@show_item');//Sales select product
Route::post('/sales','SalesController@store');//Sales store/save
//Sales Report Route
Route::get('/report','SalesReportController@index');
Route::post('/report','SalesReportController@show');