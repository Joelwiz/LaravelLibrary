@extends('layout')


@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <br><h3 style="text-align: center;color: #0a477e">Préstamos Actuales</h3><br>

    <table class="table" style="width: 100%;">
        <thead>
        <th class="col-2">Nombre del Libro</th>
        <th class="col-2">Nombre del Usuario</th>
        <th class="col-2">Fecha de Sacado</th>
        <th class="col-2">Fecha de Devolución</th>
        <th class="col-2">Fecha de esperada de entrega </th>
        <th class="col-2"></th>
        </thead>
        <tbody style="text-align: center">
        @auth
            @foreach($prestamos as $prestamo)
                <tr>
                    <td style="text-align: left">{{ $prestamo->nombre}}</td>
                    <td style="text-align: left">{{ $prestamo->username}}</td>
                    <td style="text-align: left">{{ $prestamo->fechaSacado }}</td>
                    <td>{{ $prestamo->fechaDevolucion }}</td>
                    <td>{{ $prestamo->fechaEsperada }}</td>
                    @if($user == 1)
                    <td><a class="btn btn-sm btn-info" href="{{ route('prestamos.show',$prestamo->id_prestamo) }}">Show</a><br><br>
                        <a class="btn btn-sm btn-primary" href="{{ route('prestamos.edit',$prestamo->id_prestamo) }}">Edit</a><br><br>

                        @if($prestamo -> fechaDevolucion== null)
                            <form class="d-inline-block"action="{{ route('prestamos.destroy',$prestamo->id_prestamo) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger m-0" onclick="return confirm('¿Desea devolver' +
                                    ' el prestamo {{ $prestamo->id_prestamo }}?')">Devolver</button></form></td>
                        @endif
                        @if($prestamo->fechaDevolucion>$prestamo->fechaEsperada)
                            <form class="d-inline-block"action="{{ route('prestamos.destroy',$prestamo->id_prestamo) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger m-0" onclick="return confirm('¿Proceder a sancionar' +
                                    ' al usuario {{ $prestamo->username }}?')">Sancionar</button></form></td>
                        @endif
                    @endif
                </tr>

            @endforeach
        @endauth
        </tbody>
    </table>
    @if($user == 1)
        <a class="btn btn-sm btn-success" style="width: 100%;" href="{{ route('prestamos.create') }}">Create</a><br><br>
    @endif
    <a class="btn btn-primary" href="/" style="width: 100%;">Volver atrás</a><br><br>
@endsection
