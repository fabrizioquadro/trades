<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mensagen;

class MensagemAlunoController extends Controller
{
    public function index(){
        $aluno = session()->get('aluno');

        //vamos buscar as mensagens do aluno
        $mensagens = Mensagen::where('id_aluno', $aluno->id)->orderByDesc('dtHrMensagem')->get();

        //vamos marcar todas as mensagens como lidas
        Mensagen::where('id_aluno', $aluno->id)->update(['stViewAluno' => 'Sim']);
        return view('acessoAluno/mensagens/index', compact('aluno','mensagens'));
    }

    public function insert(Request $request){
        $aluno = session()->get('aluno');

        $dados = [
            'id_aluno' => $aluno->id,
            'dtHrMensagem' => date('Y-m-d H:i:s'),
            'dsMensagem' => $request->get('dsMensagem'),
            'stViewAluno' => 'Sim',
            'stViewAdm' => 'Não',
            'emissor' => 'Aluno',
        ];

        Mensagen::create($dados);
        return redirect()->route('aluno.mensagens')->with('mensagem', "Mensagem enviada!!");
    }
}
