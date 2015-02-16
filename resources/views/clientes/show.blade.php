@extends('app')

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">{{$cliente->nombre}} {{$cliente->apellidos}}</div>
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

						<form class="form-horizontal" action="/clientes/{{$cliente->id}}/edit" method="get">
							
							<div class="form-group">
								<label class="col-md-4 control-label">Nombre</label>
								<div class="col-md-6">
									<input type="text" class="form-control" name="nombre" value="{{ $cliente->nombre }}" required disabled>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 control-label">Apellidos</label>
								<div class="col-md-6">
									<input type="text" class="form-control" name="apellidos" value="{{ $cliente->apellidos }}" required disabled>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 control-label">Cédula</label>
								<div class="col-md-6">
									<input type="number" class="form-control" name="cedula" value="{{ $cliente->cedula }}" required disabled>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 control-label">Celular</label>
								<div class="col-md-6">
									<input type="text" class="form-control" name="celular" value="{{ $cliente->celular }}" required disabled>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 control-label">Telefono</label>
								<div class="col-md-6">
									<input type="text" class="form-control" name="telefono" value="{{ $cliente->telefono }}" disabled>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 control-label">Email</label>
								<div class="col-md-6">
									<input type="text" class="form-control" name="email" value="{{ $cliente->email }}" required disabled>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 control-label">Direccion</label>
								<div class="col-md-6">
									<input type="text" class="form-control" name="direccion" value="{{ $cliente->direccion }}" disabled>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 control-label">BBM</label>
								<div class="col-md-6">
									<input type="text" class="form-control" name="bbm" value="{{ $cliente->bbm }}" disabled>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 control-label">Facebook</label>
								<div class="col-md-6">
									<input type="text" class="form-control" name="facebook" value="{{ $cliente->facebook }}" disabled>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 control-label">Profesión</label>
								<div class="col-md-6">
									<input type="text" class="form-control" name="profesion" value="{{ $cliente->profesion }}" disabled>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 control-label">Cumpleaños</label>
								<div class="col-md-6">
									<input type="date" class="form-control" name="cumpleanios" value="{{ $cliente->cumpleanios }}" disabled>
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-6 col-md-offset-4">
									<button type='submit' class="btn btn-primary">
											Editar Cliente
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