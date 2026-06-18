<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ativo;
use App\Models\AtivoFavoritoAluno;
use App\Models\Corretora;

class AtivoAlunoController extends Controller
{
    public function index(){
        $aluno = session()->get('aluno');

        //$ativos = Ativo::all()->sortBy('nome');
        $ativos = Ativo::where('stAtivo','Ativo')->orderBy('nome')->get();
        $corretoras = Corretora::all()->sortBy('nome');

        $res = AtivoFavoritoAluno::where('aluno_id', $aluno->id)->get();

        $favoritos = array();
        foreach($res as $linha){
            $favoritos[] = $linha->ativo_id;
        }

        return view('acessoAluno/ativos/index', compact('ativos','corretoras','favoritos'));
    }

    public function visualizar($id = null){
        $ativo = Ativo::where('id', $id)->first();

        $corretoras = Corretora::all()->sortBy('nome');

        return view('acessoAluno/ativos/visualizar', compact('ativo','corretoras'));
    }

    public function favorito(){
        $aluno = session()->get('aluno');
        $ativo = Ativo::where('id', $_GET['ativo_id'])->first();

        $dados = [
            'aluno_id' => $aluno->id,
            'ativo_id' => $ativo->id,
        ];

        if(AtivoFavoritoAluno::where($dados)->count() > 0){
            AtivoFavoritoAluno::where($dados)->delete();
            $retorno['controle'] = 'Retirado';
        }
        else{
            $dados['nmAtivoFav'] = $ativo->nome;
            AtivoFavoritoAluno::create($dados);
            $retorno['controle'] = 'Inserido';
        }
        echo json_encode($retorno);
    }
}
