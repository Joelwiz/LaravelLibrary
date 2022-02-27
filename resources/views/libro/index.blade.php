@extends('layout')


@section('content')


    <br><h3 style="text-align: center;color: #0a477e">Libros de la Biblioteca Disponibles</h3><br>
    <form action="{{url('/BuscadorLibros')}}" method="post">
        @csrf
        <div class="row">
            <div class="col-4"></div>
            <div class="col-4">
                <input type="text" class="form-control" style="margin-top: 4%;" placeholder="Buscar" name="InputTexto" >
            </div>
            <div class="col-4">
                <button type="submit" class="btn btn-primary" style="margin-top: 4%;" >Buscar</button>
            </div>
        </div>
    </form>
    <table class="table" style="width: 100%;">
        <thead>
        <th class="col-1">ISBN</th>
        <th class="col-1">Nombre del libro</th>
        <th class="col-1">Imagen</th>
        <th class="col-3">Autor/a</th>
        <th class="col-4">Editorial</th>
        <th class="col-4">Número de Ejemplares Disponibles</th>
        <th class="col-4">Categoría</th>
        <th class="col-8"></th>
        </thead>
        <tbody style="text-align: center">
        @foreach($tableUsers as $libro)
            <tr>
                <td style="text-align: left">{{ $libro->ISBN }}</td>
                <td style="text-align: left">{{ $libro->nombre }}</td>
                <td style="text-align: left"><img style="width: 250px;height: 300px" src="/storage/images/{{ $libro->imagen }}"></td>
                <td style="text-align: left">{{ $libro->autor }}</td>
                <td style="text-align: left">{{ $libro->editorial }}</td>
                <td style="text-align: center">{{ $libro->numEjemplaresDisp }}</td>
                <td style="text-align: left">{{ $libro->categoria_rol }}</td>
                <td><a class="btn btn-sm btn-info" href="{{ route('libros.show',$libro->id) }}">Show</a><br><br>
                    @if(isset($user) && $user->role_id == 1)
                    <a class="btn btn-sm btn-primary" href="storage/pdf/PDF.pdf">Ver PDF</a><br><br>
                    <a class="btn btn-sm btn-primary" href="{{ route('libros.edit',$libro->id) }}">Edit</a><br><br>

                    <form class="d-inline-block"action="{{ route('libros.destroy',$libro->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger m-0" onclick="return confirm('¿Desea eliminar' +
                            ' el libro {{ $libro->nombre }}?')">Delete</button></form></td>
                    @endif
            </tr>

        @endforeach
        </tbody>
    </table>
    {{$tableUsers -> links()}}
    @if(isset($user) && $user->role_id == 1)
    <a class="btn btn-sm btn-success" style="width: 100%;" href="{{ route('libros.create') }}">Create</a><br><br>
    @endif
    <a class="btn btn-primary" href="/" style="width: 100%;">Volver atrás</a><br><br>
@endsection
