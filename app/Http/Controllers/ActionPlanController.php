<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActionPlan;
use App\Http\Controllers\FiltroController;

class ActionPlanController extends Controller
{
    public function index(){
        $user = auth()->user();
        $data = date('Y-m-d');
        $data = date('Y-m-d', strtotime("-180 days",strtotime($data)));

        $filtro = new FiltroController();
        $filtro = $filtro->gerarFiltro('actionPlan');

        $GET['dtInc'] = $_GET ? $_GET['dtInc'] : null;
        $GET['dtFn'] = $_GET ? $_GET['dtFn'] : null;
        $GET['dsQuem'] = $_GET ? $_GET['dsQuem'] : null;
        $GET['situacao'] = $_GET ? $_GET['situacao'] : null;

        //$actions = ActionPlan::where('quando','>',$data)->get();
        $actions = ActionPlan::listarActionsFiltro($user, $GET);
        return view('actionPlan/index', compact('actions','filtro','GET'));
    }

    public function buscar(){
        $action = ActionPlan::where('id', $_GET['id'])->first();

        $retorno['oque'] = $action->oque;
        $retorno['quem'] = $action->quem;
        $retorno['quando'] = dataDbForm($action->quando);
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
        return redirect()->route('actionPlan')->with('mensagem','Action Plan Salva');
    }

    public function delete(){
        $action_id = $_GET['id'];

        ActionPlan::where('id', $action_id)->delete();
        return redirect()->route('actionPlan');
    }
}
