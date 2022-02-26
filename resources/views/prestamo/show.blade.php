
@extends('layout')


@section('content')

    <div class="container">
        <h1 style="text-align: center;margin-top: 5%;margin-bottom: 5%;">Detalles del Prestamo</h1>
        <div class="row" style="margin-left:25%;margin-right: 25%">
            <div class="col">
                <div class="card mb-3" style="max-width: 100%;">
                    <div class="row g-0">
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Nombre del Libro: {{$prestamos -> nombre_libro}}</h5>
                                <p class="card-text">Nombre del Usuario: {{$prestamos -> nombre_user}}</p>
                                <p class="card-text">Fecha Sacado: {{$prestamo -> fechaSacado}}</p>
                                <p class="card-text">Fecha de Devolución: {{$prestamo -> fechaDevolucion}}</p>
                                <p class="card-text">Fecha de Devolución Esperada: {{$prestamo -> fechaEsperada}}</p>
                            </div>
                        </div>
                    </div>

                </div>
                <a href="{{ url()->previous() }}" class="btn btn-primary" style="width: 50%;margin-left:25%;margin-right: 25%">Volver</a>
            </div>

@endsection
