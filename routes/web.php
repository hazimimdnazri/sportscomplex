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

Route::get('login', 'Auth\LoginController@showLoginForm');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('home', 'HomeController@index')->name('home');
Route::get('dashboard', 'HomeController@dashboard')->middleware('auth');
Route::get('calendar', 'HomeController@calendar')->middleware('auth');
Route::get('application', 'ApplicationController@index')->middleware('auth');
Route::post('application', 'ApplicationController@submitApplication')->middleware('auth');
Route::get('application/{id}', 'ApplicationController@details')->middleware('auth');
Route::post('application/{id}', 'ApplicationController@submitDetails')->middleware('auth');
Route::get('application/payment/{id}', 'ApplicationController@payment')->middleware('auth');
Route::post('application/{id}/facility', 'ApplicationController@submitFacility')->middleware('auth');
Route::post('application/{id}/activity', 'ApplicationController@submitActivity')->middleware('auth');
Route::get('registration', 'HomeController@register')->middleware('auth');
Route::post('registration', 'HomeController@submitRegister')->middleware('auth');
Route::get('transactions', 'HomeController@transactions')->middleware('auth');

Route::get('settings/categories', 'SettingsController@categories')->middleware('auth');
Route::post('settings/categories', 'SettingsController@submitCategory')->middleware('auth');
Route::get('settings/assets', 'SettingsController@assets')->middleware('auth');
Route::post('settings/assets', 'SettingsController@submitAsset')->middleware('auth');
Route::get('settings/activities', 'SettingsController@activities')->middleware('auth');
Route::post('settings/activities', 'SettingsController@submitActivity')->middleware('auth');
Route::get('settings/users', 'SettingsController@users')->middleware('auth');
Route::get('settings/customers', 'SettingsController@customers')->middleware('auth');
Route::get('settings/membership', 'SettingsController@membership')->middleware('auth');
Route::get('settings/profile', 'SettingsController@profile')->middleware('auth');

Route::post('ajax/itemtype', 'ApplicationController@itemType');
Route::post('ajax/activitymodal', 'ApplicationController@activityModal');
Route::post('ajax/detailsmodal', 'ApplicationController@detailsModal');
Route::post('ajax/membershipprice', 'HomeController@ajaxMembershipPrice')->middleware('auth');
Route::post('ajax/submitpayment', 'ApplicationController@ajaxSubmitPayment')->middleware('auth');
Route::post('ajax/setdate', 'ApplicationController@ajaxSetDate')->middleware('auth');
Route::post('ajax/confirmreservation', 'ApplicationController@confirmReservation')->middleware('auth');
