@extends('app')

@section('content')

	@if (Session::get('mensagge_delete'))
		<div class="alert alert-success">
			{{Session::get('mensagge_delete')}}
			<br><br>			
		</div>
	@endif

	<table class='table'>
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
					<td>{{$user->name}}</td>
					<td>{{$user->email}}</td>
					<td>{{$user->roles->rol}}</td>
					<td>
						<form action='/users/{{$user->id}}' method='post'>

							<input name='_method' type='hidden' value='DELETE'>
							<input name='_token' type='hidden' value='{{csrf_token()}}'>
							<input type='submit' value='Eliminar usuario'>

						</form>
					<td>
				</tr>

			@endforeach
		</tbody>

	</table>

	{!!link_to('auth/register','Añadir usuarios')!!}

@endsection