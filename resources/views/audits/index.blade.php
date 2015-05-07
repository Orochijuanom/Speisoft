@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Log del sistema</div>
				<div class="panel-body">
					@if (Session::get('mensagge_delete'))
						<div class="alert alert-success">
							{{Session::get('mensagge_delete')}}
							<br><br>			
						</div>
					@endif

					@if(count($audits)>0)
						<section id='no-more-tables'>
							<table class='table table-responsive'>
								<thead>
									<tr>
										<th>Base de datos</th>
										<th>Acción</th>
										<th>Usuario</th>
										<th>Ip</th>
										<th>Fecha</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($audits as $audit)

										<tr>
											<td data-title='Base de datos'>{{$audit->model}}</td>
											<td data-title='Acción'>{{$audit->action}}</td>
											<td data-title='Usuario'>{{$audit->users->name}}</td>
											<td data-title='Ip'>{{$audit->ip}}</td>
											<td data-title='Fecha'>{{$audit->fecha}}</td>
										</tr>

									@endforeach
								</tbody>

							</table>
							{!!$audits->render()!!}
						</section>
					@else

						<p class='alert alert-info'><strong>Whoops!</strong> No se encuetran registros en el sistema.</p>

					@endif

				</div>
			</div>
		</div>
	</div>
</div>

@endsection