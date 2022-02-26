@extends('layout')


@section('content')
    <br><h3 style="text-align: center;color: #0a477e">Categorías de libros que posee la Bliblioteca</h3><br>

    <table class="table" style="width: 100%;">
        <thead>
        <th class="col-4">Id</th>
        <th class="col-4">Nombre de la categoria</th>
        <th class="col-4"></th>
        </thead>
        <tbody style="text-align: center">
        @foreach($categorias as $category)
            <tr>
                <td style="text-align: left">{{ $category->id }}</td>
                <td style="text-align: left">{{ $category->nombre }}</td>
                @if($user->role_id == 1)
                <td><a class="btn btn-sm btn-info" href="relatLibCat/{{$category->id}}">Show</a>
                    <a class="btn btn-sm btn-primary" href="{{ route('categorias.edit',$category->id) }}">Edit</a>

                    <form class="d-inline-block"action="{{ route('categorias.destroy',$category->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger m-0" onclick="return confirm('¿Desea eliminar' +
                            ' la categoria {{ $category->nombre }}?')">Delete</button></form></td>
                @endif
            </tr>

        @endforeach
        </tbody>
    </table>
    @if($user->role_id == 1)
    <a class="btn btn-sm btn-success" style="width: 100%;" href="{{ route('categorias.create') }}">Create</a><br><br>
    @endif
    <a class="btn btn-primary" href="/" style="width: 100%;">Volver atrás</a><br><br>
@endsection
