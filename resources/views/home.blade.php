@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading" style="text-align: center"><b>Panel de Control</b></div>

				<div class="panel-body" style="text-align: center">
					
					<div class="col-xs-6 col-md-4"><a href="/users"><img src="http://www.speisoft.victorushero.com/iconos/usuarios.png" width="100px" /></a><h4>Usuarios</h4></div>

					<div class="col-xs-6 col-md-4"><a href="/clientes"><img src="http://www.speisoft.victorushero.com/iconos/clientes.png" width="100px" /></a><h4>Clientes</h4></div>

					<div class="col-xs-6 col-md-4"><a href="/especies"><img src="http://www.speisoft.victorushero.com/iconos/especies.png" width="100px" /></a><h4>Especies</h4></div>

					<div class="col-xs-6 col-md-4"><a href="/razas"><img src="http://www.speisoft.victorushero.com/iconos/razas.png" width="100px" /></a><h4>Razas</h4></div>

					<div class="col-xs-6 col-md-4"><a href="/mascotas"><img src="http://www.speisoft.victorushero.com/iconos/mascotas.png" width="100px" /></a><h4>Mascotas</h4></a></div>

					<div class="col-xs-6 col-md-4"><a href="/sedes"><img src="http://www.speisoft.victorushero.com/iconos/sedes.png" width="100px" /></a><h4>Sedes</h4></a></div>

					<div class="col-xs-6 col-md-4"><a href="/proveedores"><img src="http://www.speisoft.victorushero.com/iconos/proveedores.png" width="100px" /></a><h4>Proveedores</h4></a></div>
					
					<div class="col-xs-6 col-md-4"><a href="/tipo_productos"><img src="http://www.speisoft.victorushero.com/iconos/tipo_productos.png" width="100px" /></a><h4>Tipo de Productos</h4></a></div>

					<div class="col-xs-6 col-md-4"><a href="/productos"><img src="http://www.speisoft.victorushero.com/iconos/productos.png" width="100px" /></a><h4>Productos</h4></a></div>

				</div>
			</div>
		</div>
	</div>
</div>
@endsection
