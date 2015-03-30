<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Producto;
use App\Tipoproducto;
use View;
use Redirect;

class ProductosController extends Controller {

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
		
		$productos = Producto::with('tipoproductos')->paginate(10);
		return View::make('productos.index')->with('productos', $productos);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		
		$tipoproductos = Tipoproducto::orderBy('id', 'ASC')->get();
		return View::make('productos.create')->with('tipoproductos', $tipoproductos);

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		
		$this->validate($request, [

			'tipoproducto_id' => 'required',
			'producto' => 'required|min:4|max:80'

			]);

		Producto::create([

			'tipoproducto_id' => $request['tipoproducto_id'],
			'producto' => $request['producto']

			]);

		return redirect('productos/create') -> with('mensagge', 'Producto registrado');

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		
		$producto = Producto::with('tipoproductos')->where('id', '=', $id)->first();
		$tipoproductos = Tipoproducto::orderBy('id', 'ASC')->get();
		return View::make('productos.show', ['producto' => $producto, 'tipoproductos' => $tipoproductos]);

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{

		$producto = Producto::with('tipoproductos')->where('id', '=', $id)->first();
		$tipoproductos = Tipoproducto::orderBy('id', 'ASC')->get();
		return View::make('productos.edit', ['producto' => $producto, 'tipoproductos' => $tipoproductos]);

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

			'tipoproducto_id' => 'required',
			'producto' => 'required|min:4|max:80'

			]);

		Producto::where('id', '=', $id)->update([

			'tipoproducto_id' => $request['tipoproducto_id'],
			'producto' => $request['producto']

			]);

		return redirect('productos/'.$id.'/edit') -> with('mensagge', 'Producto editado');


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

				$producto = Producto::findOrFail($id);
				
			} catch (Exception $e) {

				return Response::view('errors/404', array(), 404);
				
			}

			if($destroy = $producto -> delete()){

				return Redirect::route('productos.index') -> with('mensagge_delete', 'Producto eliminado');

			}else{

				return Response::view('errors/400', array(), 400);

			}

	}

	public function proveedores($id)
	{

		$producto = Producto::find($id);
		$proveedores = $producto->proveedores()->paginate(10);

		return View::make('productos.proveedores', ['producto' => $producto, 'proveedores' => $proveedores]);

	}

}
