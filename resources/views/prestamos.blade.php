@extends('layout')


@section('content')
    <!--<br><h3 style="text-align: center;color: #0a477e">Préstamos Actuales</h3><br>

<table class="table" style="width: 100%;">
    <thead>
    <th class="col-2">Nombre del Libro</th>
    <th class="col-2">Nombre del Usuario</th>
    <th class="col-2">Fecha de Sacado</th>
    <th class="col-2">Fecha de Devolución</th>
    <th class="col-2">Fecha de esperada de entrega </th>
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
        </tr>

        @endforeach
    @endauth
    </tbody>
</table>
<a class="btn btn-primary" href="/" style="width: 100%;">Volver atrás</a><br><br>-->
@endsection
