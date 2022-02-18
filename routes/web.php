<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/establecimiento/create', 'EstablecimientoController@create')->name('establecimient.create');
    Route::post('/establecimiento', 'EstablecimientoController@store')->name('establecimient.store');
    Route::get('/establecimiento/edit', 'EstablecimientoController@edit')->name('establecimient.edit');

    // imágenes
    Route::post('/imagenes/store', 'ImagenController@store')->name('imagenes.store');
    Route::post('/imagenes/destroy', 'ImagenController@destroy')->name('imagenes.destroy');
});
