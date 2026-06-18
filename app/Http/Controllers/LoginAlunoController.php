<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aluno;
use App\Models\Agreements;
use App\Models\LogAceiteTermos;

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

                if($aluno->aceitePrivacyPolice && $aluno->aceiteCookiesPolice && $aluno->aceiteTermsAndConditions && $aluno->aceiteNonDisclosure && $aluno->aceiteRiskWarning){
                    return redirect()->route('aluno.dashboard');
                }
                else{
                    return redirect()->route('aluno.aceitarTermosCumplice');
                }


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

    public function aceitarTermosCumplice($controle = 'true'){
        $aluno = session()->get('aluno');
        $agreements = Agreements::where('id', 1)->first();

        return view('login/aceitarTermosCumplice', compact('controle','agreements','aluno'));
    }

    public function aceitarTermosCumpliceSet(Request $request){
        $aluno = session()->get('aluno');
        $agreements = Agreements::where('id', 1)->first();

        $dados_log = [
            'aluno_id' => $aluno->id,
        ];

        $mensagem = "

        <h2>Obrigado por ter aceitado as Políticas da Smart Money Makers e Smart Money Metrics App</h2>
        <p>
            Seguem as políticas assinadas para o seu arquivo.
        </p>
        <hr>
        <div style='background-color: #30334e; padding: 10px 50px 20px;'>
            $agreements->termosPrivacyPolicy
            <hr>
            $agreements->cookiesPolicy
            <hr>
            $agreements->termsAndConditions
            <hr>
            $agreements->nonDisclosure
            <hr>
            $agreements->riskWarning
        </div>
        ";

        if($request->get('aceiteTermosPrivacyPolicy') == 'sim'){
            //vamos registrar o log
            $dados_log['tpAceite'] = 'PrivacyPolicy';
            LogAceiteTermos::create($dados_log);

            $aluno->aceitePrivacyPolice = true;
            $aluno->dataPrivacyPolice = date('Y-m-d H:i:s');
        }

        if($request->get('aceiteCookiesPolicy') == 'sim'){
            //vamos registrar o log
            $dados_log['tpAceite'] = 'CookiesPolicy';
            LogAceiteTermos::create($dados_log);

            $aluno->aceiteCookiesPolice = true;
            $aluno->dataCookiesPolice = date('Y-m-d H:i:s');
        }

        if($request->get('termsAndConditions') == 'sim'){
            //vamos registrar o log
            $dados_log['tpAceite'] = 'TermsAndConditions';
            LogAceiteTermos::create($dados_log);

            $aluno->aceiteTermsAndConditions = true;
            $aluno->dataTermsAndConditions = date('Y-m-d H:i:s');
        }

        if($request->get('nonDisclosure') == 'sim'){
            //vamos registrar o log
            $dados_log['tpAceite'] = 'NonDisclosure';
            LogAceiteTermos::create($dados_log);

            $aluno->aceiteNonDisclosure = true;
            $aluno->dataNonDisclosure = date('Y-m-d H:i:s');
        }

        if($request->get('riskWarning') == 'sim'){
            //vamos registrar o log
            $dados_log['tpAceite'] = 'RiskWarning';
            LogAceiteTermos::create($dados_log);

            $aluno->aceiteRiskWarning = true;
            $aluno->dataRiskWarning = date('Y-m-d H:i:s');
        }

        if($request->get('dsSenha')){
            $aluno->dsSenha = md5($request->get('dsSenha'));
            $aluno->setarNovaSenha = true;
        }

        $aluno->save();

        enviarMail($aluno->dsEmail,'Políticas de Compliance da Smart Money Makers', $mensagem);

        return redirect()->route('aluno.dashboard');
    }

    public function excluirConta(){
        return view('login/excluirContaAluno');
    }

    public function excluirContaDelete(Request $request){
        if($request->get('acao')){
            $aluno = session()->get('aluno');
            $aluno->stAluno = "Inativo";
            $aluno->save();

            return redirect()->route('aluno.logout');
        }
    }
}
