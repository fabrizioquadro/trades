<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aluno;

class LoginAlunoController extends Controller
{
    public function index(){
        return view('login/indexAluno');
    }

    public function login(Request $request){
        $dsEmail = $request->get('email');
        $dsSenha = md5($request->get('password'));

        $aluno = Aluno::where('dsEmail', $dsEmail)->first();

        if($aluno){
            if($aluno->dsSenha == $dsSenha && $aluno->stAluno == "Ativo"){
                $request->session()->put('aluno', $aluno);

                return redirect()->route('aluno.dashboard');
            }
            else{
                return redirect()->back()->with('mensagem', "Senha Inválido ou aluno inativo.");
            }
        }
        else{
            return redirect()->back()->with('mensagem', "Email Inválido");
        }
    }

    public function esqueceuSenha(){
        return view('login/esqueceuSenhaAluno');
    }

    public function recuperarSenha(Request $request){
        $dsEmail = $request->get('email');

        $aluno = Aluno::where('dsEmail', $dsEmail)->first();

        if($aluno){
            $novaSenha = createPassword(8, true, true, true, false);

            $aluno->dsSenha = md5($novaSenha);

            $aluno->save();

            $mensagem = "
            <h4>Nova Senha de Acesso</h4>
            <p>
                Foi alterado por sua solicitação a senha de acesso ao sistema da Smart Money Makers.
            </p>
            <p>
                Sua nova senha é: $novaSenha
            </p>
            ";

            enviarMail($aluno->dsEmail, 'Nova Senha de Acesso', $mensagem);

            return redirect()->route('aluno.index')->with('mensagem','Sua nova senha foi enviado para o seu email.');
        }
        else{
            return redirect()->back()->with('mensagem', "Email Inválido");
        }
    }

    public function logout(){
        \Session::flush();
        return redirect()->route('aluno.index');
    }


}
