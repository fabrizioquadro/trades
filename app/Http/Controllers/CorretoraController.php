<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Corretora;

class CorretoraController extends Controller
{
    public function index(){
        $corretoras = Corretora::all()->sortBy('nome');

        return view('corretoras/index', compact('corretoras'));
    }

    public function adicionar(){
        return view('corretoras/adicionar');
    }

    public function insert(Request $request){
        Corretora::create([
            'nome' => $request->get('nome'),
        ]);

        return redirect()->route('corretoras')->with('mensagem', 'Cadastrado com Sucesso!');
    }

    public function editar($id){
        $corretora = Corretora::where('id', $id)->first();

        return view('corretoras/editar', compact('corretora'));
    }

    public function update(Request $request){
        Corretora::where('id',$request->get('id'))
          ->update([
              'nome' => $request->get('nome')
          ]);

        return redirect()->route('corretoras')->with('mensagem', 'Editado com Sucesso!');
    }

    public function excluir($id){
        $corretora = Corretora::where('id', $id)->first();

        return view('corretoras/excluir', compact('corretora'));
    }

    public function delete(Request $request){
        Corretora::where('id', $request->get('id'))->delete();

        return redirect()->route('corretoras')->with('mensagem', 'Excluido com Sucesso!');
    }


}
