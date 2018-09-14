<?php
ini_set('max_execution_time', '300');
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

//Users
Route::get('/users', 'UserController@index');

Route::get('/users/create', 'UserController@create');

Route::post('/users', 'UserController@store');

Route::get('/users/edit/{id}', 'UserController@edit');

Route::patch('/users/update/{id}', 'UserController@update');

Route::get('/users/delete/{id}', 'UserController@destroy');


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
//Buyer Products
Route::get('/productsbuyer', 'ProductController@indexBuyer');

Route::get('/productss/create', 'ProductController@create');  

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

//Orders
// Route::get('/orders/{id}', 'OrderController@index');//for vie cart table format

Route::get('/orders/viewcart', 'OrderController@getCart');

Route::get('/ordersbuyer/{id}', 'OrderController@ordersbuyer');

Route::get('/ordersseller', 'OrderController@ordersseller');//seller view all orders

Route::get('/orderview/{id}/{order}', 'OrderController@orderview');//seller view single order

Route::get('/orderscomplete/{id}/{order}', 'OrderController@orderscomplete');

Route::get('/orders/cart/{id}/{product}', 'OrderController@cart');//for add to cart table format
//for add to cart table format
Route::get('/orders/cart/{id}', 'OrderController@getAddToCart');

Route::get('/orders/create/{id}', 'OrderController@create');//for status placed

Route::post('/orders', 'OrderController@store');

Route::get('/orders/edit/{id}', 'OrderController@edit');

Route::patch('/orders/update/{id}', 'OrderController@update');

Route::get('/orders/delete/{id}', 'OrderController@destroy');

Route::post('/orderitems/{results}', 'OrderController@orderitems');



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


