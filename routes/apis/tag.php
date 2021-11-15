<?php
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'App\Http\Controllers\API', 'prefix' => 'tag'], function () {
    Route::get('all', 'TagController@index');
    Route::post('add', 'TagController@store');
    Route::put('update/{tag}', 'TagController@update');
    Route::get('show/{tag}', 'TagController@show');
    Route::delete('delete/{tag}', 'TagController@destroy');
});