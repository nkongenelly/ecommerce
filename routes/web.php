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
//Categories

Route::get('/categories', 'CategoryController@index');

Route::get('/categories/create', 'CategoryController@create');

Route::post('/categories', 'CategoryController@store');

Route::get('/categories/edit/{id}', 'CategoryController@edit');

Route::patch('/categories/update/{id}', 'CategoryController@update');

Route::get('/categories/delete/{id}', 'CategoryController@destroy');

//Users
Route::get('/users', 'UserController@index');

Route::get('/users/create', 'UserController@create');

Route::post('/users', 'UserController@store');

Route::get('/users/edit/{id}', 'UserController@edit');

Route::patch('/users/update/{id}', 'UserController@update');

Route::get('/users/delete/{id}', 'UserController@destroy');

//Products
Route::get('/products', 'ProductController@index');

Route::get('/products/create', 'ProductController@create');

Route::post('/products', 'ProductController@store');

Route::get('/products/edit/{id}', 'ProductController@edit');

Route::get('/products/features/{id}', 'ProductController@features');

Route::patch('/products/update/{id}', 'ProductController@update');

Route::get('/products/delete/{id}', 'ProductController@destroy');

//Features
Route::get('/features', 'FeatureController@index');

Route::get('/features/create', 'FeatureController@create');

Route::post('/features', 'FeatureController@store');

Route::get('/features/edit/{id}', 'FeatureController@edit');

Route::patch('/features/update/{id}', 'FeatureController@update');

Route::get('/features/delete/{id}', 'FeatureController@destroy');

//ProductFeatures
Route::post('/productfeatures', 'ProductFeatureController@store');

Route::patch('/productfeatures/update/{id}', 'ProductFeatureController@update');

//Auth and middlewre

Auth::routes();

Route::get('/home', 'HomeController@index');

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


