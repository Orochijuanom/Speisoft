<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Cliente;
use View;
use Redirect;


class ClientesController extends Controller {

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
		
		$clientes = Cliente::paginate(10);
		return View::make('clientes.index')->with('clientes', $clientes);

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

		return View::make('clientes.create');

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{

		$this->validate($request,[

			'nombre' => 'required|min:4|max:255',
			'apellidos' => 'required|max:255',
			'cedula' => 'required|min:8|unique:clientes|numeric',
			'celular' => 'required|min:8|numeric',
			'telefono' => 'min:8|numeric',
			'email' => 'email|min:8|max:255|unique:clientes',
			'direccion' => 'min:8|max:255',
			'bbm' => 'max:255',
			'facebook' => 'url|max:255',
			'profesion' => 'max:255',
			'cumpleanios' => 'date'

			]);
		
		try {

			Cliente::create([

			'nombre' => $request['nombre'],
			'apellidos' => $request['apellidos'],
			'cedula' => $request['cedula'],
			'telefono' => $request['telefono'],
			'celular' => $request['celular'],
			'email' => $request['email'],
			'direccion' => $request['direccion'],
			'bbm' => $request['bbm'],
			'facebook' => $request['facebook'],
			'profesion' => $request['profesion'],
			'cumpleanios' => $request['cumpleanios']

			]);
			
		} catch (\PDOException $exception) {
			
			return redirect('clientes/create') -> withErrors(['mesagge' => 'Ha ocurrido un error en la consulta '.$exception->getCode()]);

		}
		
		return redirect('clientes/create') -> with('mensagge', 'Cliente registrado');

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$cliente = Cliente::where('id', '=', $id)->first();
		return View::make('clientes.show')->with('cliente', $cliente);

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$cliente = Cliente::where('id', '=', $id)->first();
		return View::make('clientes.edit')->with('cliente', $cliente);
		
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

			'nombre' => 'required|min:4|max:255',
			'apellidos' => 'required|max:255',
			'cedula' => 'required|min:8|unique:clientes,cedula,'.$id.'|numeric',
			'celular' => 'required|min:8|numeric',
			'telefono' => 'min:8|numeric',
			'email' => 'email|min:8|max:255|unique:clientes,email,'.$id.'',
			'direccion' => 'min:8|max:255',
			'bbm' => 'max:255',
			'facebook' => 'url|max:255',
			'profesion' => 'max:255',
			'cumpleanios' => 'date'

			]);

		try {
			
			Cliente::where('id', '=', $id)->update([

			'nombre' => $request['nombre'],
			'apellidos' => $request['apellidos'],
			'cedula' => $request['cedula'],
			'telefono' => $request['telefono'],
			'celular' => $request['celular'],
			'email' => $request['email'],
			'direccion' => $request['direccion'],
			'bbm' => $request['bbm'],
			'facebook' => $request['facebook'],
			'profesion' => $request['profesion'],
			'cumpleanios' => $request['cumpleanios']

			]);

		}catch (\PDOException $exception) {
			
			return redirect('clientes/'.$id.'/edit') -> withErrors(['mesagge' => 'Ha ocurrido un error en la consulta '.$exception->getCode()]);

		}

		return redirect('clientes/'.$id.'/edit') -> with('mensagge', 'Cliente editado');
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

				$cliente = Cliente::findOrFail($id);
				
			} catch (Exception $e) {

				return Response::view('errors/404', array(), 404);
				
			}

			try {
				
				$cliente -> delete();

			} catch (\PDOException $exception) {
				
				return Redirect::route('clientes.index') -> withErrors(['mesagge' => 'Ha ocurrido un error en la consulta '.$exception->getCode()]);

			}
			
			return Redirect::route('clientes.index') -> with('mensagge_delete', 'Cliente eliminado');

	}

	public function mascotas($id)
	{

		$cliente = Cliente::find($id);
		$mascotas = $cliente->mascotas()->paginate(10);


		return View::make('clientes.mascotas', ['cliente' => $cliente, 'mascotas' => $mascotas]);

	}

}
