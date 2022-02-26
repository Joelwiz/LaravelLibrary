
@extends('layout')


@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Crear Préstamo</h2>
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
    <form action="{{ route('prestamos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Libro a prestar:</strong>
                    <select class="form-select" name="codLibro">
                        @foreach ($prestamosAvailable as $id =>$prestamo)
                            <option value="{{$id}}">{{$prestamo}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Usuario:</strong>
                    <select class="form-select" name="idUsuario">
                        @foreach ($usersPres as $User)
                            <option value="{{$User->id}}">{{$User->username}}</option>
                        @endforeach
                    </select>
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
                <button type="submit" class="btn btn-primary">Añadir Préstamo</button>
            </div>
        </div>
    </form>

@endsection
