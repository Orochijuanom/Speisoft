<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Especie;
use View;
use Redirect;
use Event;
use App\Events\Audit;

class EspeciesController extends Controller {

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
		$especies = Especie::paginate(10);
		return View::make('especies.index')->with('especies', $especies);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		
		return View::make('especies.create');

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		
		$this->validate($request,[

			'especie' => 'required|min:4|max:255|unique:especies'

			]);

		try {
			
			$especie = Especie::create([

			'especie' => $request['especie']

			]);


		}catch (\PDOException $exception) {
			
			return Redirect::back() -> withErrors(['mesagge' => 'Ha ocurrido un error en la consulta '.$exception->getCode()]);

		}
		
		\Event::fire(new Audit($especie, 'Se ha creado un registro'));
		return Redirect::back() -> with('mensagge', 'Especie registrada'); 

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		
		$especie = Especie::where('id', '=', $id)->first();
		return View::make('especies.show')->with('especie', $especie);

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		
		$especie = Especie::where('id', '=', $id)->first();
		return View::make('especies.edit')->with('especie', $especie);

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

			'especie' => 'required|min:4|max:255|unique:especies,especie,'.$id.''

			]);

		try {

			$especie = Especie::find($id);

			$especie->especie = $request['especie'];

			$especie->save();

			
			
		}catch (\PDOException $exception) {
			
			return Redirect::back() -> withErrors(['mesagge' => 'Ha ocurrido un error en la consulta '.$exception->getCode()]);

		}
		
		\Event::fire(new Audit($especie, 'Se ha editado un registro'));
		return Redirect::back() -> with('mensagge', 'Especie editada');

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

			$especie = Especie::findOrFail($id);
			
		} catch (Exception $e) {

			return Response::view('errors/404', array(), 404);
			
		}

		try {
			
			$especie -> delete();

		}catch (\PDOException $exception) {
			
			return Redirect::back() -> withErrors(['mesagge' => 'Ha ocurrido un error en la consulta '.$exception->getCode()]);

		}
		
		\Event::fire(new Audit($especie, 'Se ha eliminado un registro'));
		return Redirect::back() -> with('mensagge_delete', 'Especie eliminada');

	}

	public function razas($id){

		$especie = Especie::find($id);
		$razas = $especie->razas()->paginate(10);


		return View::make('especies.razas',['especie' => $especie,  'razas' => $razas]);

	}

}
