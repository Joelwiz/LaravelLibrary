@extends('layout')


@section('content')
    <!--<br><h3 style="text-align: center;color: #0a477e">Libros de la Biblioteca Disponibles</h3><br>

<table class="table" style="width: 100%;">
    <thead>
    <th class="col-2">ISBN</th>
    <th class="col-2">Nombre del libro</th>
    <th class="col-2">Imagen</th>
    <th class="col-2">Autor/a</th>
    <th class="col-2">Editorial</th>
    <th class="col-4">Número de Ejemplares Disponibles</th>
    <th class="col-4">Categoría</th>
    </thead>
    <tbody style="text-align: center">
        @foreach($libros as $libro)
        <tr>
            <td style="text-align: left">{{ $libro->ISBN }}</td>
            <td style="text-align: left">{{ $libro->nombre }}</td>
            <td style="text-align: left"><img style="max-width: 350px;max-height: 300px" src="/storage/images/{{ $libro->imagen }}"></td>
            <td style="text-align: left">{{ $libro->autor }}</td>
            <td style="text-align: left">{{ $libro->editorial }}</td>
            <td style="text-align: center">{{ $libro->numEjemplaresDisp }}</td>
            <td>{{ $libro->categoriaId }}</td>
        </tr>

        @endforeach
    </tbody>
</table>
<a class="btn btn-primary" href="/" style="width: 100%;">Volver atrás</a><br><br>-->
@endsection
