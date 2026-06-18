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

    public function corretora(){
        $sql = "SELECT corretoras.nome AS nmCorretora FROM corretoras, ativo_corretoras WHERE
        corretoras.id=ativo_corretoras.id_corretora
        AND ativo_corretoras.id_ativo='$this->id'";
        $result = collect(\DB::select($sql))->first();
        return $result->nmCorretora;
    }

}
