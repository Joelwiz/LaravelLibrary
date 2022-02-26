<body style="background-color: lightskyblue">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

<h1 style="text-align: center;margin-top: 5%;margin-bottom: 5%;"></h1>
    <table class="table" style="width: 100%;">
        <thead>
        <th class="col-4" style="text-align: center">Nombre</th>
        <th class="col-4" style="text-align: center">Imagen</th>
        <th class="col-4" style="text-align: center">Autor/a</th>
        </thead>
        <tbody style="text-align: center">
    @foreach($libros as $libro)
        <tr>
            <td style="text-align: center">{{$libro -> nombre}}</td>
            <td style="text-align: center"><img src="/storage/images/{{$libro->imagen}}" style="width: 200px; height: 300px"></td>
            <td style="text-align: center">{{$libro -> autor}}</td>
        </tr>
    @endforeach
        </tbody>
    </table>
<a class="btn btn-primary" href="/categorias" style="width: 100%;">Volver atrás</a><br><br>
</body>
