@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Clientes</div>
				<div class="panel-body">
					@if (Session::get('mensagge_delete'))
						<div class="alert alert-success">
							{{Session::get('mensagge_delete')}}
							<br><br>			
						</div>
					@endif

					@if(count($clientes)>0)
						<section id='no-more-tables'>
							<table class='table table-responsive'>
								<thead>
									<tr>
										<th>Nombre</th>
										<th>Celular</th>
										<th>Email</th>
										<th>Mascotas</th>
										<th>Eliminar</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($clientes as $cliente)

										<tr>
											<td data-title='Nombre'><a href="clientes/{{$cliente->id}}">{{$cliente->nombre}} {{$cliente->apellidos}}</a></td>
											<td data-title='Celular'>{{$cliente->celular}}</td>
											<td data-title='Email'>{{$cliente->email}}</td>
											<td data-title='Mascotas'><a href="clientes/mascotas/{{$cliente->id}}">Ver mascotas</a></td>
											<td data-title='Eliminar'>
												<form action='/clientes/{{$cliente->id}}' method='post'>

													<input name='_method' type='hidden' value='DELETE'>
													<input name='_token' type='hidden' value='{{csrf_token()}}'>
													<button type='submit' class="btn btn-danger">
														Eliminar Cliente
													</button>
											</form>
											</td>
										</tr>

									@endforeach
								</tbody>

							</table>
							{!!$clientes->render()!!}
						</section>
					@else

						<p class='alert alert-info'><strong>Whoops!</strong> No se encuetran clientes en el sistema.</p>

					@endif

					{!!link_to('clientes/create','Añadir clientes')!!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection