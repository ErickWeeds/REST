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

Route::group(['prefix'=>'v1','middleware'=>'auth:api'],function(){
    Route::post('calificacion','CalificacionesController@store');
    Route::get('calificacion/{alumno}','CalificacionesController@show');
    Route::put('calificacion/{idcalificacion}','CalificacionesController@update');
    Route::delete('calificacion/{idcalificacion}','CalificacionesController@destroy');
});

Route::post('register', 'Auth\RegisterController@register');
Route::post('login', 'Auth\LoginController@login');