<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

    </head>
    <body class="antialiased">
        <h1 style="text-align: center">Bienvenido a la biblioteca</h1>
        <h2 style="text-align: center">Por favor, seleccione un libro</h2>
    <table @class('table')>
        <thead>
            <th>ISBN</th>
            <th>Nombre del libro</th>
            <th>Autor/a</th>
            <th>Editorial</th>
        </thead>
    </table>
    </body>
</html>
