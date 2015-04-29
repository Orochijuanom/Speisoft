<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Sede;
use View;
use Redirect;

class SedesController extends Controller {

	public function __construct() {

		$this->middleware('admin');

	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$sedes = Sede::paginate(5);
		return View::make('sedes.index')->with('sedes', $sedes);

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		
		return View::make('sedes.create');

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		
		$this->validate($request, [

			'nombre' => 'required|max:255|unique:sedes',
			'direccion' => 'required|min:4|max:255',
			'telefono' => 'required|numeric',
			'email' => 'required|email|max:70',
			'encargado' => 'required|max:255',
			'nit' => 'required|max:25'

			]);

		try {
			
			Sede::create([

			'nombre' => $request['nombre'],
			'direccion' => $request['direccion'],
			'telefono' => $request['telefono'],
			'email' => $request['email'],
			'encargado' => $request['encargado'],
			'nit' => $request['nit']

			]);

		} catch (\PDOException $exception) {
			
			return redirect('sedes/create') -> withErrors(['mesagge' => 'Ha ocurrido un error en la consulta '.$exception->getCode()]);

		}
		

		return redirect('sedes/create') -> with('mensagge', 'Sede registrada');

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		
		$sede = Sede::where('id', '=', $id)->first();
		return View::make('sedes.show') -> with('sede', $sede);

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		
		$sede = Sede::where('id', '=', $id)->first();
		return View::make('sedes.edit') -> with('sede', $sede);

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		
		$this->validate($request, [

			'nombre' => 'required|max:255|unique:sedes,nombre,'.$id.'',
			'direccion' => 'required|min:4|max:255',
			'telefono' => 'required|numeric',
			'email' => 'required|email|max:70',
			'encargado' => 'required|max:255',
			'nit' => 'required|max:25'

			]);

		try {
			
			Sede::where('id', '=', $id)->update([

			'nombre' => $request['nombre'],
			'direccion' => $request['direccion'],
			'telefono' => $request['telefono'],
			'email' => $request['email'],
			'encargado' => $request['encargado'],
			'nit' => $request['nit']

			]);

		} catch (\PDOException $exception) {
			
			return redirect('sedes/'.$id.'/edit') -> withErrors(['mesagge' => 'Ha ocurrido un error en la consulta '.$exception->getCode()]);

		}
		

		return redirect('sedes/'.$id.'/edit') -> with('mensagge', 'Sede editada');

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

			$sede = Sede::findOrFail($id);
			
		} catch (Exception $e) {

			return Response::view('errors/404', array(), 404);
			
		}

		try {
			
			$sede -> delete();

		} catch (\PDOException $exception) {
			
			return Redirect::route('sedes.index') -> withErrors(['mesagge' => 'Ha ocurrido un error en la consulta '.$exception->getCode()]);

		}
		
			
		return Redirect::route('sedes.index') -> with('mensagge_delete', 'Sede eliminada');

		}

}
