<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tamanhos extends Model
{
    protected $table = 'tamanho';
    protected $fillable = [
        'nome',
        'preco',
        'qsabores',
        'qpedacos',
        'status'
    ];
}
