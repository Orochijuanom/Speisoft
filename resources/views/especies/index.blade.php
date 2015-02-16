@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Especies</div>
				<div class="panel-body">
					@if (Session::get('mensagge_delete'))
						<div class="alert alert-success">
							{{Session::get('mensagge_delete')}}
							<br><br>			
						</div>
					@endif

					@if(count($especies)>0)
						<section id='no-more-tables'>
							<table class='table table-responsive'>
								<thead>
									<tr>
										<th>Especie</th>
										<th>Razas</th>
										<th>Eliminar</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($especies as $especie)

										<tr>
											<td data-title='Especie'><a href="especies/{{$especie->id}}">{{$especie->especie}}</a></td>
											<td data-title='Razas'><a href="especies/razas/{{$especie->id}}">Ver razas</a></td>
											<td data-title='Eliminar'>
												<form action='/especies/{{$especie->id}}' method='post'>

													<input name='_method' type='hidden' value='DELETE'>
													<input name='_token' type='hidden' value='{{csrf_token()}}'>
													<button type='submit' class="btn btn-danger">
														Eliminar Especie
													</button>
												</form>
											</td>
										</tr>

									@endforeach
								</tbody>

							</table>
							{!!$especies->render()!!}
						</section>
					@else

						<p class='alert alert-info'><strong>Whoops!</strong> No se encuetran especies en el sistema.</p>

					@endif

					{!!link_to('especies/create','Añadir especies')!!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection