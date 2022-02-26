@extends('layout')


@section('content')
    <br><h3 style="text-align: center;color: #0a477e">Sanciones Existentes</h3><br>

<table class="table" style="width: 100%;">
    <thead>
    <th style="text-align: center" class="col-2">Nombre del Usuario</th>
    <th style="text-align: center" class="col-2">Nombre del Libro</th>
    <th style="text-align: center" class="col-2">ID del Préstamo</th>
    <th style="text-align: center" class="col-2">Días de Penalización</th>
    <th style="text-align: center" class="col-2">Observaciones </th>
    </thead>
    <tbody style="text-align: center">
    @auth
        @foreach($sanciones as $sancion)
        <tr>
            <td style="text-align: center">{{ $sancion->username}}</td>
            <td style="text-align: center">{{ $sancion->nombre }}</td>
            <td style="text-align: center">{{ $sancion->idPrestamo }}</td>
            <td style="text-align: center">{{ $sancion->finPenalizacion }}</td>
            <td style="text-align: center">{{ $sancion->observacion }}</td>
        </tr>

        @endforeach
    @endauth
    </tbody>
</table>
<a class="btn btn-primary" href="/" style="width: 100%;">Volver atrás</a><br><br>
@endsection
