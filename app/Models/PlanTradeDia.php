<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanTradeDia extends Model
{
    use HasFactory;

    protected $fillable = [
        'planTrade_id',
        'dia',
        'diaSemana',
        'metaDiaAnterior',
        'meta',
        'realizar',
        'riskMagagmentPlanejado',
        'pontosContratoPlanejado',
        'contratosPlanejado',
        'valorRealizado',
        'custoRealizado',
        'nrTrades',
        'nrGains',
        'nrLoss',
    ];
}
