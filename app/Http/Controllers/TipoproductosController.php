<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Tipoproducto;
use App\Producto;
use App\Proveedore;
use View;
use Redirect;
use Event;
use App\Events\Audit;

class TipoproductosController extends Controller {

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
		
		$tipoproductos = Tipoproducto::paginate(10);
		return View::make('tipoproductos.index')->with('tipoproductos', $tipoproductos);

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		
		return View::make('tipoproductos.create');

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		
		$this->validate($request,[

			'tipo' => 'required|min:4|max:255'

			]);

		try {
			
			$tipoproducto = Tipoproducto::create([

			'tipo' => $request['tipo']

			]);

		} catch (\PDOException $exception) {
			
			return Redirect::back() -> withErrors(['mesagge' => 'Ha ocurrido un error en la consulta '.$exception->getCode()]);

		}
		
		\Event::fire(new Audit($tipoproducto, 'Se ha creado un registro'));
		return Redirect::back() -> with('mensagge', 'Tipo de producto registrado');

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		
		$tipoproducto = Tipoproducto::where('id',  '=', $id)->first();
		return View::make('tipoproductos.show')->with('tipoproducto', $tipoproducto);

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		
		$tipoproducto = Tipoproducto::where('id',  '=', $id)->first();
		return View::make('tipoproductos.edit')->with('tipoproducto', $tipoproducto);

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

			'tipo' => 'required|min:4|max:255'

			]);

		try {

			$tipoproducto = Tipoproducto::find($id);

			$tipoproducto->tipo = $request['tipo'];

			$tipoproducto->save();
			
		} catch (\PDOException $exception) {
			
			return Redirect::back() -> withErrors(['mesagge' => 'Ha ocurrido un error en la consulta '.$exception->getCode()]);

		}
		
		\Event::fire(new Audit($tipoproducto, 'Se ha editado un registro'));
		return Redirect::back() -> with('mensagge', 'Tipo de producto editado');

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

			$tipoproducto = Tipoproducto::findOrFail($id);
			
		} catch (Exception $e) {

			return Response::view('errors/404', array(), 404);
			
		}

		try {
			
			$tipoproducto -> delete();

		} catch (\PDOException $exception) {
			
			return Redirect::back() -> withErrors(['mesagge' => 'Ha ocurrido un error en la consulta '.$exception->getCode()]);

		}
		
		\Event::fire(new Audit($tipoproducto, 'Se ha eliminado un registro'));	
		return Redirect::back() -> with('mensagge_delete', 'Tipo de producto eliminado');

	}

	public function productos($id){

		$tipoproducto = Tipoproducto::find($id);
		$productos = $tipoproducto->productos()->paginate(10);

		return View::make('tipoproductos.productos', ['tipoproducto' => $tipoproducto, 'productos' => $productos]);

	}

	public function proveedores($id){

		$tipoproducto = Tipoproducto::find($id);

		$proveedores = Proveedore::whereHas('productos', function($q) use ($id){

			$q->where('tipoproducto_id', '=', $id);

		})->paginate(10);

		return View::make('tipoproductos.proveedores',['tipoproducto' => $tipoproducto, 'proveedores' => $proveedores]);


	}	

		

}
