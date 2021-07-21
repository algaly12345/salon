<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware'=>['api','checkPassword'],'namespace'=>'Api'],function (){

    Route::get('get-all-category','SalonController@category');
    Route::get('get-salon-categoryId','SalonController@getSalonBayCategoryID');
    Route::get('get-evaluation','SalonController@getEvaluation');



});

Route::group(['middleware'=>['auth:api'],'namespace'=>'Api'],function (){
    Route::post('update','UserController@update');
    Route::get('/user','UserController@current');
    Route::get('get-save-item','SalonController@getSaveIten');
    Route::get('get-view-user','SalonController@getViewUser');

});
Route::post('login','ApiAuthController@login');
Route::post('create','UserController@register');
Route::post('rating','UserController@rate');
Route::post('save-item','UserController@saveItem');
Route::post('add-view','UserController@views');


Route::post('verify-user/', 'UserController@verify');



