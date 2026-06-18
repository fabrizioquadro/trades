<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProntuarioTurma;
use App\Models\ProntuarioAluno;
use App\Models\Tag;
use App\Models\Aluno;

class ProntuarioController extends Controller
{
    public function indexTurma(){
        $prontuarios = ProntuarioTurma::all();

        return view('prontuarios/indexTurma', compact('prontuarios'));
    }

    public function turmaAdicionar(){
        $tags = Tag::all()->sortBy('nmTag');

        return view('prontuarios/adicionarTurma', compact('tags'));
    }

    public function turmaInsert(Request $request){
        $dados = $request->all();
        ProntuarioTurma::create($dados);

        return redirect()->route('prontuarioTurma')->with('mensagem','Prontuário cadastrado');
    }

    public function turmaEditar($id){
        $prontuario = ProntuarioTurma::where('id', $id)->first();
        $tags = Tag::all()->sortBy('nmTag');

        return view('prontuarios/editarTurma', compact('prontuario','tags'));
    }

    public function turmaUpdate(Request $request){
        $id = $request->get('prontuario_id');
        $dados = $request->except('_token','prontuario_id');

        ProntuarioTurma::where('id', $id)->update($dados);

        return redirect()->route('prontuarioTurma')->with('mensagem','Prontuário editado!');
    }

    public function turmaVisualizar($id){
        $prontuario = ProntuarioTurma::where('id', $id)->first();

        return view('prontuarios/visualizarTurma', compact('prontuario'));
    }

    public function turmaExcluir($id){
        $prontuario = ProntuarioTurma::where('id', $id)->first();

        return view('prontuarios/excluirTurma', compact('prontuario'));
    }

    public function turmaDelete(Request $request){
        $id = $request->get('prontuario_id');

        ProntuarioTurma::where('id', $id)->delete();
        return redirect()->route('prontuarioTurma')->with('mensagem','Prontuário Excluído');
    }

    public function indexAluno(){
        $prontuarios = ProntuarioAluno::all();

        return view('prontuarios/indexAluno', compact('prontuarios'));
    }

    public function alunoAdicionar(){
        $alunos = Aluno::all()->sortBy('nmAluno');

        return view('prontuarios/adicionarAluno', compact('alunos'));
    }


    public function alunoInsert(Request $request){
        $dados = $request->all();

        ProntuarioAluno::create($dados);
        return redirect()->route('prontuarioAluno')->with('mensagem','Prontuário cadastrado');
    }

    public function alunoEditar($id){
        $prontuario = ProntuarioAluno::where('id', $id)->first();
        $alunos = Aluno::all()->sortBy('nmAluno');

        return view('prontuarios/editarAluno', compact('prontuario','alunos'));
    }

    public function alunoUpdate(Request $request){
        $id = $request->get('prontuario_id');
        $dados = $request->except('_token','prontuario_id');

        ProntuarioAluno::where('id', $id)->update($dados);

        return redirect()->route('prontuarioAluno')->with('mensagem','Prontuário editado!');
    }

    public function alunoVisualizar($id){
        $prontuario = ProntuarioAluno::where('id', $id)->first();

        return view('prontuarios/visualizarAluno', compact('prontuario'));
    }

    public function alunoExcluir($id){
        $prontuario = ProntuarioAluno::where('id', $id)->first();

        return view('prontuarios/excluirAluno', compact('prontuario'));
    }

    public function alunoDelete(Request $request){
        $id = $request->get('prontuario_id');

        ProntuarioAluno::where('id', $id)->delete();
        return redirect()->route('prontuarioAluno')->with('mensagem','Prontuário Excluído');
    }
}
