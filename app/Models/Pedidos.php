<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedidos extends Model
{
    protected $table = 'pedidos';
    protected $fillable = [
        'nome_cliente',
        'fone_cliente',
        'locEntrega',
        'pedido',
        'preco',
        'horario',
        'senha',
        'codigo_pix',
        'status'
    ];
}
