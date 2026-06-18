<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\MatrizDecisao;
use App\Models\Aluno;
use App\Models\Ativo;
use App\Http\Controllers\FiltroController;

class MatrizDecisaoController extends Controller
{
    public function index(){
        $user = auth()->user();
        $matrizes = MatrizDecisao::listarMatrizesAlunosFiltro($user);

        $filtro = new FiltroController();
        $filtro = $filtro->gerarFiltro('matrizDecisao');

        return view('matrizDecisao/index', compact('filtro','matrizes'));
    }

    public function visualizar($id){
        $matrizSet = MatrizDecisao::where('id', $id)->first();
        $aluno = Aluno::where('id', $matrizSet->id_aluno)->first();
        $ativo = Ativo::where('id', $matrizSet->id_ativo)->first();

        return view('matrizDecisao/visualizar', compact('matrizSet','aluno','ativo'));
    }
}
