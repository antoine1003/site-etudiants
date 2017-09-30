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
    //Route::get('welcome/3/{type}', 'UserController@welcomeGetDisplay')->name('user.welcome-get')->where('id', '[0-9]+');
    Route::post('welcome/3/{type}', 'UserController@welcomePost')->name('user.welcome-post')->where('id', '[0-9]+');
    Route::get('welcome/{id}/{type?}/{categorie?}/{classe?}', 'UserController@welcome')->name('user.welcome')->where('id', '[0-9]+');
    
});

Route::get('maintenance',function() {
	return view('errors.maintenance');
})->name('maintenance');

Auth::routes();