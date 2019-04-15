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

Route::group(['middleware' => ['auth']], function() {

   /* //rutas usuario
    Route::get('/user', 'UserController@index');
    Route::post('/user/registrar', 'UserController@store');
    Route::put('/user/actualizar', 'UserController@update');
    Route::put('/user/desactivar', 'UserController@desactivar');
    Route::put('/user/activar', 'UserController@activar');
    //rutas cliente
    Route::get('/cliente', 'ClienteController@index');
    Route::post('/cliente/registrar', 'ClienteController@store');
    Route::put('/cliente/actualizar', 'ClienteController@update');
    ///Proveedores
    Route::get('/proveedor', 'ProveedorController@index');
    Route::post('/proveedor/registrar', 'ProveedorController@store');
    Route::put('/proveedor/actualizar', 'ProveedorController@update');
    //rol
    Route::get('/rol', 'RolController@index');
    Route::get('/rol/selectRol', 'RolController@selectRol');*/


    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/', function () {
        return view('home');

    });

    Route::group(['middleware' => ['Administrador']], function () {
        //rutas usuario
        Route::get('/user', 'UserController@index');
        Route::post('/user/registrar', 'UserController@store');
        Route::put('/user/actualizar', 'UserController@update');
        Route::put('/user/desactivar', 'UserController@desactivar');
        Route::put('/user/activar', 'UserController@activar');
        //rutas cliente
        Route::get('/cliente', 'ClienteController@index');
        Route::post('/cliente/registrar', 'ClienteController@store');
        Route::put('/cliente/actualizar', 'ClienteController@update');
        ///Proveedores
        Route::get('/proveedor', 'ProveedorController@index');
        Route::post('/proveedor/registrar', 'ProveedorController@store');
        Route::put('/proveedor/actualizar', 'ProveedorController@update');
        //rol
        Route::get('/rol', 'RolController@index');
        Route::get('/rol/selectRol', 'RolController@selectRol');
    });

    Route::group(['middleware' => ['Cajero']], function () {


    });

    Route::group(['middleware' => ['Vendedor']], function () {


    });

    Route::group(['middleware' => ['Coordinador']], function () {


    });




});






