@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">{{$tipoproducto->tipo}}</div>
				<div class="panel-body">
					@if (Session::get('mensagge_delete'))
						<div class="alert alert-success">
							{{Session::get('mensagge_delete')}}
							<br><br>			
						</div>
					@endif

					@if(count($productos)>0)
						<section id='no-more-tables'>
							<table class='table table-responsive'>
								<thead>
									<tr>
										<th>Producto</th>
										<th>Proveedores</th>
										<th>Eliminar</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($productos as $producto)

										<tr>
											<td data-title='Prpducto'><a href="/productos/{{$producto->id}}">{{$producto->producto}}</a></td>
											<td data-title='Proveedores'><a href="/productos/{{$producto->id}}/proveedores">Ver proveedores</a></td>
											<td data-title='Eliminar'>
												<form action='/productos/{{$producto->id}}' method='post'>

													<input name='_method' type='hidden' value='DELETE'>
													<input name='_token' type='hidden' value='{{csrf_token()}}'>
													<button type='submit' class="btn btn-danger">
														Eliminar Producto
													</button>
												</form>
											</td>
										</tr>

									@endforeach
								</tbody>

							</table>
							{!!$productos->render()!!}
						</section>
					@else

						<p class='alert alert-info'><strong>Whoops!</strong> No se encuetran productos relacionados a este tipo de producto en el sistema.</p>

					@endif

					{!!link_to('producto_proveedor/create','Relacionar un producto a un proveedor')!!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection