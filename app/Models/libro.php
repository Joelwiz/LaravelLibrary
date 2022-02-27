<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\categoria;
use App\Models\prestamo;

class libro extends Model
{
    use HasFactory;

    protected $fillable = [
        'ISBN',
        'nombre',
        'imagen',
        'autor',
        'editorial',
        'categoriaId',
        'numEjemplaresDisp'
    ];
    protected $hidden = ['id'];

    public $incrementing = false;
    protected $casts = ['id' => 'integer'];

    public function userNum()
    {
        return $this->belongsToMany(User::class,'prestamos','codLibro','idUsuario');
    }

    public function categoria()
    {
        return $this->belongsTo(categoria::class);
    }

    public function prestamo(){
        return $this->HasMany(prestamo::class,'codLibro');
    }

}
