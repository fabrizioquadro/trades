<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ConsistenceDiamond;
use App\Models\ConsistenceInfo;
use App\Models\ConsistenceFase;

class ConsistenceDiamondAlunoController extends Controller
{
    public function index(){
        $aluno = session()->get('aluno');
        $diamantes = ConsistenceDiamond::where('aluno_id', $aluno->id)->get();

        return view('acessoAluno/consistence/index', compact('diamantes'));
    }

    public function adicionar(){
        return view('acessoAluno/consistence/adicionar');
    }

    public function insert(Request $request){
        $aluno = session()->get('aluno');
        $var = explode('-',$request->get('mes'));
        $ano = $var[0];
        $mes = $var[1];

        $dados = [
            'aluno_id' => $aluno->id,
            'ano' => $ano,
            'mes' => $mes,
        ];

        ConsistenceDiamond::create($dados);

        return redirect()->route('aluno.consistence')->with('mensagem','Consistency Diamond cadastrado!');
    }

    public function acessar($id){
        $diamante = ConsistenceDiamond::where('id', $id)->first();
        $info = ConsistenceInfo::where('id', 1)->first();
        $fases = ConsistenceFase::all();

        return view('acessoAluno/consistence/acessar', compact('diamante','info','fases'));
    }

    public function update(Request $request){
        $id = $request->get('id');
        $dados = $request->except('_token','id');

        ConsistenceDiamond::where('id', $id)->update($dados);

        return redirect()->route('aluno.consistence.acessar', $id);
    }

    public function detalhesFase(){
        $fase = ConsistenceFase::where('id', $_GET['fase_id'])->first();

        $retorno['nome'] = $fase->nmFase;
        $retorno['dados'] = $fase->descricao;

        echo json_encode($retorno);
    }

    public function excluir($id){
        $diamante = ConsistenceDiamond::where('id', $id)->first();

        return view('acessoAluno/consistence/excluir', compact('diamante'));
    }

    public function delete(Request $request){
        $id = $request->get('id');

        ConsistenceDiamond::where('id', $id)->delete();
        return redirect()->route('aluno.consistence')->with('mensagem','Diamante Excluído');
    }
}
