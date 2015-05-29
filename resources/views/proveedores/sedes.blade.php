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

					@if(count($sedes)>0)
						<section id='no-more-tables'>
							<table class='table table-responsive'>
								<thead>
									<tr>
										<th>Sede</th>
										<th>Desvincular</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($sedes as $sede)

										<tr>
											<td data-title='Sede'><a href="/sedes/{{$sede->sede_id}}">{{$sede->nombre}}</a></td>
											<td data-title='Desvincular'>
												<form action='/proveedor_sede/proveedor/{{$proveedor->id}}/sede/{{$sede->sede_id}}' method='post'>

													<input name='_method' type='hidden' value='DELETE'>
													<input name='_token' type='hidden' value='{{csrf_token()}}'>
													<button type='submit' class="btn btn-danger">
														Desvincular sede del proveedor
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

						<p class='alert alert-info'><strong>Whoops!</strong> No se encuetran sedes relacionados a este proveedor en el sistema.</p>

					@endif

					{!!link_to('proveedor_sede/create','Relacionar una sede a un proveedor')!!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection