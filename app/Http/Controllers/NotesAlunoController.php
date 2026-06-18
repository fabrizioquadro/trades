<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notes;

class NotesAlunoController extends Controller
{
    public function index(){
        $aluno = session()->get('aluno');

        $notes = Notes::where('aluno_id', $aluno->id)->get();
        return view('acessoAluno/notes/index', compact('notes'));
    }

    public function adicionar(){
        return view('acessoAluno/notes/adicionar');
    }

    public function insert(Request $request){
        $aluno = session()->get('aluno');
        $dados = $request->all();
        $dados['aluno_id'] = $aluno->id;

        Notes::create($dados);

        return redirect()->route('aluno.notes')->with('mensagem', 'Cadastrado com Sucesso!');
    }

    public function editar($id){
        $note = Notes::where('id', $id)->first();

        return view('acessoAluno/notes/editar', compact('note'));
    }

    public function update(Request $request){
        $id = $request->get('note_id');
        $dados = $request->except('note_id','_token');

        Notes::where('id', $id)->update($dados);
        return redirect()->route('aluno.notes')->with('mensagem', 'Editado com Sucesso!');
    }

    public function delete($id){
        Notes::where('id', $id)->delete();
        return redirect()->route('aluno.notes')->with('mensagem', 'Excluído com Sucesso!');
    }
}
