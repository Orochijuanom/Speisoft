@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">{{$proveedor->nombre}}</div>
				<div class="panel-body">
					@if (Session::get('mensagge_delete'))
						<div class="alert alert-success">
							{{Session::get('mensagge_delete')}}
							<br><br>			
						</div>
					@endif

					@if(count($tipoproductos)>0)
						<section id='no-more-tables'>
							<table class='table table-responsive'>
								<thead>
									<tr>
										<th>Tipo</th>
										<th>Productos</th>
										<th>Eliminar</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($tipoproductos as $tipoproducto)

										<tr>
											<td data-title='Tipo'><a href="/tipo_productos/{{$tipoproducto->id}}">{{$tipoproducto->tipo}}</a></td>
											<td data-title='Producto'><a href="/tipo_productos/{{$tipoproducto->id}}/productos">Ver productos</a></td>
											<td data-title='Eliminar'>
												<form action='/tipo_productos/{{$tipoproducto->id}}' method='post'>

													<input name='_method' type='hidden' value='DELETE'>
													<input name='_token' type='hidden' value='{{csrf_token()}}'>
													<button type='submit' class="btn btn-danger">
														Eliminar Tipo de producto
													</button>
												</form>
											</td>
										</tr>

									@endforeach
								</tbody>

							</table>
							{!!$tipoproductos->render()!!}
						</section>
					@else

						<p class='alert alert-info'><strong>Whoops!</strong> No se encuetran tipos de productos relacionados a este proveedor en el sistema.</p>

					@endif

					{!!link_to('producto_proveedor/create','Relacionar un producto a un proveedor')!!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection