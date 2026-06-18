<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kanban;

class KanbanAlunoController extends Controller
{
    public function index(){
        $aluno = session()->get('aluno');

        //vamos buscar todos od kanbans de segunda feira
        $dados = [
            'aluno_id' => $aluno->id,
            'dia' => 'segunda'
        ];
        $segunda = Kanban::where($dados)->get();

        $dados['dia'] = 'terca';
        $terca = Kanban::where($dados)->get();

        $dados['dia'] = 'quarta';
        $quarta = Kanban::where($dados)->get();

        $dados['dia'] = 'quinta';
        $quinta = Kanban::where($dados)->get();

        $dados['dia'] = 'sexta';
        $sexta = Kanban::where($dados)->get();

        $dados['dia'] = 'sabado';
        $sabado = Kanban::where($dados)->get();

        $dados['dia'] = 'domingo';
        $domingo = Kanban::where($dados)->get();

        $controleSeg = false;
        $controleTer = false;
        $controleQua = false;
        $controleQui = false;
        $controleSex = false;
        $controleSab = false;
        $controleDom = false;
        return view('acessoAluno/kanban/index', compact(
            'segunda','controleSeg',
            'terca','controleTer',
            'quarta','controleQua',
            'quinta','controleQui',
            'sexta','controleSex',
            'sabado','controleSab',
            'domingo','controleDom'
            )
        );
    }

    public function insert(Request $request){
        $aluno = session()->get('aluno');

        $var = explode('-', $request->get('dia'));
        $dia = $var[1];
        $dados = $request->all();
        $dados['dia'] = $dia;
        $dados['aluno_id'] = $aluno->id;
        $dados['stKanban'] = 'Não Inicido';

        Kanban::create($dados);
        return redirect()->route('aluno.kanban');
    }

    public function buscar(){
        $kanban = Kanban::where('id', $_GET['id'])->first();

        $retorno['prioridade'] = $kanban->prioridade;
        $retorno['nmKanban'] = $kanban->nmKanban;
        $retorno['dsKanban'] = $kanban->dsKanban;
        $retorno['stKanban'] = $kanban->stKanban;

        echo json_encode($retorno);
    }

    public function update(Request $request){
        $id = $request->get('kanban_id');
        $dados = $request->except('kanban_id','_token');

        Kanban::where('id', $id)->update($dados);
        return redirect()->route('aluno.kanban');
    }

    public function delete(){
        $id = $_GET['id'];

        Kanban::where('id', $id)->delete();
        return redirect()->route('aluno.kanban');
    }

    public function mudarDia(){
        $var = explode('-', $_GET['border_dia']);
        $dia = $var[1];
        $id = $_GET['id'];

        Kanban::where('id', $id)->update(['dia' => $dia]);
    }
}
