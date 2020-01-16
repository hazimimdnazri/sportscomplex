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

Route::get('settings/categories', 'Settings\CategoriesController@categories')->middleware('auth');
Route::get('settings/categories/add', 'Settings\CategoriesController@add')->middleware('auth');
Route::get('settings/categories/deactivate/{id}', 'Settings\CategoriesController@deactivate')->middleware('auth');
Route::get('settings/categories/edit/{id}', 'Settings\CategoriesController@edit')->middleware('auth');
Route::post('settings/categories', 'Settings\CategoriesController@submitCategory')->middleware('auth');

Route::get('settings/assets', 'Settings\AssetsController@assets')->middleware('auth');
Route::get('settings/assets/add', 'Settings\AssetsController@add')->middleware('auth');
Route::get('settings/assets/deactivate/{id}', 'Settings\AssetsController@deactivate')->middleware('auth');
Route::get('settings/assets/edit/{id}', 'Settings\AssetsController@edit')->middleware('auth');
Route::post('settings/assets', 'Settings\AssetsController@submitAsset')->middleware('auth');

Route::get('settings/activities', 'Settings\ActivitiesController@activities')->middleware('auth');
Route::post('settings/activities', 'Settings\ActivitiesController@submitActivity')->middleware('auth');
Route::get('settings/activities/add', 'Settings\ActivitiesController@add')->middleware('auth');
Route::get('settings/activities/deactivate/{id}', 'Settings\ActivitiesController@deactivate')->middleware('auth');
Route::get('settings/activities/edit/{id}', 'Settings\ActivitiesController@edit')->middleware('auth');

Route::get('settings/users', 'Settings\UsersController@users')->middleware('auth');
Route::post('settings/users', 'Settings\UsersController@submitUser')->middleware('auth');
Route::get('settings/users/add', 'Settings\UsersController@add')->middleware('auth');
Route::get('settings/users/deactivate/{id}', 'Settings\UsersController@deactivate')->middleware('auth');
Route::get('settings/users/edit/{id}', 'Settings\UsersController@edit')->middleware('auth');

Route::get('settings/customers', 'Settings\CustomersController@customers')->middleware('auth');
Route::post('settings/customers', 'Settings\CustomersController@submitCustomer')->middleware('auth');
Route::get('settings/customers/add', 'Settings\CustomersController@add')->middleware('auth');
Route::get('settings/customers/deactivate/{id}', 'Settings\CustomersController@deactivate')->middleware('auth');
Route::get('settings/customers/edit/{id}', 'Settings\CustomersController@edit')->middleware('auth');

Route::get('settings/membership', 'Settings\MembershipController@membership')->middleware('auth');
Route::post('settings/membership', 'Settings\MembershipController@submitMembership')->middleware('auth');
Route::get('settings/membership/add', 'Settings\MembershipController@add')->middleware('auth');
Route::get('settings/membership/deactivate/{id}', 'Settings\MembershipController@deactivate')->middleware('auth');
Route::get('settings/membership/edit/{id}', 'Settings\MembershipController@edit')->middleware('auth');

Route::get('settings/profile', 'SettingsController@profile')->middleware('auth');

Route::post('ajax/itemtype', 'ApplicationController@itemType');
Route::post('ajax/activitymodal', 'ApplicationController@activityModal');
Route::post('ajax/membershipprice', 'HomeController@ajaxMembershipPrice')->middleware('auth');
Route::post('ajax/submitpayment', 'ApplicationController@ajaxSubmitPayment')->middleware('auth');
Route::post('ajax/setdate', 'ApplicationController@ajaxSetDate')->middleware('auth');
Route::post('ajax/confirmreservation', 'ApplicationController@confirmReservation')->middleware('auth');
Route::post('ajax/editcustomer', 'SettingsController@editCustomer');

Route::get('test', 'ApplicationController@qr');
