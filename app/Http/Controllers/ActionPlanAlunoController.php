<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActionPlan;

class ActionPlanAlunoController extends Controller
{
    public function index(){
        $aluno = session()->get('aluno');
        $actions = ActionPlan::where('aluno_id', $aluno->id)->orderBy('nrPlan')->get();
        return view('acessoAluno/actionPlan/index', compact('actions'));
    }

    public function insert(Request $request){
        $aluno = session()->get('aluno');

        $dados = $request->all();
        $dados['aluno_id'] = $aluno->id;
        $dados['nrPlan'] = ActionPlan::getProximoNrPlan($aluno->id);
        $dados['status'] = 'Não Iniciado';

        ActionPlan::create($dados);
        return redirect()->route('aluno.actionPlan')->with('mensagem','Action Plan Inserido');
    }

    public function buscar(){
        $action = ActionPlan::where('id', $_GET['id'])->first();

        $retorno['oque'] = $action->oque;
        $retorno['quem'] = $action->quem;
        $retorno['quando'] = $action->quando;
        $retorno['como'] = $action->como;
        $retorno['onde'] = $action->onde;
        $retorno['quanto'] = $action->quanto;
        $retorno['status'] = $action->status;

        echo json_encode($retorno);
    }

    public function update(Request $request){
        $id = $request->get('id');

        $dados = $request->except('_token','id');

        ActionPlan::where('id', $id)->update($dados);
        return redirect()->route('aluno.actionPlan')->with('mensagem','Action Plan Salva');
    }

    public function delete(){
        $id = $_GET['id'];

        ActionPlan::where('id', $id)->delete();
        return redirect()->route('aluno.actionPlan')->with('mensagem','Action Plan Excluída');
    }

    public function ordenar(){
        $retorno['retorno'] = 'true';
        $id = $_GET['action_id'];
        $nrOrigem = $_GET['nrOrigem'];
        $nrDestino = $_GET['nrDestino'];
        $retorno['nrOrigem'] = $nrOrigem;
        $retorno['nrDestino'] = $nrDestino;

        if($nrOrigem < $nrDestino){
            //vamos buscar todas as faqs que são maiores que a origem e menores igual que o destino
            $actions = ActionPlan::where('nrPlan','>',$nrOrigem)
            ->where('nrPlan','<=',$nrDestino)
            ->orderBy('nrPlan')
            ->get();

            foreach($actions as $linha){
                ActionPlan::where('id', $linha->id)->update(['nrPlan' => $nrOrigem]);
                $nrOrigem++;
            }

            ActionPlan::where('id',$id)->update(['nrPlan' => $nrDestino]);
        }
        elseif($nrOrigem > $nrDestino){
            //vamos buscar todas as faqs que são maiores que a origem e menores igual que o destino
            $actions = ActionPlan::where('nrPlan','>=',$nrDestino)
            ->where('nrPlan','<',$nrOrigem)
            ->orderBy('nrPlan')
            ->get();

            ActionPlan::where('id',$id)->update(['nrPlan' => $nrDestino]);
            $nrDestino++;

            foreach($actions as $linha){
                ActionPlan::where('id', $linha->id)->update(['nrPlan' => $nrDestino]);
                $nrDestino++;
            }
        }

        $retorno['controle'] = 'true';

        echo json_encode($retorno);
    }
}
