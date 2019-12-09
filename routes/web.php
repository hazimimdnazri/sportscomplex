<?php

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
Route::get('/', 'HomeController@index');

Route::get('register', 'HomeController@register');
Route::post('register', 'HomeController@submitRegister');
Route::get('login', 'Auth\LoginController@showLoginForm');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('home', 'HomeController@index')->name('home');
Route::get('dashboard', 'HomeController@dashboard')->middleware('auth');
Route::get('calendar', 'HomeController@calendar')->middleware('auth');
Route::get('application', 'ApplicationsController@index')->middleware('auth');
Route::post('application', 'ApplicationsController@submitApplication')->middleware('auth');

Route::get('settings/assets', 'SettingsController@assets')->middleware('auth');
Route::post('settings/assets', 'SettingsController@submitAsset')->middleware('auth');
Route::get('settings/users', 'SettingsController@users')->middleware('auth');
Route::get('settings/profile', 'SettingsController@profile')->middleware('auth');