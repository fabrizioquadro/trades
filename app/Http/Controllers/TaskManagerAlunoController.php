<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TaskManager;

class TaskManagerAlunoController extends Controller
{
    public function index(){
        $aluno = session()->get('aluno');
        $data = date('Y-m-d');
        $dtInc =  date('Y-m-d', strtotime("-90 days",strtotime($data)));
        $dtFn =  date('Y-m-d', strtotime("+90 days",strtotime($data)));

        if($_POST){
            if(!empty($_POST['controleFinalizados']) && !empty($_POST['controleNaoFinalizados'])){
                $tasks = TaskManager::where('aluno_id', $aluno->id)
                    ->where('dtTask','>=',$dtInc)
                    ->where('dtTask','<=',$dtFn)
                    ->get();

                    $controleFinalizados = 'checked';
                    $controleNaoFinalizados = 'checked';
            }
            elseif(!empty($_POST['controleFinalizados'])){
                $tasks = TaskManager::where('aluno_id', $aluno->id)
                    ->where('stTask', 'Finalizado')
                    ->where('dtTask','>=',$dtInc)
                    ->where('dtTask','<=',$dtFn)
                    ->get();

                    $controleFinalizados = 'checked';
                    $controleNaoFinalizados = '';
            }
            elseif(!empty($_POST['controleNaoFinalizados'])){
                $tasks = TaskManager::where('aluno_id', $aluno->id)
                    ->where('stTask', 'Não Finalizado')
                    ->where('dtTask','>=',$dtInc)
                    ->where('dtTask','<=',$dtFn)
                    ->get();

                    $controleFinalizados = '';
                    $controleNaoFinalizados = 'checked';
            }
            else{
                $tasks = TaskManager::where('aluno_id', $aluno->id)
                    ->where('dtTask','>=',$dtInc)
                    ->where('dtTask','<=',$dtFn)
                    ->get();

                    $controleFinalizados = 'checked';
                    $controleNaoFinalizados = 'checked';
            }
        }
        else{
            $tasks = TaskManager::where('aluno_id', $aluno->id)
                ->where('dtTask','>=',$dtInc)
                ->where('dtTask','<=',$dtFn)
                ->get();

                $controleFinalizados = 'checked';
                $controleNaoFinalizados = 'checked';
        }

        $arrayTasks = array();

        foreach($tasks as $task){
            $end = $dtFn =  date('Y-m-d', strtotime("+1 days",strtotime($task->dtTask)));

            $array = array();
            if($task->stTask == "Finalizado"){
                $stTask = "Cumprido";
                $url = 'success';
            }
            elseif($task->stTask == "Não Finalizado"){
                $stTask = "Não Cumprido";
                $url = 'danger';
            }
            else{
                $stTask = "";
                $url = 'warning';
            }
            $array['title'] = $stTask;
            $array['start'] = $task->dtTask." 00:00:00";
            $array['end'] = $end." 00:00:00";
            $array['allDay'] = true;
            $array['url'] = $url;
            $arrayTasks[] = $array;
        }

        $eventos = $arrayTasks;
        $controleVirgula = false;

        return view('acessoAluno/taskManager/index', compact('aluno','eventos','controleVirgula','controleFinalizados','controleNaoFinalizados'));
    }

    public function insert(Request $request){
        $aluno = session()->get('aluno');

        //vamos verificar se já há ou não no BD
        $task = TaskManager::where('aluno_id', $aluno->id)
        ->where('dtTask', $request->get('dtTask'))
        ->first();

        $dados = $request->except('_token');

        if($task){
            TaskManager::where('id', $task->id)->update($dados);
        }
        else{
            $dados['aluno_id'] = $aluno->id;
            TaskManager::create($dados);
        }



        return redirect()->route('aluno.taskManager');
    }

    public function buscar(){
        $dados = [
            'aluno_id' => $_GET['aluno_id'],
            'dtTask' => $_GET['data'],
        ];
        $task = TaskManager::where($dados)->first();

        if($task){
            $retorno['dtTask'] = $_GET['data'];
            $retorno['stTask'] = $task->stTask;
            $retorno['dsTask'] = $task->dsTask;
        }
        else{
            $retorno['dtTask'] = $_GET['data'];
            $retorno['stTask'] = '';
            $retorno['dsTask'] = '';
        }


        echo json_encode($retorno);
    }
}
