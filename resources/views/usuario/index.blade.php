@extends('layout')


@section('content')


    <br><h3 style="text-align: center;color: #0a477e">Usuarios de la Biblioteca</h3><br>

    <table class="table" style="width: 100%;">
        <thead>
        <th class="col-1">Username</th>
        <th class="col-1">Name</th>
        <th class="col-1">Email</th>
        <th class="col-1">Rol</th>
        <th class="col-3"></th>
        </thead>
        <tbody style="text-align: center">
        @foreach($usuarios as $usuario)
            <tr>
                <td style="text-align: left">{{ $usuario->username }}</td>
                <td style="text-align: left">{{ $usuario->name }}</td>
                <td style="text-align: left">{{ $usuario->email }}</td>
                <td style="text-align: left">{{ $usuario->role_name }}</td>
                <td>
                    <a class="btn btn-sm btn-info" href="{{ route('usuarios.show',$usuario->id) }}">Show</a><br><br>
                    <a class="btn btn-sm btn-primary" href="{{ route('usuarios.edit',$usuario->id) }}">Edit</a><br><br>
                @if($role_id == 1)

                        <form class="d-inline-block"action="{{ route('usuarios.destroy',$usuario->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger m-0" onclick="return confirm('¿Desea eliminar' +
                                ' el usuario {{ $usuario->username }}?')">Delete</button></form></td>
                @endif
            </tr>

        @endforeach
        </tbody>
    </table>
    @if($role_id == 1)
        <a class="btn btn-sm btn-success" style="width: 100%;" href="{{ route('usuarios.create') }}">Create</a><br><br>
    @endif
    <a class="btn btn-primary" href="/" style="width: 100%;">Volver atrás</a><br><br>
@endsection
