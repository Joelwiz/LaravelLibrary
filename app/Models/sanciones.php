<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class sanciones extends Model
{
    use HasFactory;

    protected $table = 'sanciones';

    protected $hidden = [
        'id',
    ];

    protected $fillable = [
        'idUsuario',
        'codLibro',
        'idPrestamo',
        'observacion'
    ];

    function numUser()
    {
        return $this->hasOne(User::class);
    }
}
