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

Route::get('/audits', 'AuditsController@index');

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
Route::get('/tipo_productos/{tipo_productos}/proveedores', ['as' => 'tipo_productos.proveedores', 'uses' => 'TipoproductosController@proveedores']);
Route::resource('/tipo_productos', 'TipoproductosController');

//formato ruta detach /ruta_del_controlador/vista_desde_la_que_se_desvicuncula/{id}/item_que_se_desvincula/{id}
Route::delete('/producto_proveedor/proveedor/{proveedor}/producto/{producto}', ['as' => 'producto_proveedor.detachproducto', 'uses' => 'Productoproveedores@detachproducto']);
Route::delete('/producto_proveedor/producto/{producto}/proveedor/{proveedor}', ['as' => 'producto_proveedor.detachproveedor', 'uses' => 'Productoproveedores@detachproveedor']);
Route::resource('/producto_proveedor', 'Productoproveedores', ['only' =>['create', 'store']]);

Route::get('/productos/{productos}/proveedores', ['as' => 'productos.proveedores', 'uses' => 'ProductosController@proveedores']);
Route::resource('/productos', 'ProductosController');

Route::delete('/proveedor_sede/proveedor/{proveedor}/sede/{sede}', ['as' => 'proveedor_sede.detachsede', 'uses' => 'Proveedorsedes@detachsede']);
Route::delete('proveedor_sede/sede/{sede}/proveedor/{proveedor}', ['as' => 'proveedor_sede.detachproveedor', 'uses' => 'Proveedorsedes@detachproveedor']);
Route::resource('/proveedor_sede', 'Proveedorsedes', ['only' => ['create', 'store']]);
