<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/',['as' => 'home', 'uses' => 'NewsController@index']);

Route::get('/home',['as' => 'home', 'uses' => 'NewsController@index']);

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::get('/pdfview',['as' => 'newspdf', 'uses' => 'PdfController@newspdf']);

Route::group(['middleware' => ['auth']], function()
{
	// show new news form
	Route::get('new-news','NewsController@create');
	
	// save new news
	Route::post('new-news','NewsController@store');
			
	// delete news
	Route::get('delete/{id}','NewsController@destroy');
	
	// display user's all news
	Route::get('my-all-news','UserController@user_news_all');
	
});

// user account verification
Route::get('user/verify/{email}/{verificationCode}','UserController@verify_user');

//users profile
Route::get('user/{id}','UserController@profile')->where('id', '[0-9]+');

// display list of news
Route::get('user/{id}/news','UserController@user_news')->where('id', '[0-9]+');

// display single news
Route::get('/{slug}',['as' => 'news', 'uses' => 'NewsController@show'])->where('slug', '[A-Za-z0-9-_]+');

