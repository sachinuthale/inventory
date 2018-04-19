<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
use Illuminate\Support\Facades\Input;
use App\Models\Product;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('searchProducts/{query}', 'Api/ProductController@getProducts');

Route::get('search',function(){
     $query = Input::get('query');
     $users = Product::where('name','like','%'.$query.'%')->get();
     return response()->json($users);
});
