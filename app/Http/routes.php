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

Route::get('/clientes/{clientes}/mascotas', ['as' => 'clientes.mascotas', 'uses' => 'ClientesController@mascotas']);
Route::resource('/clientes', 'ClientesController');

Route::get('/especies/{especies}/razas',['as' => 'especies.razas', 'uses' => 'EspeciesController@razas']);
Route::resource('/especies', 'EspeciesController');

Route::resource('/razas', 'RazasController');

Route::resource('/mascotas', 'MascotasController');

Route::resource('/sedes', 'SedesController');

Route::get('/proveedores/{proveedores}/productos', ['as' => 'proveedores.productos', 'uses' => 'ProveedoresController@productos']);
Route::get('/proveedores/{proveedores}/tipo_productos',['as' => 'proveedores.tipo_productos', 'uses' => 'ProveedoresController@tipo_productos']);
Route::resource('/proveedores', 'ProveedoresController');

Route::get('/tipo_productos/{tipo_productos}/productos', ['as' => 'tipo_productos.productos', 'uses' => 'TipoproductosController@productos']);
Route::resource('/tipo_productos', 'TipoproductosController');

Route::delete('/producto_proveedor/proveedor/{proveedor}/producto/{producto}', ['as' => 'tipo_productos.detachproducto', 'uses' => 'Productoproveedores@detachproducto']);
Route::resource('/producto_proveedor', 'Productoproveedores', ['only' =>['create', 'store']]);

Route::resource('/productos', 'ProductosController');
