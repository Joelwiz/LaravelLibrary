
@extends('layout')


@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Editar Libro</h2>
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
    <form action="{{ route('libros.update',$libro->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Título:</strong>
                    <input type="text" name="nombre" class="form-control" placeholder="Título" value="{{ old('nombre') }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>ISBN:</strong>
                    <input type="text" name="ISBN" class="form-control" placeholder="ISBN" value="{{ old('ISBN') }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Autor:</strong>
                    <input type="text" name="autor" class="form-control" placeholder="Autor" value="{{ old('autor') }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Editorial:</strong>
                    <input type="text" name="editorial" class="form-control" placeholder="Editorial" value="{{ old('editorial') }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Categoría:</strong>
                    <input type="number" name="categoriaId">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Portada:</strong>
                    <input type="file" name="imagen" class="form-control" placeholder="Portada">
                    <img src="/storage/images/{{ $libro->imagen }}" width="200px">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Numero de Ejemplares:</strong>
                    <input type="number" name="numEjemplaresDisp">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
        </div>
    </form>

@endsection
