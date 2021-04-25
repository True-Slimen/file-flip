<?php

use Illuminate\Support\Facades\Auth;
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

Route::view('/', 'home');

Route::view('/help', 'help');

Route::view('/contact', 'contact');

Route::view('/sign-in', '/sign-in/index');

Route::view('/sign-up', '/sign-up/index');

Route::view('/dashboard', '/dashboard/dashboard');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
