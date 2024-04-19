<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatrizDecisao extends Model
{
    use HasFactory;

    protected $table = "matrizdecisao";

    protected $fillable = [
        'id_aluno',
        'id_ativo',
        'dtHrCadastro',
        'tLMensal',
        'tLMensalFlag',
        'tUTMensal',
        'tUTMensalFlag',
        'candleMensal',
        'candleMensalFlag',
        'conclusaoMensal',
        'obsMensal',
        'tLSemanal',
        'tLSemanalFlag',
        'tUTSemanal',
        'tUTSemanalFlag',
        'candleSemanal',
        'candleSemanalFlag',
        'conclusaoSemanal',
        'obsSemanal',
        'tLDiario',
        'tLDiarioFlag',
        'tUTDiario',
        'tUTDiarioFlag',
        'candleDiario',
        'candleDiarioFlag',
        'conclusaoDiario',
        'obsDiario',
        'tL60min',
        'tL60minFlag',
        'tUT60min',
        'tUT60minFlag',
        'candle60min',
        'candle60minFlag',
        'conclusao60min',
        'obs60min',
        'tL15min',
        'tL15minFlag',
        'tUT15min',
        'tUT15minFlag',
        'candle15min',
        'candle15minFlag',
        'conclusao15min',
        'obs15min',
        'tL5min',
        'tL5minFlag',
        'tUT5min',
        'tUT5minFlag',
        'candle5min',
        'candle5minFlag',
        'conclusao5min',
        'obs5min',
        'conclusaoTL',
        'conclusaoTUT',
        'conclusaoCandle',
        'conclusaoConclusao',
        'conclusaoObs',
    ];
}
