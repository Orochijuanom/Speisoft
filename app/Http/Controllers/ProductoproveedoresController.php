<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Producto;
use App\Proveedore;
use View;
use Redirect;
use Response;
use Event;
use App\Events\Audit;


class ProductoproveedoresController extends Controller {

	public function __construct(){

		$this->middleware('aux');

	}
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		
		$productos = Producto::orderBy('id', 'ASC')->get();
		$proveedores = Proveedore::orderBy('id', 'ASC')->get();

		return View::make('productoproveedores.create', ['productos' => $productos, 'proveedores' => $proveedores]);

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		
		$this->validate($request,[

			'producto_id' => 'required',
			'proveedore_id' => 'required'

			]);

		
		try {

				$proveedor = Proveedore::findOrFail($request['proveedore_id']);
				
				$producto = Producto::findOrFail($request['producto_id']);

			} catch (Exception $e) {

				return Response::view('errors/404', array(), 404);
				
			}

		try {

				$proveedor->productos()->attach($request['producto_id']);

			} catch (\PDOException $exception) {
				
				return Redirect::back() -> withErrors(['mesagge' => 'Ha ocurrido un error en la consulta '.$exception->getCode()]);

			}	
		
		\Event::fire(new Audit($proveedor, 'se ha vinculado con  '.$producto->producto));
		return Redirect::back() -> with('mensagge', 'Producto asociado al proveedor');
		

	}

	

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function detachproducto($proveedore_id, $producto_id)
	{
		
		try {

				$proveedor = Proveedore::findOrFail($proveedore_id);

				$producto = Producto::findOrFail($producto_id);
				
			} catch (Exception $e) {

				return Response::view('errors/404', array(), 404);
				
			}

			if($proveedor->productos()->detach($producto_id)){

				\Event::fire(new Audit($proveedor, 'Se ha desviculado '.$producto->producto));
				return Redirect::back() -> with('mensagge_delete', 'Producto desvinculado del proveedor');

			}else{

				return Response::view('errors/400', array(), 400);

			}

	}

	public function detachproveedor($producto_id, $proveedore_id)
	{
		
		try {

				$proveedor = Proveedore::findOrFail($proveedore_id);

				$producto = Producto::findOrFail($producto_id);
				
			} catch (Exception $e) {

				return Response::view('errors/404', array(), 404);
				
			}

			if($proveedor->productos()->detach($producto_id)){

				\Event::fire(new Audit($producto, 'Se ha desvinculado '.$proveedor->nombre));
				return Redirect::back() -> with('mensagge_delete', 'Producto desvinculado del proveedor');

			}else{

				return Response::view('errors/400', array(), 400);

			}

	}


}
