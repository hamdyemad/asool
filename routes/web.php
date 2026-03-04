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

Auth::routes();
Route::get('/logout', 'LexaAdmin@logout');

// Public API Routes for Landing Page
Route::prefix('api/public')->group(function () {
    Route::get('categories', 'Api\CatalogApiController@categories');
    Route::get('categories/{id}', 'Api\CatalogApiController@category');
    Route::get('subcategories', 'Api\CatalogApiController@subcategories');
    Route::get('subcategories/{id}', 'Api\CatalogApiController@subcategory');
    Route::get('products', 'Api\CatalogApiController@products');
    Route::get('products/{id}', 'Api\CatalogApiController@product');
});

// Categories Routes
Route::middleware('auth')->group(function () {
    Route::resource('categories', 'CategoryController');
    Route::resource('subcategories', 'SubCategoryController');
    
    // API endpoints for Select2 with pagination
    Route::get('api/categories/search', 'CategoryController@searchForSelect2')->name('categories.search');
    Route::get('api/subcategories/search', 'SubCategoryController@searchForSelect2')->name('subcategories.search');
    Route::get('api/subcategories/category/{categoryId}', 'SubCategoryController@getByCategory')->name('subcategories.byCategory');
    
    Route::resource('products', 'ProductController');
    Route::delete('products/{product}/images/{image}', 'ProductController@deleteImage')->name('products.deleteImage');
});

// Render perticular view file by foldername and filename and all passed in only one controller at a time
Route::get('{folder}/{file}', 'LexaAdmin@index');

// when render first time project redirect
Route::get('/home', function () {
    return redirect('dashboard/index');
});

Route::get('/keep-live', "LexaAdmin@live");

// when render first time project redirect
Route::get('/', function () {
    return view('front.landing');
})->name('home');

Route::get('/product-details', function () {
    return view('front.product-details');
})->name('product.details');

Route::get('/solutions', function () {
    return view('front.solutions');
});

Route::get('/home', function () {
    return redirect('dashboard/index');
});
