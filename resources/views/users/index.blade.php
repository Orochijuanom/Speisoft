@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Usuarios</div>
				<div class="panel-body">
					@if (Session::get('mensagge_delete'))
						<div class="alert alert-success">
							{{Session::get('mensagge_delete')}}
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

					@if(count($users)>0)
						<section id='no-more-tables'>
							<table class='table table-responsive'>
								<thead>
									<tr>
										<th>Usuario</th>
										<th>Email</th>
										<th>Rol</th>
										<th>Eliminar</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($users as $user)

										<tr>
											<td data-title='Usuario'>{{$user->name}}</td>
											<td data-title='Email'>{{$user->email}}</td>
											<td data-title='Rol'>{{$user->roles->rol}}</td>
											<td data-title='Eliminar'>
												<form action='/users/{{$user->id}}' method='post'>

													<input name='_method' type='hidden' value='DELETE'>
													<input name='_token' type='hidden' value='{{csrf_token()}}'>
													<button type='submit' class="btn btn-danger">
														Eliminar usuario
													</button>

												</form>
											</td>
										</tr>

									@endforeach
								</tbody>

							</table>
							{!!$users->render()!!}
						</section>
					@else

						<p class='alert alert-info'><strong>Whoops!</strong> No se encuetran usuarios en el sistema.</p>

					@endif

					{!!link_to('auth/register','Añadir usuarios')!!}
				</div>
			</div>
		</div>
	</div>
</div>

@endsection