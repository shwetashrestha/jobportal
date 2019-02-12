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
//user
Route::post('login', 'UserController@login');
Route::post('register', 'UserController@register');
Route::group(['middleware' => 'auth:api'], function(){
    $this->get('users', 'UserController@index');
    $this->group(['prefix' => 'user'], function() {
        Route::get('/{user}', 'UserController@details');
        Route::delete('/{user}','UserController@destroy');
        
    });
    //job
   
    $this->get('jobs','JobController@index');

    $this->group(['prefix' => 'job'], function() {
        $this->post('/', 'JobController@store');
        $this->post('/update/{jobs}','JobController@update');  
        $this->delete('/delete/{jobs}','JobController@destroy');
       
     });

});