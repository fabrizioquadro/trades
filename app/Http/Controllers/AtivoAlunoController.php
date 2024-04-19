<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ativo;
use App\Models\Corretora;

class AtivoAlunoController extends Controller
{
    public function index(){
        $aluno = session()->get('aluno');

        //$ativos = Ativo::all()->sortBy('nome');
        $ativos = Ativo::where('stAtivo','Ativo')->orderBy('nome')->get();

        return view('acessoAluno/ativos/index', compact('ativos'));
    }

    public function visualizar($id){
        $ativo = Ativo::where('id', $id)->first();

        $corretoras = Corretora::all()->sortBy('nome');

        return view('acessoAluno/ativos/visualizar', compact('ativo','corretoras'));
    }
}
