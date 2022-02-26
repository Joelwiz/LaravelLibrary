@extends('layout')


@section('content')
    <h1 style="text-align: center; color: #0a477e">Bienvenido a la biblioteca</h1>
    <h3 style="text-align: center;color: #0a477e">Seleccione una acción a realizar</h3><br><br>

    <a href="/libros" class="btn btn-primary" style="width: 100%;">Ver los libros existentes</a><br><br>
    <a class="btn btn-primary" href="/categorias" style="width: 100%;">Ver las categorías disponibles</a><br><br>
    @auth
    <a class="btn btn-primary" href="/usuarios" style="width: 100%;">Ver los usuarios existentes</a><br><br>
    <a class="btn btn-primary" href="/prestamos" style="width: 100%;">Ver los préstamos existentes</a><br><br>
    <a class="btn btn-primary" href="/sanciones" style="width: 100%;">Ver las sanciones existentes</a><br><br>
    @endauth
    <a class="btn btn-danger " href="/login" style="width: 100%;">Iniciar sesión</a><br><br>
@endsection
