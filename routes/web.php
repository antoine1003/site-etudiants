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

/*Route::group(['prefix' => LaravelLocalization::setLocale()], function()
{
	/** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
	/*Route::get('/',  'WelcomeController@index' )->name('index');
	Route::get('email-verification/error', 'Auth\RegisterController@getVerificationError')->name('email-verification.error');
	Route::get('email-verification/check/{token}', 'Auth\RegisterController@getVerification')->name('email-verification.check');
	Auth::routes();
});*/


Route::get('/',  'WelcomeController@index' )->name('index');
Route::get('email-verification/error', 'Auth\RegisterController@getVerificationError')->name('email-verification.error');
Route::get('email-verification/check/{token}', 'Auth\RegisterController@getVerification')->name('email-verification.check');
Route::get('email-verification/resend/{email}', 'Auth\LoginController@resendVerification')->name('email-verification.resend');
Route::get('logout', 'Auth\LoginController@logoutGet')->name('logout-get');

Route::group(['prefix' => 'user','middleware' => 'auth'], function() {
    Route::get('dashboard', 'UserController@dashboard')->name('user.dashboard')->middleware('UserHasRole');
    Route::get('profile', 'UserController@profile')->name('user.profile')->middleware('UserHasRole');
    Route::get('inbox/{id?}/{nb_message?}', 'UserController@inbox')->name('user.inbox')->middleware('UserHasRole')->where('id', '[0-9]+');
    Route::post('inbox', 'UserController@inboxPost')->name('user.inbox.post')->middleware('UserHasRole');
    Route::post('welcome/3/{type}', 'UserController@welcomePost')->name('user.welcome-post')->where('id', '[0-9]+');
    Route::get('welcome/{id}/{type?}/{categorie?}/{classe?}', 'UserController@welcome')->name('user.welcome')->where('id', '[0-9]+');
    Route::get('manageFriends', 'UserController@manageFriends')->name('user.manageFriends')->where('id', '[0-9]+');
    Route::get('calendar', 'UserController@calendar')->name('user.calendar')->where('id', '[0-9]+');
    Route::post('addFriend', 'UserController@addFriend')->name('user.addFriend')->middleware('UserHasRole');
    Route::post('handleFriends', 'UserController@handleFriends')->name('user.handleFriends');
    Route::post('mooveEvent', 'UserController@mooveEvent')->name('user.mooveEvent');
    Route::post('readNotification', 'UserController@readNotification')->name('user.readNotification');
  });  

Route::group(['prefix' => 'mobile'], function() {
    Route::post('connection', 'MobileController@connection');
    Route::post('getConversationsWithFullname', 'MobileController@getConversationsWithFullname');
    Route::post('getAllUsers', 'MobileController@getAllUsers');
    Route::post('getUserInfoById', 'MobileController@getUserInfoById');
    Route::post('getUserInfoByEmail', 'MobileController@getUserInfoByEmail');
    Route::post('getMessagesByUserWithConv', 'MobileController@getMessagesByUserWithConv');
    Route::post('passwordUpdate', 'MobileController@passwordUpdate');    
    Route::post('addMessageInConversation', 'MobileController@addMessageInConversation');
    Route::post('handleFriends', 'MobileController@handleFriends');
    Route::post('getPendingFriendships', 'MobileController@getPendingFriendships');
});

Route::get('maintenance',function() {
	return view('errors.maintenance');
})->name('maintenance');

Auth::routes();