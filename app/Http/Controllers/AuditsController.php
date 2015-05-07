<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use View;
use App\Audit;

class AuditsController extends Controller {

	public function __construct(){

		$this->middleware('admin');

	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		
		$audits = Audit::with('users')->orderBy('fecha', 'DESC')->paginate(10);
		return View::make('audits.index')->with('audits', $audits);

	}

	

}
