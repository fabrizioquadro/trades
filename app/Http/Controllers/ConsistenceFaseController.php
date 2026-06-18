<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ConsistenceFase;

class ConsistenceFaseController extends Controller
{
    public function index(){
        $fases = ConsistenceFase::all();

        return view('consistenceFases/index', compact('fases'));
    }

    public function adicionar(){
        return view('consistenceFases/adicionar');
    }

    public function insert(Request $request){
        $dados = $request->all();

        ConsistenceFase::create($dados);
        return redirect()->route('consistenceFases')->with('mensagem','Fase Cadastrada!');
    }

    public function editar($id){
        $fase = ConsistenceFase::where('id', $id)->first();

        return view('consistenceFases/editar', compact('fase'));
    }

    public function update(Request $request){
        $id = $request->get('id');
        $dados = $request->except('_token','id');

        ConsistenceFase::where('id', $id)->update($dados);
        return redirect()->route('consistenceFases')->with('mensagem','Fase Editada!');
    }

    public function excluir($id){
        $fase = ConsistenceFase::where('id', $id)->first();

        return view('consistenceFases/excluir', compact('fase'));
    }

    public function delete(Request $request){
        $id = $request->get('id');

        ConsistenceFase::where('id', $id)->delete();
        return redirect()->route('consistenceFases')->with('mensagem','Fase Excluído!');
    }

    public function visualizar($id){
        $fase = ConsistenceFase::where('id', $id)->first();

        return view('consistenceFases/visualizar', compact('fase'));
    }

}
