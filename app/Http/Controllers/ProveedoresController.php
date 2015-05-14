<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Proveedore;
use App\Tipoproducto;
use View;
use Redirect;
use Event;
use App\Events\Create;
use App\Events\Delete;
use App\Events\Update; 


class ProveedoresController extends Controller {

	public function __construct(){

		$this->middleware('aux');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		
		$proveedores = Proveedore::paginate(10);
		return View::make('proveedores.index')->with('proveedores', $proveedores);

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		
		return View::make('proveedores.create');

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		
		$this->validate($request,[

			'nombre' => 'required|min:4|max:100',
			'nit' => 'required|min:6|max:25|unique:proveedores',
			'telefono' => 'max:15',
			'celular' => 'required|min:4|max:20',
			'email' => 'email|required|max:255'

			]);

		try {

			$proveedor = Proveedore::create([

			'nombre' => $request['nombre'],
			'nit' => $request['nit'],
			'telefono' => $request['telefono'],
			'celular' => $request['celular'],
			'email' => $request['email']

			]);
			
		} catch (\PDOException $exception) {
			
			return redirect('proveedores/create') -> withErrors(['mesagge' => 'Ha ocurrido un error en la consulta '.$exception->getCode()]);

		}
		
		Event::fire(new Create($proveedor));
		return redirect('proveedores/create') -> with('mensagge', 'Proveedor registrado');

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		
		$proveedor = Proveedore::where('id', '=', $id)->first();
		return View::make('proveedores.show')->with('proveedor', $proveedor); 

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{

		$proveedor = Proveedore::where('id', '=', $id)->first();
		return View::make('proveedores.edit')->with('proveedor', $proveedor);
		
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		
		$this->validate($request,[

			'nombre' => 'required|min:4|max:100',
			'nit' => 'required|min:6|max:25|unique:proveedores,nit,'.$id.'',
			'telefono' => 'max:15',
			'celular' => 'required|min:4|max:20',
			'email' => 'email|required|max:255'

			]);
		try {
			
			$proveedor = Proveedore::where('id', '=', $id)->update([

			'nombre' => $request['nombre'],
			'nit' => $request['nit'],
			'telefono' => $request['telefono'],
			'celular' => $request['celular'],
			'email' => $request['email']

			]);

		} catch (\PDOException $exception) {
			
			return redirect('proveedores/'.$id.'/edit') -> withErrors(['mesagge' => 'Ha ocurrido un error en la consulta '.$exception->getCode()]);

		}
		
		Event::fire(new Update($proveedor));
		return redirect('proveedores/'.$id.'/edit') -> with('mensagge', 'Proveedor editado');

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		
		try {

			$proveedor = Proveedore::findOrFail($id);
			
		} catch (Exception $e) {

			return Response::view('errors/404', array(), 404);
			
		}

		try {

			$proveedor -> delete();
			
		} catch (\PDOException $exception) {
			
			return Redirect::route('proveedores.index') -> withErrors(['mesagge' => 'Ha ocurrido un error en la consulta '.$exception->getCode()]);

		}
		
		return Redirect::route('proveedores.index') -> with('mensagge_delete', 'Proveedor eliminado');

	}

	public function productos($id){

		$proveedor = Proveedore::find($id);
		$productos = $proveedor->productos()->paginate(10);

		return View::make('proveedores.productos', ['proveedor' => $proveedor, 'productos' => $productos]);

	}

	public function tipo_productos($id){

		$proveedor = Proveedore::find($id);
		$tipoproducto_id = $proveedor->productos->lists('tipoproducto_id');
		$tipoproductos = Tipoproducto::whereIn('id',$tipoproducto_id)->paginate(10);

		return View::make('proveedores.tipoproductos', ['proveedor' => $proveedor, 'tipoproductos' => $tipoproductos]);

	}

}
