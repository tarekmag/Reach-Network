<?php
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'App\Http\Controllers\API', 'prefix' => 'ad', 'middleware' => ['check.advertiser']], function () {
    Route::post('all', 'AdController@index');
    Route::get('show/{ad}', 'AdController@show');
});