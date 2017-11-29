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

Route::get('/','Auth\LoginController@showLoginForm');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/subscribers','SubscriberController');
Route::get('/subscriberdata','SubscriberController@get_subscriber_data')->name('subscriberdata');

Route::resource('/organizations','OrganizationController');
Route::get('/organizationdata','OrganizationController@get_organization_data')->name('organizationdata');

Route::resource('organization-payment','OrganizationpaymentController');
Route::get('organization-payment/{organization}/addpayment','OrganizationpaymentController@create')->name('organization-payment');

Route::resource('subscriber-payment','SubscriberpaymentController');
Route::get('subscriber-payment/{subscriber}/addpayment','SubscriberpaymentController@create')->name('subscriber-payment');