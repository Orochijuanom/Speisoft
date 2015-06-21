<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Proveedore;
use App\Sede;
use View;
use Redirect;
use Response;
use Event;
use App\Events\Audit;

class ProveedorsedesController extends Controller {

	public function __construct(){

		$this->middleware('admin');

	}
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		
		$proveedores = Proveedore::orderBy('id', 'ASC')->get();
		$sedes = Sede::orderBy('id', 'ASC')->get();

		return View::make('proveedorsedes.create', ['proveedores' => $proveedores, 'sedes' => $sedes]);

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		
		$this->validate($request,[

			'proveedore_id' => 'required',
			'sede_id' => 'required'

			]);

		try {

			$proveedor = Proveedore::findOrFail($request['proveedore_id']);

			$sede = Sede::findOrFail($request['sede_id']);
			
		} catch (Exception $e) {
			
			return Response::view('errors/404', array(), 404);

		}

		try {
			
			$sede->proveedores()->attach($request['proveedore_id']);

		} catch (\PDOException $exception) {
			
			return Redirect::back() -> withErrors(['mesagge' => 'Ha ocurrido un error en la consulta '.$exception->getCode()]);

		}

		\Event::fire(new Audit($sede, 'se ha vinculado con '.$proveedor->nombre));
		return Redirect::back() ->with('mensagge', 'proveedor asociado a la sede');

	}

	public function detachsede($proveedore_id, $sede_id)
	{

		try {

			$proveedor = Proveedore::findOrFail($proveedore_id);

			$sede = Sede::findOrFail($sede_id);
			
		} catch (Exception $e) {
			
			return Response::view('errors/404', array(), 404);

		}

		if ($proveedor->sedes()->detach($sede_id)) {
			
			\Event::fire(new Audit($proveedor, 'Se ha desvinculado '.$sede->nombre));
			return Redirect::back() -> with('mensagge_delete', 'Sede desvinculada del proveedor');

		}else{

			return Response::view('errors/400', array(), 400);

		}

	}

	public function detachproveedor($sede_id, $proveedore_id)
	{

		try {
			
			$proveedor = Proveedore::findOrFail($proveedore_id);

			$sede = Sede::findOrFail($sede_id);

		} catch (Exception $e) {
			
			return Response::view('errors/404', array(), 404);

		}

		if ($proveedor->sedes()->detach($sede_id)) {
			
			\Event::fire(new Audit($sede, 'Se ha desvinculado '.$proveedor->nombre));
			return Redirect::back() -> with('mensagge_delete', 'Sede desvinculada del producto');

		}else{

			return Response::view('errors/400', array(), 400);

		}

	}

}
