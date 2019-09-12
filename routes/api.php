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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/produto/create', 'ProdutoController@store');
Route::get('/produto/show/{id}', 'ProdutoController@show');
Route::post('/produto/update/{id}', 'ProdutoController@update');
Route::delete('/produto/delete/{id}', 'ProdutoController@delete');
Route::get('/produtos', 'ProdutoController@index');