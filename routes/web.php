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
Route::get('registration', 'HomeController@register')->middleware('auth');
Route::post('registration', 'HomeController@submitRegister')->middleware('auth');
Route::get('transactions', 'HomeController@transactions')->middleware('auth');

Route::group(['prefix' => 'application'], function() {
    Route::get('/', 'ApplicationController@index')->middleware('auth');
    Route::post('/', 'ApplicationController@submitApplication')->middleware('auth');
    Route::get('{id}', 'ApplicationController@details')->middleware('auth');
    Route::post('{id}', 'ApplicationController@submitDetails')->middleware('auth');
    Route::get('payment/{id}', 'ApplicationController@payment')->middleware('auth');
    Route::post('payment/{id}', 'ApplicationController@ajaxPayment')->middleware('auth');
    Route::post('{id}/facility', 'ApplicationController@submitFacility')->middleware('auth');
    Route::post('{id}/activity', 'ApplicationController@submitActivity')->middleware('auth');
    Route::post('{id}/equiptment', 'ApplicationController@submitEquiptment')->middleware('auth');

    Route::group(['prefix' => 'ajax'], function() {
        Route::post('deletefacility', 'ApplicationController@deleteFacility');
        Route::post('addequiptment', 'ApplicationController@addEquiptment');
    });
});

Route::group(['middleware' => ['auth'], 'prefix' => 'settings'], function() {
    Route::get('venues', 'SettingsController@venues');
    Route::post('venues', 'SettingsController@submitVenue');
    Route::get('facilities', 'SettingsController@facilities');
    Route::post('facilities', 'SettingsController@submitFacility');
    Route::get('sports', 'SettingsController@sports');
    Route::post('sports', 'SettingsController@submitSport');
    Route::get('equiptments', 'SettingsController@equiptments');
    Route::post('equiptments', 'SettingsController@submitEquiptments');
    Route::get('activities', 'SettingsController@activities');
    Route::post('activities', 'SettingsController@submitActivity');
    Route::get('users', 'SettingsController@users');
    Route::post('users', 'SettingsController@submitUser');
    Route::get('customers', 'SettingsController@customers');
    Route::post('customers', 'SettingsController@submitEditCustomer');
    Route::get('membership', 'SettingsController@membership');
    Route::post('membership', 'SettingsController@submitMembership');
    Route::get('profile', 'SettingsController@profile');

    Route::group(['prefix' => 'ajax'], function() {
        Route::post('venues-modal', 'SettingsController@venuesModal');
        Route::post('sports-modal', 'SettingsController@sportsModal');
        Route::post('activities-modal', 'SettingsController@activitiesModal');
        Route::post('memberships-modal', 'SettingsController@membershipsModal');
        Route::post('equiptments-modal', 'SettingsController@equiptmentsModal');
        Route::post('facilities-modal', 'SettingsController@facilitiesModal');
        Route::post('select-facilities', 'SettingsController@selectFacilities');
    });
});

Route::group(['middleware' => ['auth'], 'prefix' => 'ajax'], function() {
    Route::post('itemtype', 'ApplicationController@itemType');
    Route::post('activitymodal', 'ApplicationController@activityModal');
    Route::post('membershipprice', 'HomeController@ajaxMembershipPrice')->middleware('auth');
    Route::post('submitpayment', 'ApplicationController@ajaxSubmitPayment')->middleware('auth');
    Route::post('setdate', 'ApplicationController@ajaxSetDate')->middleware('auth');
    Route::post('confirmreservation', 'ApplicationController@confirmReservation')->middleware('auth');
    Route::post('editcustomer', 'SettingsController@editCustomer');
    Route::post('calendar', 'HomeController@facilityCalendar');
    Route::post('sports', 'ApplicationController@ajaxSports');
});

Route::get('test', 'ApplicationController@qr');
