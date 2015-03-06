@extends('app')

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">{{$producto->producto}}</div>
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

						<form class="form-horizontal" role="form" method="get" action="/productos/{{$producto->id}}/edit">
							

							<div class="form-group">
								<label class="col-md-4 control-label">Tipo de producto</label>
								<div class="col-md-6">

									<select class="form-control" name="tipoproducto_id" disabled>

										@foreach ($tipoproductos as $tipoproducto)
											@if ($producto->tipoproductos->id == $tipoproducto->id)
											
												<option value="{{$tipoproducto -> id}}" selected>{{$tipoproducto->tipo}}</option>
											@else

												<option value="{{$tipoproducto -> id}}">{{$tipoproducto->tipo}}</option>

											@endif
										@endforeach

									</select>

								</div>
							</div>
							
							<div class="form-group">
								<label class="col-md-4 control-label">Producto</label>
								<div class="col-md-6">
									<input type="text" class="form-control" name="producto" value="{{ $producto->producto }}" required disabled>
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-6 col-md-offset-4">
									<button type="submit" class="btn btn-primary">
										Editar producto
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