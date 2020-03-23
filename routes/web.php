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

Route::get('/', 'HomeController@index')->name('home.index');
Route::get('get/user/record/{search_key}', 'HomeController@getRecord')->name('home.get.records');
Route::post('save/user/record', 'HomeController@saveRecords')->name('home.save.records');
//Route::get('get/user/record/null/page=', 'HomeController@getRecord');