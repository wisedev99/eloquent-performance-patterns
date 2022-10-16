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



// Auth::routes();

Route::get('/', 'UserController@index');
Route::get('/login', 'UserController@logins');
Route::get('/feature', 'FeatureContrroller@index');
Route::get('/features/{feature}', 'FeatureContrroller@show');
Route::get('/costumers', 'CustomerController@index');


Route::get('/posts', 'PostController@index');
