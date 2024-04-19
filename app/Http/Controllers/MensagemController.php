<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mensagen;
use App\Models\Aluno;

class MensagemController extends Controller
{
    public function index(){
        $mensagens = Mensagen::buscaMensagensAdm();

        return view('mensagens/index', compact('mensagens'));
    }

    public function aluno($id){
        $mensagens = Mensagen::where('id_aluno', $id)->orderByDesc('dtHrMensagem')->get();

        //vamos marcar essas mensagens como lidas
        Mensagen::where('id_aluno', $id)->update(['stViewAdm' => 'Sim']);

        $aluno = Aluno::where('id', $id)->first();

        return view('mensagens/aluno', compact('aluno','mensagens'));
    }

    public function insert(Request $request){
        $dados = [
            'id_aluno' => $request->get('id_aluno'),
            'dtHrMensagem' => date('Y-m-d H:i:s'),
            'dsMensagem' => $request->get('dsMensagem'),
            'stViewAluno' => 'Não',
            'stViewAdm' => 'Sim',
            'emissor' => 'Adm',
        ];

        Mensagen::create($dados);

        return redirect()->route('mensagens')->with('mensagem','Mensagem Enviada.');
    }
}
