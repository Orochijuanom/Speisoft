@extends('app')

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">Registrar Razas</div>
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

						<form class="form-horizontal" role="form" method="POST" action="/razas">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">

							<div class="form-group">
								<label class="col-md-4 control-label">Especie</label>
								<div class="col-md-6">

									<select class="form-control" name="especie_id">

										@foreach ($especies as $especie)
											@if (old('especie_id') == $especie->id)
											
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
									<input type="text" class="form-control" name="raza" value="{{ old('raza') }}" required>
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-6 col-md-offset-4">
									<button type="submit" class="btn btn-primary">
										Registrar
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