<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AtivoMercado;

class AtivoMercadoController extends Controller
{
    public function index(){
        $ativos = AtivoMercado::all();

        return view('ativosMercado/index', compact('ativos'));
    }

    public function adicionar(){
        return view('ativosMercado/adicionar');
    }

    public function insert(Request $request){
        $dados = $request->all();

        AtivoMercado::create($dados);
        return redirect()->route('ativosMercado')->with('mensagem', 'Ativo cadastrado!');
    }

    public function excluir($id){
        $ativo = AtivoMercado::where('id', $id)->first();
        return view('ativosMercado/excluir', compact('ativo'));
    }

    public function delete(Request $request){
        $id = $request->get('id');

        AtivoMercado::where('id', $id)->delete();
        return redirect()->route('ativosMercado')->with('mensagem', 'Ativo excluído!');
    }
}
