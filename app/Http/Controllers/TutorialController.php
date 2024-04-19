<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tutorial;

class TutorialController extends Controller
{
    public function index(){
        $tutoriais = Tutorial::all()->sortBy('nmTutorial');

        return view('tutoriais/index', compact('tutoriais'));
    }

    public function adicionar(){
        return view('tutoriais/adicionar');
    }

    public function insert(Request $request){
        $dados = $request->all();

        Tutorial::create($dados);

        return redirect()->route('tutoriais')->with('mensagem', 'Tutorial Salva!!');
    }

    public function editar($id){
        $tutorial = Tutorial::where('id', $id)->first();

        return view('tutoriais/editar', compact('tutorial'));
    }

    public function update(Request $request){
        $id = $request->get('id_tutorial');

        $dados = $request->only('nmTutorial','dsTutorial','dsVideo','tag');

        Tutorial::where('id', $id)->update($dados);

        return redirect()->route('tutoriais')->with('mensagem', 'Tutorial Salva!!');
    }

    public function excluir($id){
        $tutorial = Tutorial::where('id', $id)->first();

        return view('tutoriais/excluir', compact('tutorial'));
    }

    public function delete(Request $request){
        $id = $request->get('id_tutorial');

        Tutorial::where('id', $id)->delete();
        return redirect()->route('tutoriais')->with('mensagem', 'Tutorial Excluída!!');
    }
}
