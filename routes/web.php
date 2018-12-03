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




Auth::routes();

Route::get('/colores', 'Catalogos\ColoresController@index');
Route::post('/colores/registrar', 'Catalogos\ColoresController@store');
Route::put('/colores/actualizar', 'Catalogos\ColoresController@update');



Route::group(['middleware' => ['auth']], function() {

   // Route::resource('roles','RolesController');
    //Route::resource('users','UserController');

    Route::get('/user', 'UserController@index');
    Route::post('/user/registrar', 'UserController@store');
    Route::put('/user/actualizar', 'UserController@update');
    Route::put('/user/desactivar', 'UserController@desactivar');
    Route::put('/user/activar', 'UserController@activar');



    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/', function () {
        return view('home');

    });





});






