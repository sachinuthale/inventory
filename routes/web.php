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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', function(){
    return View::make('pages.home');
})->name('home');
Route::get('about', function(){
    return View::make('pages.about');
})->name('about')->middleware('auth');;
Route::get('projects', function(){
    return View::make('pages.projects');
})->name('projects');
Route::get('contact', function(){
    return View::make('pages.contact');
})->name('contact');

Route::get('login', 'LabAuth\LoginController@index')->name('login');
Route::get('logout', 'LabAuth\LoginController@logout')->name('logout');
Route::post('loginUser', 'LabAuth\LoginController@checkUser')->name('loginUser');


//Route after login
Route::group(['middleware' => ['auth']], function () {
    //show add product page
    Route::view('product/add_product', 'pages.addProduct')->name('addProduct');
    Route::post('product/store_product', 'ProductController@store')->name('storeProduct');
    Route::get('product/list_products', 'ProductController@show')->name('listProducts');
    Route::get('product/api_list_products', 'ProductController@index')->name('apiListProducts');
});
