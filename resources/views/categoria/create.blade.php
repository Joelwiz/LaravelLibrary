
@extends('layout')


@section('content')

    <div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Añadir Categoría Nueva</h2>
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

<form action="{{ route('categorias.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nombre:</strong>
                <input type="text" name="nombre" class="form-control" placeholder="Nombre de la categoria nueva" value="{{ old('nombre') }}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Añadir Categoría</button>
        </div>
    </div>
</form>

@endsection
