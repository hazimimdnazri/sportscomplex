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
Route::get('/', 'HomeController@index')->middleware('auth');
Route::get('unauthorized', 'HomeController@unauthorized');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('home', 'HomeController@index')->name('home');
Route::get('verify', 'HomeController@verifyAccount');

Route::group(['prefix' => 'guest'], function() {
    Route::get('login', 'Auth\LoginController@showLoginForm');
    Route::get('register', 'HomeController@register');
    Route::post('register', 'HomeController@submitRegister');
    Route::post('login', 'Auth\LoginController@login');
    Route::get('verify', 'HomeController@verify');
});

Route::group(['middleware' => ['auth', "role:1,2"], 'prefix' => 'admin'], function() {
    Route::get('dashboard', 'HomeController@dashboard');
    Route::get('calendar', 'HomeController@calendar');
    Route::get('registration/user', 'HomeController@registerUser');
    Route::post('registration/user', 'HomeController@submitUserRegister');
    Route::get('registration/vendor', 'HomeController@registerVendor');
    Route::post('registration/vendor', 'HomeController@submitRegisterVendor');
    Route::get('transactions', 'HomeController@transactions');
    Route::get('customers', 'HomeController@customers');
    Route::get('customer/{id}/edit', 'HomeController@editCustomer');
    Route::post('customer/{id}/edit', 'HomeController@submitEditCust');
    Route::post('membership/{id}', 'HomeController@renewMembership');

    Route::group(['prefix' => 'application'], function() {
        Route::get('/', 'ApplicationController@index');
        Route::post('approve', 'ApplicationController@applicationApprove');
        Route::post('reject', 'ApplicationController@applicationReject');
        Route::post('quotation/{id}', 'ApplicationController@approveQuotation');
        Route::post('/', 'ApplicationController@submitApplication');
        Route::get('{id}', 'ApplicationController@details');
        Route::post('{id}', 'ApplicationController@submitDetails');
        Route::get('payment/{id}', 'ApplicationController@payment');
        Route::post('payment/{id}', 'ApplicationController@ajaxPayment');
    
        Route::group(['prefix' => 'ajax'], function() {
            Route::post('itemtype-vendor', 'ApplicationController@vendorItemType');
            Route::post('view-modal', 'ApplicationController@viewModal');
            Route::post('payment-modal', 'ApplicationController@paymentModal');
            Route::post('approvequotation', 'ApplicationController@approveQuotation');
            Route::post('confirmpayment', 'ApplicationController@confirmPayment');
            Route::post('delete-item', 'ApplicationController@deleteItem');
        });
    });

    Route::group(['prefix' => 'vendors'], function() {
        Route::get('/', 'HomeController@vendors');
    
    });
    
    Route::group(['prefix' => 'settings'], function() {
        Route::get('venues', 'SettingsController@venues');
        Route::post('venues', 'SettingsController@submitVenue');
        Route::get('facilities', 'SettingsController@facilities');
        Route::post('facilities', 'SettingsController@submitFacility');
        Route::get('sports', 'SettingsController@sports');
        Route::post('sports', 'SettingsController@submitSport');
        Route::get('equiptments', 'SettingsController@equiptments');
        Route::post('equiptments', 'SettingsController@submitEquiptments');
        Route::get('institutions', 'SettingsController@institutions');
        Route::post('institutions', 'SettingsController@submitInstitutions');
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
            Route::post('institutions-modal', 'SettingsController@institutionsModal');
            Route::post('facilities-modal', 'SettingsController@facilitiesModal');
            Route::post('users-modal', 'SettingsController@usersModal');
            Route::post('select-facilities', 'SettingsController@selectFacilities');
            Route::post('changerole', 'SettingsController@changeRole');
        });
    });

    Route::group(['prefix' => 'ajax'], function() {
        Route::post('membership-modal', 'HomeController@membershipModal');
    });
});

Route::group(['middleware' => ['auth', "role:4"], 'prefix' => 'vendor'], function() {
    Route::get('dashboard', 'VendorController@dashboard');
    Route::get('calendar', 'VendorController@calendar');

    Route::group(['prefix' => 'applications'], function() {
        Route::get('/', 'VendorController@application');
        Route::post('new', 'VendorController@applicationNew');
        Route::post('cancel', 'VendorController@applicationCancel');
        Route::get('{id}', 'VendorController@applicationDetails');
    });

    Route::group(['prefix' => 'ajax'], function() {
        Route::post('itemtype', 'VendorController@itemType');
        Route::post('submitreservation', 'VendorController@submitReservation');
        Route::post('acceptreservation', 'VendorController@acceptReservation');
        Route::post('modal-adminApproval', 'VendorController@modalAdminApproval');
    });
});

Route::group(['middleware' => ['auth'], 'prefix' => 'ajax'], function() {
    Route::post('itemtype', 'ApplicationController@itemType');
    Route::post('activitymodal', 'ApplicationController@activityModal');
    Route::post('membershipprice', 'HomeController@ajaxMembershipPrice');
    Route::post('setdate', 'ApplicationController@ajaxSetDate');
    Route::post('confirmreservation', 'ApplicationController@confirmReservation');
    Route::post('calendar', 'HomeController@facilityCalendar');
    Route::post('sports', 'ApplicationController@ajaxSports');
    Route::post('minicalendar', 'ApplicationController@miniCalendar');
    Route::post('deletecustomer', 'HomeController@deleteCustomer');
    Route::post('modal-loading', 'HomeController@loading');

    Route::group(['prefix' => 'application'], function() {
        Route::post('{id}/facility', 'ApplicationController@submitFacility');
        Route::post('{id}/activity', 'ApplicationController@submitActivity');
        Route::post('{id}/equiptment', 'ApplicationController@submitEquiptment');
        Route::post('equiptment/add', 'ApplicationController@addEquiptment');
        Route::post('equiptment/delete', 'ApplicationController@deleteEquiptment');
    });
    
});

Route::get('test', 'ApplicationController@qr');
