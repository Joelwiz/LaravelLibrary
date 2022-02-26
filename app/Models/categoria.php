<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\libro;

class categoria extends Model
{
    use HasFactory;

    protected $fillable = ['nombre'];
    protected $hidden = ['id'];


    public $incrementing = false;
    protected $casts = ['id' => 'integer'];

    public function libroNum()
    {
        return $this->hasMany(libro::class);
    }
}
