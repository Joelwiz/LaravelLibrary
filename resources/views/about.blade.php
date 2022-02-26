
@extends('layout')


@section('content')
    <br><h3 style="text-align: center;color: #0a477e">Categorías de libros que posee la Bliblioteca</h3><br>

    <table class="table" style="width: 100%;">
        <thead>
        <th class="col-4">Lenguaje de Programación empleado</th>
        <th class="col-4">Nombre del framework empleado</th>
        </thead>
        <tbody style="text-align: center">
            <tr>
                <td style="text-align: left">PHP</td>
                <td style="text-align: left">Laravel</td>
            </tr>
        </tbody>
    </table>
    <a class="btn btn-primary" href="/" style="width: 100%;">Volver atrás</a><br><br>
@endsection
