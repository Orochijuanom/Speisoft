@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">{{$especie->especie}}</div>
				<div class="panel-body">
					@if (Session::get('mensagge_delete'))
						<div class="alert alert-success">
							{{Session::get('mensagge_delete')}}
							<br><br>			
						</div>
					@endif

					@if(count($razas)>0)
						<section id='no-more-tables'>
							<table class='table table-responsive'>
								<thead>
									<tr>
										<th>Raza</th>
										<th>Especie</th>
										<th>Eliminar</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($razas as $raza)

										<tr>
											<td data-title='Raza'><a href="razas/{{$raza->id}}">{{$raza->raza}}</a></td>
											<td data-title='Especie'>{{$raza->especies->especie}}</td>
											<td data-title='Eliminar'>
												<form action='/razas/{{$raza->id}}' method='post'>

													<input name='_method' type='hidden' value='DELETE'>
													<input name='_token' type='hidden' value='{{csrf_token()}}'>
													<button type='submit' class="btn btn-danger">
														Eliminar Raza
													</button>
												</form>
											</td>
										</tr>

									@endforeach
								</tbody>

							</table>
							{!!$razas->render()!!}
						</section>
					@else

						<p class='alert alert-info'><strong>Whoops!</strong> No se encuetran razas en el sistema.</p>

					@endif
					

					{!!link_to('razas/create','Añadir razas')!!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection