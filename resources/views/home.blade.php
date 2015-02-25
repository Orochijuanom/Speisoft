@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Home</div>

				<div class="panel-body">
					<a href="/users">ruta users</a> <br>
					<a href="/clientes">ruta clientes</a> <br>
					<a href="/especies">ruta especies</a> <br>
					<a href="/razas">ruta razas</a> <br>
					<a href="/mascotas">rutas mascotas</a> <br>
					<a href="/sedes">rutas sedes</a> <br>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
