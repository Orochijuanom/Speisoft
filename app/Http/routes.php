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

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::resource('/users', 'UsersController', ['only' => ['index', 'destroy']]);

//agregar ruta para ver las mascotas
Route::resource('/clientes', 'ClientesController');
//agregar ruta para ver las razas
Route::resource('/especies', 'EspeciesController');

Route::resource('/razas', 'RazasController');
