
@extends('layout')


@section('content')

    <div class="container">
        <h1 style="text-align: center;margin-top: 5%;margin-bottom: 5%;">Detalles del Libro</h1>
        <div class="row" style="margin-left:25%;margin-right: 25%">
            <div class="col">
                <div class="card mb-3" style="max-width: 100%;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="/storage/images/{{$libro->imagen}}" class="img-fluid rounded-start" style="height: 100%" >
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">ISBN: {{$libro -> ISBN}}</h5>
                                <p class="card-text">Nombre: {{$libro -> nombre}}</p>
                                <p class="card-text">Autor/a: {{$libro -> autor}}</p>
                                <p class="card-text">Editorial: {{$libro -> editorial}}</p>
                                <p class="card-text">Categoría: {{$libro -> categoriaId}}</p>

                            </div>
                        </div>
                    </div>

                </div>
                <a href="{{ url()->previous() }}" class="btn btn-primary" style="width: 50%;margin-left:25%;margin-right: 25%">Volver</a>
            </div>

@endsection
