<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Tipoproducto;
use View;
use redirect;

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

		Tipoproducto::create([

			'especie' => $request['tipo']

			]);

		return redirect('tipoproductos/create') -> with('mensagge', 'Tipo de producto registrado');

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

		Tipoproducto::where('id', '=', $id)->update([

			'especie' => $request['tipo']

			]);

		return redirect('tipoproductos/'.$id.'/edit') -> with('mensagge', 'Tipo de producto editado');

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

		if ($destroy = $tipoproducto -> delete()) {
			
			return Redirect::route('tipoproducto.index') -> with('mensagge_delete', 'Tipo de producto eliminado');

		}else{

			return Response::view('errors/404', array(), 400);
		}

	}

}