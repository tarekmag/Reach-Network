<?php
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'App\Http\Controllers\API', 'prefix' => 'category'], function () {
    Route::get('all', 'CategoryController@index');
    Route::post('add', 'CategoryController@store');
    Route::put('update/{category}', 'CategoryController@update');
    Route::get('show/{category}', 'CategoryController@show');
    Route::delete('delete/{category}', 'CategoryController@destroy');
});