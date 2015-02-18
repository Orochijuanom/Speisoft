<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Mascota;
use App\Cliente;
use App\Raza;
use View;
use Redirect;

class MascotasController extends Controller {

	public function __construct(){

		$this->middleware('auth');

	} 

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$mascotas = Mascota::with('clientes', 'razas')->paginate(10);
		return View::make('mascotas.index')->with('mascotas', $mascotas);

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		
		$clientes = Cliente::orderBy('nombre', 'ASC')->get();
		$razas = Raza::with('especies')->orderBy('especie_id', 'ASC')->get();
		return View::make('mascotas.create', ['clientes' => $clientes, 'razas' => $razas]);

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		//return $request;	

		$this->validate($request, [

			'nombre' => 'required|min:4|max:255|unique:mascotas,nombre,NULL,id,cliente_id,'.$request['cliente_id'].'',
			'peso' => 'numeric',
			'alzada' => 'numeric',
			'color' => 'min:4|max:50',
			'pelaje' => 'min:4|max:50',
			'cicatrices' => 'max:50',
			'cxesteticas' => 'max:50',
			'tatuajes' => 'max:100',
			'condcorporal' => 'numeric|min:0|max:5',
			'finzootecnico' => 'max:255',
			'entorno' => 'max:100',
			'nutricion' => 'max:100',
			'estilovida' => 'max:50',
			'nacimiento' => 'date|required_with:recordatoriocumple',
			'recordatoriocumple' => 'boolean|required_with:nacimiento',

			]);
		

		Mascota::create([

			'nombre' => $request['nombre'],
			'cliente_id' => $request['cliente_id'],
			'raza_id' => $request['raza_id'],
			'sexo' => $request['sexo'],
			'peso' => $request['peso'],
			'alzada' => $request['alzada'],
			'color' => $request['color'],
			'pelaje' => $request['pelaje'],
			'ciatrices' => $request['cicatrices'],
			'cxesteticas' => $request['cxesteticas'],
			'tatuajes' => $request['tatuajes'],
			'conddorporal' => $request['condcorporal'],
			'finzootecnico' => $request['finzootecnico'],
			'entorno' => $request['entorno'],
			'nutricion' => $request['nutricion'],
			'estilovida' => $request['estilovida'],
			'nacimiento' => $request['nacimiento'],
			'recordatoriocumple' => $request['recordatoriocumple']

			]);

		return redirect('mascotas/create') -> with('mensagge', 'Mascota registrada');

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		
		$clientes = Cliente::orderBy('nombre', 'ASC')->get();
		$razas = Raza::orderBy('especie_id', 'ASC')->get();
		$mascota = Mascota::with('clientes', 'razas')->where('id', '=', $id)->first();
		return View::make('mascotas.show', ['clientes' => $clientes, 'razas' => $razas, 'mascota' => $mascota]);	

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		
		$clientes = Cliente::orderBy('nombre', 'ASC')->get();
		$razas = Raza::orderBy('especie_id', 'ASC')->get();
		$mascota = Mascota::with('clientes', 'razas')->where('id', '=', $id)->first();
		return View::make('mascotas.edit', ['clientes' => $clientes, 'razas' => $razas, 'mascota' => $mascota]);	

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

			'nombre' => 'required|min:4|max:255|unique:mascotas,nombre,'.$id.',id,cliente_id,'.$request['cliente_id'].'',
			'peso' => 'numeric',
			'alzada' => 'numeric',
			'color' => 'min:4|max:50',
			'pelaje' => 'min:4|max:50',
			'cicatrices' => 'max:50',
			'cxesteticas' => 'max:50',
			'tatuajes' => 'max:100',
			'condcorporal' => 'numeric|min:0|max:5',
			'finzootecnico' => 'max:255',
			'entorno' => 'max:100',
			'nutricion' => 'max:100',
			'estilovida' => 'max:50',
			'nacimiento' => 'date|required_with:recordatoriocumple',
			'recordatoriocumple' => 'boolean|required_with:nacimiento'

			]);

		Mascota::where('id', '=', $id)->update([

			'nombre' => $request['nombre'],
			'cliente_id' => $request['cliente_id'],
			'raza_id' => $request['raza_id'],
			'sexo' => $request['sexo'],
			'peso' => $request['peso'],
			'alzada' => $request['alzada'],
			'color' => $request['color'],
			'pelaje' => $request['pelaje'],
			'cicatrices' => $request['cicatrices'],
			'cxesteticas' => $request['cxesteticas'],
			'tatuajes' => $request['tatuajes'],
			'condcorporal' => $request['condcorporal'],
			'finzootecnico' => $request['finzootecnico'],
			'entorno' => $request['entorno'],
			'nutricion' => $request['nutricion'],
			'estilovida' => $request['estilovida'],
			'nacimiento' => $request['nacimiento'],
			'recordatoriocumple' => $request['recordatoriocumple']

			]);

		return redirect('mascotas/'.$id.'/edit') ->with('mensagge', 'Mascota editada');


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

				$mascota = Mascota::findOrFail($id);
				
			} catch (Exception $e) {

				return Response::view('errors/404', array(), 404);
				
			}

			if($destroy = $mascota -> delete()){

				return Redirect::route('mascotas.index') -> with('mensagge_delete', 'Mascota eliminada');

			}else{

				return Response::view('errors/400', array(), 400);

			}
	

	}

}
