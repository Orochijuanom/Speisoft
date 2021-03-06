<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Especie;
use App\Raza;
use View;
use Redirect;
use Event;
use App\Events\Audit;

class RazasController extends Controller {

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

		$razas = Raza::with('especies')->paginate(15);
		return View::make('razas.index')->with('razas', $razas);

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		
		$especies = Especie::orderBy('id', 'ASC')->get();
		return View::make('razas.create')->with('especies', $especies);

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		
		$this->validate($request,[

			'especie_id' => 'required',
			'raza' => 'required|min:4|max:255|unique:razas'

			]);

		try {

			$raza = Raza::create([

			'especie_id' => $request['especie_id'],
			'raza' => $request['raza']

			]);
			
		} catch (\PDOException $exception) {
			
			return Redirect::back() -> withErrors(['mesagge' => 'Ha ocurrido un error en la consulta '.$exception->getCode()]);

		}
		
		\Event::fire(new Audit($raza, 'Se ha creado un registro'));		
		return Redirect::back() -> with('mensagge', 'Raza registrada');

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{

		$raza = Raza::with('especies')->where('id', '=', $id)->first();
		$especies = Especie::orderBy('id', 'ASC')->get();
		return View::make('razas.show', ['raza' => $raza, 'especies' => $especies]);

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$raza = Raza::with('especies')->where('id', '=', $id)->first();
		$especies = Especie::orderBy('id', 'ASC')->get();
		return View::make('razas.edit', ['raza' => $raza, 'especies' => $especies]);
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

			'especie_id' => 'required',
			'raza' => 'required|min:4|max:255|unique:razas,raza,'.$id.''

			]);
		
		try {
			
			$raza = Raza::find($id);

			$raza->especie_id = $request['especie_id'];
			$raza->raza = $request['raza'];

			$raza->save();

		} catch (\PDOException $exception) {
			
			return Redirect::back() -> withErrors(['mesagge' => 'Ha ocurrido un error en la consulta '.$exception->getCode()]);
		}
		
		\Event::fire($raza, 'Se ha editado un registro');
		return Redirect::back() -> with('mensagge', 'Raza editada');

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

				$raza = Raza::findOrFail($id);
				
			} catch (Exception $e) {

				return Response::view('errors/404', array(), 404);
				
			}

			try {
				
				$raza -> delete();

			} catch (\PDOException $exception) {
				
				return Redirect::back() -> withErrors(['mesagge' => 'Ha ocurrido un error en la consulta '.$exception->getCode()]);
			}
			
			\Event::fire(new Audit($raza, 'Se ha eliminado un registro'));
			return Redirect::back()-> with('mensagge_delete', 'raza eliminada');

			
	}

}
