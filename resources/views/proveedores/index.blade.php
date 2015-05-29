@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Proveedores</div>
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

					@if(count($proveedores)>0)
						<section id='no-more-tables'>
							<table class='table table-responsive'>
								<thead>
									<tr>
										<th>Nombre</th>
										<th>Nit</th>
										<th>Telefono</th>
										<th>Celular</th>
										<th>Email</th>
										<th>Tipos de productos</th>
										<th>Productos</th>
										<th>Sedes<th>
										<th>Eliminar</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($proveedores as $proveedor)

										<tr>
											<td data-title='Nombre'><a href="proveedores/{{$proveedor->id}}">{{$proveedor->nombre}}</a></td>
											<td data-title='Nit'>{{$proveedor->nit}}</td>
											<td data-title='Telefono'>{{$proveedor->telefono}}</td>
											<td data-title='Celular'>{{$proveedor->celular}}</td>
											<td data-title='email'>{{$proveedor->email}}</td>
											<td data-title='Tipos de productos'><a href="proveedores/{{$proveedor->id}}/tipo_productos">Ver tipos de productos</a></td>
											<td data-title='Productos'><a href="proveedores/{{$proveedor->id}}/productos">Ver productos</a></td>
											<td data-title='Sedes'><a href="proveedores/{{$proveedor->id}}/sedes">Ver Sedes</a></td>
											<td data-title='Eliminar'>
												<form action='/proveedores/{{$proveedor->id}}' method='post'>

													<input name='_method' type='hidden' value='DELETE'>
													<input name='_token' type='hidden' value='{{csrf_token()}}'>
													<button type='submit' class="btn btn-danger">
														Eliminar Proveedor
													</button>
												</form>
											</td>
										</tr>

									@endforeach
								</tbody>

							</table>
							{!!$proveedores->render()!!}
						</section>
					@else

						<p class='alert alert-info'><strong>Whoops!</strong> No se encuetran proveedores en el sistema.</p>

					@endif

					{!!link_to('proveedores/create','Añadir proveedores')!!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection