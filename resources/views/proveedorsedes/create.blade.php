@extends('app')

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">Relacionar una sede a un proveedor</div>
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

						<form class="form-horizontal" role="form" method="POST" action="/proveedor_sede">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">

							<div class="form-group">
								<label class="col-md-4 control-label">Proveedor</label>
								<div class="col-md-6">

									<select class="form-control" name="proveedore_id">

										@foreach ($proveedores as $proveedore)
											@if (old('proveedore_id') == $proveedore->id)
											
												<option value="{{$proveedore -> id}}" selected>{{$proveedore->nombre}}</option>
											@else

												<option value="{{$proveedore -> id}}">{{$proveedore->nombre}}</option>

											@endif
										@endforeach

									</select>

								</div>
							</div>
							
							<div class="form-group">
								<label class="col-md-4 control-label">Sede</label>
								<div class="col-md-6">

									<select class="form-control" name="sede_id">

											@foreach ($sedes as $sede)
												@if (old('sede_id') == $sede->id)
												
													<option value="{{$sede -> id}}" selected>{{$sede->nombre}}</option>
												@else

													<option value="{{$sede -> id}}">{{$sede->nombre}}</option>

												@endif
											@endforeach

										</select>
									</div>
							</div>

							<div class="form-group">
								<div class="col-md-6 col-md-offset-4">
									<button type="submit" class="btn btn-primary">
										Aceptar
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