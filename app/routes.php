<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});





Route::get('form/create', 'FormController@create');
Route::post('form/store', 'FormController@store');
Route::get('form/list', 'FormController@listdata');

Route::get('form/generatefields/{id}', 'FormController@generateFields')->where('id', '[0-9]+');
Route::post('form/storefields', 'FormController@storefields');

Route::get('form/render/{id}', 'FormController@render')->where('id','[0-9]+');
Route::post('form/storedata', 'FormController@storedata');

Route::get('form/viewdata/{id}', array('as' => 'form_viewdata', 'uses' => 'FormController@viewdata'))->where('id','[0-9]+');



