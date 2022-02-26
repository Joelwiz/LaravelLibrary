
@extends('layout')


@section('content')

    <div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Añadir Libro Nuevo</h2>
        </div>
    </div>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Oops!</strong> Algo dio problemas, por favor inténtelo de nuevo.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('libros.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>ISBN:</strong>
                <input type="text" name="ISBN" class="form-control" placeholder="ISBN del libro nuevo" value="{{ old('ISBN') }}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Imagen:</strong>
                <input type="file" name="imagen" class="form-control" placeholder="Imagen">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nombre:</strong>
                <input type="text" name="nombre" class="form-control" placeholder="Nombre del libro nuevo" value="{{ old('nombre') }}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Autor/a:</strong>
                <input type="text" name="autor" class="form-control" placeholder="Autor/a del libro nuevo" value="{{ old('autor') }}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Editorial:</strong>
                <input type="text" name="editorial" class="form-control" placeholder="Editorial del libro nuevo" value="{{ old('editorial') }}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nº Ejemplares:</strong>
                <input type="text" name="numEjemplaresDisp" class="form-control" placeholder="Numero de ejemplares del libro nuevo" value="{{ old('numEjemplaresDisp') }}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Categoria:</strong>
                <input type="text" name="categoriaId" class="form-control" placeholder="Categoria del libro nuevo" value="{{ old('categoriaId') }}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Añadir Libro</button>
        </div>
    </div>
</form>

@endsection
