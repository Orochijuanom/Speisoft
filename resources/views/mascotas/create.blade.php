@extends('app')

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">Registrar Mascotas</div>
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

						<form class="form-horizontal" role="form" method="POST" action="/mascotas">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">

							<div class="form-group">
								<label class="col-md-4 control-label">Cliente</label>
								<div class="col-md-6">

									<select class="form-control" name="cliente_id">

										@foreach ($clientes as $cliente)
											@if (old('cliente_id') == $cliente->id)
											
												<option value="{{$cliente -> id}}" selected>{{$cliente->nombre}} {{$cliente->apellidos}}</option>
											@else

												<option value="{{$cliente -> id}}">{{$cliente->nombre}} {{$cliente->apellidos}}</option>

											@endif
										@endforeach

									</select>

								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 control-label">Raza</label>
								<div class="col-md-6">

									<select class="form-control" name="raza_id">

										@foreach ($razas as $raza)
											@if (old('raza_id') == $raza->id)
											
												<option value="{{$raza -> id}}" selected>{{$raza->especies->especie}} - {{$raza->raza}}</option>
											@else

												<option value="{{$raza -> id}}">{{$raza->especies->especie}} - {{$raza->raza}}</option>

											@endif
										@endforeach

									</select>

								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 control-label">Nombre</label>
								<div class="col-md-6">
									<input type="text" class="form-control" name="nombre" value="{{ old('nombre') }}" required>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 control-label">Sexo</label>
								<div class="col-md-6">

									<select class="form-control" name="sexo">

										@if (old('sexo') == 'M')
										
											<option value="M" selected>M</option>
											<option value="F">F</option>

										@else

											<option value="M">M</option>
											<option value="F" selected>F</option>

										@endif
										
									</select>

								</div>
							</div>
							
							<div class="form-group">
								<label class="col-md-4 control-label">Peso</label>
								<div class="col-md-6">
									<input type="text" class="form-control" name="peso" value="{{ old('peso') }}">
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 control-label">Alzada</label>
								<div class="col-md-6">
									<input type="text" class="form-control" name="alzada" value="{{ old('alzada') }}">
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 control-label">Color</label>
								<div class="col-md-6">
									<input type="text" class="form-control" name="color" value="{{ old('color') }}">
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 control-label">Pelaje</label>
								<div class="col-md-6">
									<select class="form-control" name="pelaje">

										<option value="Largo" @if(old('pelaje')=='Largo') selected @endif >Largo</option>
										<option value="Corto" @if(old('pelaje')=='Corto') selected @endif>Corto</option>
										<option value="Medio" @if(old('pelaje')=='Medio') selected @endif>Medio</option>
										<option value="Alambre" @if(old('pelaje')=='Alambre')  @endif>Alambre</option>
										<option value="Liso" @if(old('pelaje')=='Liso') selected @endif>Liso</option>

									</select>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 control-label">Cicatrices</label>
								<div class="col-md-6">
									<input type="text" class="form-control" name="cicatrices" value="{{ old('cicatrices') }}">
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 control-label">Cirujias esteticas</label>
								<div class="col-md-6">
									<input type="text" class="form-control" name="cxesteticas" value="{{ old('cxesteticas') }}">
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 control-label">Tatuaje</label>
								<div class="col-md-6">
									<input type="text" class="form-control" name="tatuaje" value="{{ old('tatuaje') }}">
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 control-label">Condicion corporal</label>
								<div class="col-md-6">
									<input type="number" class="form-control" name="condcorporal" value="{{ old('condcorporal') }}" min="1" max="5">
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 control-label">Fin zootecnico</label>
								<div class="col-md-6">
									<select class="form-control" name="finzootecnico">

										<option value="Trabajo" @if(old('finzootecnico')=='Trabajo') selected @endif>Trabajo</option>
										<option value="Compania" @if(old('finzootecnico')=='Compania') selected @endif>Compañia</option>
										<option value="Seguridad" @if(old('finzootecnico')=='Seguridad') selected @endif>Seguridad</option>
										<option value="Reproduccion" @if(old('finzootecnico')=='Reproduccion') selected @endif>Reproducción</option>

									</select>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 control-label">Entorno</label>
								<div class="col-md-6">
									<select class="form-control" name="entorno">

										<option value="Casa" @if(old('entorno')=='Casa') selected @endif>Casa</option>
										<option value="Finca" @if(old('entorno')=='Finca') selected @endif>Finca</option>
										<option value="Caniles" @if(old('entorno')=='Caniles') selected @endif>Caniles</option>
										<option value="Apartamento" @if(old('entorno')=='Apartamento') selected @endif>Apartamento</option>

									</select>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 control-label">Nutrición</label>
								<div class="col-md-6">
									<input type="text" class="form-control" name="nutricion" value="{{ old('nutricion') }}">
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 control-label">Fecha de nacimiento</label>
								<div class="col-md-6">
									<input type="date" class="form-control" name="nacimiento" value="{{ old('nacimiento') }}">
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 control-label">Recordatorio de cumpleaños</label>
								<div class="col-md-6">

									@if(old('recordatoriocumple') == "1")

										<label class="radio">Si</label> <input type="radio" class="form-control" name="recordatoriocumple" value="1" checked>
										<label class="radio">No</label> <input type="radio" class="form-control" name="recordatoriocumple" value="0">

									@elseif(old('recordatoriocumple') == "0")

										<label class="radio">Si</label> <input type="radio" class="form-control" name="recordatoriocumple" value="1">
										<label class="radio">No</label> <input type="radio" class="form-control" name="recordatoriocumple" value="0" checked>

									@else
										{{old('recordatoriocumple')}}
										<label class="radio">Si</label> <input type="radio" class="form-control" name="recordatoriocumple" value="1">
										<label class="radio">No</label> <input type="radio" class="form-control" name="recordatoriocumple" value="0">

									@endif

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