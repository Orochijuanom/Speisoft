@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">{{$sede->nombre}}</div>
				<div class="panel-body">
					@if (Session::get('mensagge_delete'))
						<div class="alert alert-success">
							{{Session::get('mensagge_delete')}}
							<br><br>			
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
										<th>Desvincular</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($proveedores as $proveedor)

										<tr>
											<td data-title='Nombre'><a href="/proveedores/{{$proveedor->proveedore_id}}">{{$proveedor->nombre}}</a></td>
											<td data-title='Nit'>{{$proveedor->nit}}</td>
											<td data-title='Telefono'>{{$proveedor->telefono}}</td>
											<td data-title='Celular'>{{$proveedor->celular}}</td>
											<td data-title='email'>{{$proveedor->email}}</td>
											<td data-title='Tipos de productos'><a href="/proveedores/{{$proveedor->proveedore_id}}/tipo_productos">Ver tipos de productos</a></td>
											<td data-title='Desvincular'>
												<form action='/proveedor_sede/sede/{{$sede->id}}/proveedor/{{$proveedor->proveedore_id}}' method='post'>

													<input name='_method' type='hidden' value='DELETE'>
													<input name='_token' type='hidden' value='{{csrf_token()}}'>
													<button type='submit' class="btn btn-danger">
														Desvincular Sede del proveedor
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

						<p class='alert alert-info'><strong>Whoops!</strong> No se encuetran proveedores relacionados a esta sede en el sistema.</p>

					@endif

					{!!link_to('proveedor_sede/create','Relacionar una sede a un proveedor')!!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
