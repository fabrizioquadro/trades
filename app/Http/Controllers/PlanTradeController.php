<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\Aluno;
use App\Models\PlanTrade;
use App\Models\PlanTradeDia;
use App\Models\Ativo;
use App\Http\Controllers\FiltroController;

class PlanTradeController extends Controller
{
    public function index(){
        $user = auth()->user();
        $planos = PlanTrade::listarPlanoAlunosFiltro($user);

        $filtro = new FiltroController();
        $filtro = $filtro->gerarFiltro('planTrade');

        return view('planTrade/index', compact('filtro','planos'));
    }

    public function visualizar($id){
        $planTrade = PlanTrade::where('id', $id)->first();
        $aluno = Aluno::where('id', $planTrade->aluno_id)->first();
        $dias = PlanTradeDia::where('planTrade_id', $planTrade->id)->orderBy('id')->get();

        //vamos pegar os dados do ativo
        $ativo = Ativo::where('id', $planTrade->id_ativo)->first();

        //vamos buscar o ultimo dia de preenchimento do plan
        $dia = PlanTradeDia::where('planTrade_id', $planTrade->id)->whereNotNull('valorRealizado')->orderByDesc('dia')->first();
        $ultimoDiaInsert = $dia ? $dia->dia : null;

        return view('planTrade/visualizar', compact('aluno','planTrade','dias','ativo','ultimoDiaInsert'));
    }
}
