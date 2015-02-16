@extends('app')

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">{{$raza->raza}}</div>
					<div class="panel-body">
						@if (Session::get('mensagge'))
							<div class="alert alert-success">
								{{Session::get('mensagge')}}
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

						<form class="form-horizontal" action="/razas/{{$raza->id}}/edit" method="get">

							<div class="form-group">
								<label class="col-md-4 control-label">Especie</label>
								<div class="col-md-6">

									<select class="form-control" name="especie_id" disabled>

										@foreach ($especies as $especie)
											@if ($raza->especies->id == $especie->id)
											
												<option value="{{$especie -> id}}" selected>{{$especie->especie}}</option>
											@else

												<option value="{{$especie -> id}}">{{$especie->especie}}</option>

											@endif
										@endforeach

									</select>

								</div>
							</div>
							
							<div class="form-group">
								<label class="col-md-4 control-label">Raza</label>
								<div class="col-md-6">
									<input type="text" class="form-control" name="raza" value="{{ $raza->raza }}" required disabled>
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-6 col-md-offset-4">
									<button type='submit' class="btn btn-primary">
											Editar Raza
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection