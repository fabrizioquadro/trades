<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ativo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'simbolo',
        'cqgSimbolo',
        'pais',
        'tipoAtivo',
        'exchange',
        'tamanhoContrato',
        'meses',
        'valor',
        'tick',
        'swing',
        'dayTrading',
        'moedaAtivo',
        'tipoCusto',
        'stAtivo',
    ];

}
