@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Sedes</div>
				<div class="panel-body">
					@if (Session::get('mensagge_delete'))
						<div class="alert alert-success">
							{{Session::get('mensagge_delete')}}
							<br><br>			
						</div>
					@endif

					@if (count($errors) > 0)
							<div class="alert alert-danger">
								<strong>Whoops!</strong> Hubo Algunos problemas con tu entrada.<br><br>
								<ul>
									@foreach ($errors->all() as $error)
										<li>{{ $error }}</li>
									@endforeach
								</ul>
							</div>
					@endif

					@if(count($sedes)>0)
						<section id='no-more-tables'>
							<table class='table table-responsive'>
								<thead>
									<tr>
										<th>Nombre</th>
										<th>Direccion</th>
										<th>Telefono</th>
										<th>Email</th>
										<th>Proveedores</th>
										<th>Eliminar</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($sedes as $sede)

										<tr>
											<td data-title='Nombre'><a href="sedes/{{$sede->id}}">{{$sede->nombre}}</a></td>
											<td data-title='Direccion'>{{$sede->direccion}}</td>
											<td data-title='Telefono'>{{$sede->telefono}}</td>
											<td data-title='Email'>{{$sede->email}}</td>
											<td data-title='Proveedores'><a href="sedes/{{$sede->id}}/proveedores">Ver proveedores</a></td>
											<td data-title='Eliminar'>
												<form action='/sedes/{{$sede->id}}' method='post'>

													<input name='_method' type='hidden' value='DELETE'>
													<input name='_token' type='hidden' value='{{csrf_token()}}'>
													<button type='submit' class="btn btn-danger">
														Eliminar sede
													</button>
												</form>
											</td>
										</tr>

									@endforeach
								</tbody>

							</table>
							{!!$sedes->render()!!}
						</section>
					@else

						<p class='alert alert-info'><strong>Whoops!</strong> No se encuetran sedes en el sistema.</p>

					@endif

					{!!link_to('sedes/create','Añadir sedes')!!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection