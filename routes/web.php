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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/profiles', 'ProfileController@index');

Route::post('/profiles/update', 'ProfileController@update');

Route::get('/post/create', 'PostController@create');

Route::get('/profiles/edit', 'ProfileController@create');

Route::get('/profiles/{user}', 'ProfileController@show');

Route::post('/post', 'PostController@store');


// Route::post('/profiles', 'PostController@store');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
