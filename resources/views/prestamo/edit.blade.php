
@extends('layout')


@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Editar Préstamo</h2>
            </div>
        </div>
    </div>

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
    <form action="{{ route('prestamos.update',$prestamo->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Codigo del Libro:</strong>
                    <input type="text" name="codLibro" class="form-control" placeholder="codLibro" value="{{ old('codLibro') }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>ID del Usuario:</strong>
                    <input type="text" name="idUsuario" class="form-control" placeholder="idUsuario" value="{{ old('idUsuario') }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Fecha de Sacado:</strong>
                    <input type="date" name="fechaSacado" class="form-control" placeholder="fechaSacado" value="{{ old('fechaSacado') }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Fecha de Devolución:</strong>
                    <input type="date" name="fechaDevolucion" class="form-control" placeholder="fechaDevolucion" value="{{ old('fechaDevolucion') }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Fecha de Entrega Esperada:</strong>
                    <input type="date" name="fechaEsperada" class="form-control" placeholder="fechaEsperada" value="{{ old('fechaEsperada') }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
        </div>
    </form>

@endsection
