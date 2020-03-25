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

Route::get('user', 'HomeController@index')->name('home.index');
Route::get('get/user/record/{search_key}', 'HomeController@getRecords')->name('home.get.records');
Route::post('save/user/record', 'HomeController@saveRecords')->name('home.save.records');
Route::post('get/user/data', 'HomeController@getRecord');
Route::post('user/bulk/operation', 'HomeController@applyBulkOperation');

Route::get('/', 'LoginController@index');
Route::post('login', 'LoginController@login')->middleware("throttle:4,1");
Route::get('logout', 'LoginController@logout');