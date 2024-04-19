<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ativo;
use App\Models\MatrizDecisao;

class MatrizDecisaoAlunoController extends Controller
{
    public function index($id = NULL, $controle = NULL){
        $aluno = session()->get('aluno');
        //$ativos = Ativo::all()->sortBy('nome');
        $ativos = Ativo::where('stAtivo', 'Ativo')->orderBy('nome')->get();

        $matrizes = MatrizDecisao::select('matrizdecisao.id','matrizdecisao.dtHrCadastro','ativos.nome')
        ->where('id_aluno', $aluno->id)
        ->leftJoin('ativos','matrizdecisao.id_ativo','=','ativos.id')
        ->get();

        $matrizSet = NULL;

        if($id){
            $matrizSet = MatrizDecisao::select('*', 'matrizdecisao.id AS id_matriz')
            ->where('matrizdecisao.id', $id)
            ->leftJoin('ativos','matrizdecisao.id_ativo','=','ativos.id')
            ->first();

            $var = explode(' ', $matrizSet->dtHrCadastro);
            $matrizSet->dtHrCadastro = dataDbForm($var[0])." ".$var[1];
        }

        return view('acessoAluno/matrizDecisao/index', compact('ativos','aluno','matrizes','matrizSet','controle'));
    }

    public function insert(Request $request){
        $aluno = session()->get('aluno');
        $dados = $request->all();
        $dados['id_aluno'] = $aluno->id;
        $dados['dtHrCadastro'] = date('Y-m-d H:i:s');

        MatrizDecisao::create($dados);

        return redirect()->route('aluno.matrizDecisao')->with('mensagem','Matriz de Decisão Salva');
    }

    public function update(Request $request){
        $dados = $request->except('_token','id_matriz');
        $id_matriz = $request->get('id_matriz');

        MatrizDecisao::where('id', $id_matriz)->update($dados);

        return redirect()->route('aluno.matrizDecisao')->with('mensagem','Matriz de Decisão Salva');
    }

    public function delete($id){
        $aluno = session()->get('aluno');

        $matriz = MatrizDecisao::where('id', $id)->first();

        if($aluno->id == $matriz->id_aluno){
            MatrizDecisao::where('id', $matriz->id)->delete();

            return redirect()->route('aluno.matrizDecisao')->with('mensagem','Matriz de Decisão Excluída!');
        }
    }
}
