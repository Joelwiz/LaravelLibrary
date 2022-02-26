<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\libro;

class Prestamo extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'codLibro',
        'idUsuario',
        'fechaSacado',
        'fechaDevolucion',
        'fechaEsperada',
    ];

    public function user(){
        return $this->belongsTo(user::class, 'idUsuario');
    }

    public function libro(){
        return $this->belongsTo(libro::class, 'codLibro');
    }

/*
    public function user(){
        return $this->belongsToMany(User::class, 'users');
    }

    public function libro(){
        return $this->belongsToMany(libro::class, 'libros');
    }
    function numUser()
    {
        return $this->hasOne(User::class);
    }

    function numLibros()
    {
        return $this->hasOne(libro::class);
    }*/
}
