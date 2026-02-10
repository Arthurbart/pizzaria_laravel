<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sabores extends Model
{
    protected $table = 'sabores';
    protected $fillable = [
        'nome',
        'classificacao',
        'preco',
        'ingredientes',
        'status'
    ];
}
