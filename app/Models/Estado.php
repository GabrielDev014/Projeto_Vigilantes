<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    use HasFactory;
    protected $table = "estado";

    public function cidades()
    {
        // Um estado pode ter várias cidades
        return $this->hasMany(Cidade::class, 'estado_id');
    }
}
