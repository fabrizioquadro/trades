<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ConsistenceInfo;
use App\Models\ConsistenceFase;
use App\Models\ConsistenceDiamond;
use App\Models\Tag;
use App\Models\Aluno;
use App\Http\Controllers\FiltroController;

class ConsistenceController extends Controller
{
    public function riskReward(){
        $info = ConsistenceInfo::where('id',1)->first();

        return view('consistence/riskReward', compact('info'));
    }

    public function weeks(){
        $info = ConsistenceInfo::where('id',1)->first();

        return view('consistence/weeks', compact('info'));
    }

    public function months(){
        $info = ConsistenceInfo::where('id',1)->first();

        return view('consistence/months', compact('info'));
    }

    public function gainsLosses(){
        $info = ConsistenceInfo::where('id',1)->first();

        return view('consistence/gainsLosses', compact('info'));
    }

    public function trades(){
        $info = ConsistenceInfo::where('id',1)->first();

        return view('consistence/trades', compact('info'));
    }

    public function update(Request $request){
        $dados = $request->except('_token','controle');
        $controle = $request->get('controle');

        ConsistenceInfo::where('id',1)->update($dados);
        return redirect()->route("consistence.$controle");
    }

    public function listar(){
        $user = auth()->user();
        $filtro = new FiltroController();
        $filtro = $filtro->gerarFiltro('consistence.listar');

        $diamantes = ConsistenceDiamond::listarConsistenceAlunosFiltro($user);

        return view('consistence/listar', compact('diamantes','filtro'));
    }

    public function visualizar($id){
        $diamante = ConsistenceDiamond::where('id', $id)->first();
        $aluno = Aluno::where('id', $diamante->aluno_id)->first();
        $info = ConsistenceInfo::where('id', 1)->first();
        $fases = ConsistenceFase::all();

        return view('consistence/visualizar', compact('diamante','info','fases','aluno'));
    }
}
