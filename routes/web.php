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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Category;
use App\Product;
use App\User;
use App\Feature;
use App\FeatureProduct;

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

//Products
Route::get('/products/{id}', 'ProductController@index');

Route::get('/productss/create', 'ProductController@create');  

// Route::get('/featuress/create', function () {
//     dd("hallo");
// $user = auth()->user();
// return view('features.createF',compact('user'));
// });

Route::post('/products', 'ProductController@store');

Route::get('/products/edit/{id}', 'ProductController@edit');

Route::get('/products/features/{id}', 'ProductController@features');

Route::patch('/products/update/{id}', 'ProductController@update');

Route::get('/products/delete/{id}', 'ProductController@destroy');

//Features
Route::get('/features/{id}', 'FeatureController@index');

Route::get('/featuress/create', 'FeatureController@create');

Route::post('/features', 'FeatureController@store');

Route::get('/features/edit/{id}', 'FeatureController@edit');

Route::patch('/features/update/{id}', 'FeatureController@update');

Route::get('/features/delete/{id}', 'FeatureController@destroy');

//ProductFeatures
Route::post('/productfeatures/{id}', 'ProductFeatureController@store');

Route::get('/productfeatures/create/{id}', 'ProductFeatureController@create');

Route::patch('/productfeatures/update/{id}', 'ProductFeatureController@update');

Route::get('/productfeatures/{id}', 'ProductFeatureController@edit');

Route::patch('/productfeatures/update/{id}', 'ProductFeatureController@update');

Route::get('/productfeatures/delete/{id}', 'ProductFeatureController@destroy');

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


