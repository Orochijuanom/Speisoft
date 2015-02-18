@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">{{$cliente->nombre}} {{$cliente->apellidos}}</div>
				<div class="panel-body">
					@if (Session::get('mensagge_delete'))
						<div class="alert alert-success">
							{{Session::get('mensagge_delete')}}
							<br><br>			
						</div>
					@endif

					@if(count($mascotas)>0)
						<section id='no-more-tables'>
							<table class='table table-responsive'>
								<thead>
									<tr>
										<th>Nombre</th>
										<th>Raza</th>
										<th>Eliminar</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($mascotas as $mascota)

										<tr>
											<td data-title='Nombre'><a href="mascotas/{{$mascota->id}}">{{$mascota->nombre}}</a></td>
											<td data-title='Raza'>{{$mascota->razas->raza}}</td>
											<td data-title='Eliminar'>
												<form action='/mascotas/{{$mascota->id}}' method='post'>

													<input name='_method' type='hidden' value='DELETE'>
													<input name='_token' type='hidden' value='{{csrf_token()}}'>
													<button type='submit' class="btn btn-danger">
														Eliminar Mscoota
													</button>
												</form>
											</td>
										</tr>

									@endforeach
								</tbody>

							</table>
							{!!$mascotas->render()!!}
						</section>
					@else

						<p class='alert alert-info'><strong>Whoops!</strong> No se encuetran mascotas en el sistema.</p>

					@endif

					{!!link_to('mascotas/create','Añadir mascotas')!!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection