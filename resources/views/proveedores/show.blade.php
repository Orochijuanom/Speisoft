@extends('app')

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">{{$proveedor->proveedor}}</div>
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

						<form class="form-horizontal" role="form" method="get" action="/proveedores/{{$proveedor->id}}/edit">
							
							<div class="form-group">
								<label class="col-md-4 control-label">Nombre</label>
								<div class="col-md-6">
									<input type="text" class="form-control" name="nombre" value="{{ $proveedor->nombre }}" required disabled>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 control-label">Nit</label>
								<div class="col-md-6">
									<input type="text" class="form-control" name="nit" value="{{ $proveedor->nit }}" required disabled>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 control-label">Telefono</label>
								<div class="col-md-6">
									<input type="text" class="form-control" name="telefono" value="{{ $proveedor->telefono }}" disabled>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 control-label">Celular</label>
								<div class="col-md-6">
									<input type="text" class="form-control" name="celular" value="{{ $proveedor->celular }}" required disabled>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 control-label">Email</label>
								<div class="col-md-6">
									<input type="text" class="form-control" name="email" value="{{ $proveedor->email }}" required disabled>
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-6 col-md-offset-4">
									<button type="submit" class="btn btn-primary">
										Editar proveedor
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