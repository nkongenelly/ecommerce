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

Route::get('/categories', 'CategoryController@index');

Route::get('/categories/create', 'CategoryController@create');

Route::post('/categories', 'CategoryController@store');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware'=>'App\Http\Middleware\Admin'],function()
{
    Route::match(['get','post'],'/adminOnlyPage','HomeController@admin');
});

Route::group(['middleware'=>'App\Http\Middleware\Buyer'],function()
{
    Route::match(['get','post'],'/buyerOnlyPage','HomeController@buyer');
});

Route::group(['middleware'=>'App\Http\Middleware\Seller'],function()
{
    Route::match(['get','post'],'/sellerOnlyPage','HomeController@seller');
});
