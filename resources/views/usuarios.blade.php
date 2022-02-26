@extends('layout')


@section('content')
    <!--<br><h3 style="text-align: center;color: #0a477e">Usuarios Registrados en la Biblioteca</h3><br>

<table class="table" style="width: 100%;">
    <thead>
    <th class="col-2">ID</th>
    <th class="col-2">Nickname del User</th>
    <th class="col-2">Nombre del User/a</th>
    <th class="col-2">Email del User/a</th>
    <th class="col-2">Rol del User/a</th>
    </thead>
    <tbody style="text-align: center">
        @foreach($usuarios as $usuario)
        <tr>
            <td style="text-align: left">{{ $usuario->id }}</td>
            <td style="text-align: left">{{ $usuario->username }}</td>
            <td style="text-align: left">{{ $usuario->name }}</td>
            <td style="text-align: left">{{ $usuario->email }}</td>
            <td style="text-align: left">{{ $usuario->role_name}}</td>
        </tr>

        @endforeach
    </tbody>
</table>
<a class="btn btn-primary" href="/" style="width: 100%;">Volver atrás</a><br><br>-->
@endsection
