<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = "cliente";

    protected $fillable = ['vigilante_id', 'cliente_nome', 'cliente_celular',
                            'cliente_mensalidade', 'cliente_vencimento'
                          ];

    //Relacionamento com vigilante
    public function vigilante()
    {
        //Cliente só pode ter 1 vigilante, por isso belongsTo
        return $this->belongsTo(User::class, 'vigilante_id');
    }

    public function endereco()
    {
        //Cliente pode ter vários endereços
        return $this->hasMany(EnderecoCliente::class, 'cliente_id');
    }
}
