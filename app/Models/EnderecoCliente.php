<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnderecoCliente extends Model
{
    use HasFactory;

    protected $table = "endereco_cliente";

    protected $fillable = ['cliente_id', 'estado_id', 'cidade_id',
                            'rua', 'bairro', 'numero_casa'
                          ];

    //Relacionamento com cliente
    public function cliente()
    {
        //Endereço só pode ter 1 cliente, por isso belongsTo
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    public function cidade()
    {
        //Endereço só pode ter 1 cidade, por isso belongsTo
        return $this->belongsTo(Cidade::class, 'cidade_id');
    }

}
