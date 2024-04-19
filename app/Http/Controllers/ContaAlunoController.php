<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conta;
use App\Models\Corretora;
use App\Models\Trade;
use App\Models\ContaSaqueDeposito AS Deposito;
use App\Models\ContaSaqueDeposito AS Saque;

class ContaAlunoController extends Controller
{
    public function index(){
        $aluno = session()->get('aluno');

        $contas = Conta::listarContasAluno($aluno->id);

        return view('acessoAluno/contas/index', compact('contas'));
    }

    public function adicionar(){
        $corretoras = Corretora::all()->sortBy('name');
        return view('acessoAluno/contas/adicionar', compact('corretoras'));
    }

    public function insert(Request $request){
        $aluno = session()->get('aluno');
        $dados = $request->all();
        $dados['id_aluno'] = $aluno->id;
        $dados['vlContaInc'] = valorFormDb($dados['vlContaInc']);

        Conta::create($dados);

        return redirect()->route('aluno.contas')->with('mensagem','Conta Cadastrada!');
    }

    public function editar($id){
        $conta = Conta::where('id', $id)->first();

        $corretoras = Corretora::all()->sortBy('name');

        return view('acessoAluno/contas/editar', compact('conta','corretoras'));
    }

    public function update(Request $request){
        $aluno = session()->get('aluno');
        $id = $request->get('id');
        $dados = $request->only('nrConta','nmConta','id_corretora','dsConta','vlContaInc');
        $dados['vlContaInc'] = valorFormDb($dados['vlContaInc']);

        Conta::where('id',$id)
          ->where('id_aluno', $aluno->id)
          ->update($dados);

        return redirect()->route('aluno.contas')->with('mensagem', 'Conta Editada!');
    }

    public function excluir($id){
        $conta = Conta::where('id', $id)->first();

        return view('acessoAluno/contas/excluir', compact('conta'));
    }

    public function delete(Request $request){
        $aluno = session()->get('aluno');
        $id = $request->get('id');
        $conta = Conta::where('id', $id)->first();

        if($conta->id_aluno == $aluno->id){
            //vamos apagar todas as movimentações dessa conta
            Deposito::where('id_conta', $conta->id)->delete();

            //vamos deletar todas as trades dessa conta
            Trade::where('id_conta', $conta->id)->delete();

            Conta::where('id',$id)
              ->where('id_aluno', $aluno->id)
              ->delete();
        }


        return redirect()->route('aluno.contas')->with('mensagem', 'Conta Excluida!');
    }

    public function depositos($id){
        $conta = Conta::where('id', $id)->first();

        $depositos = Deposito::where('id_conta', $conta->id)
            ->where('tpMovimento', 'Depósito')
            ->get();

        return view('acessoAluno/contas/depositos', compact('conta','depositos'));
    }

    public function depositosAdicionar($id){
        $aluno = session()->get('aluno');
        $conta = Conta::where('id', $id)
            ->where('id_aluno', $aluno->id)
            ->first();

        return view('acessoAluno/contas/depositar', compact('conta'));
    }

    public function depositosInsert(Request $request){
        $aluno = session()->get('aluno');
        $conta = Conta::where('id', $request->get('id_conta'))->first();

        if($aluno->id == $conta->id_aluno){
            $dados = $request->all();
            $dados['vlMovimento'] = valorFormDb($dados['vlMovimento']);
            $dados['tpMovimento'] = "Depósito";
            Deposito::create($dados);

            return redirect()->route('aluno.contas.deposito', $conta->id)->with('mensagem', 'Depósito Cadastrado');
        }
        else{
            echo "Você não possui permissão para fazer esse tipo de depósito";
        }
    }

    public function depositosExcluir($id){
        $deposito = Deposito::where('id', $id)->first();

        $conta = Conta::where('id', $deposito->id_conta)->first();

        return view('acessoAluno/contas/excluirDeposito', compact('deposito','conta'));
    }

    public function depositosDelete(Request $request){
        $aluno = session()->get('aluno');
        $deposito = Deposito::where('id', $request->get('id'))->first();
        $conta = Conta::where('id', $deposito->id_conta)->first();
        if($deposito->tpMovimento == "Depósito" && $conta->id_aluno == $aluno->id){
            Deposito::where('id', $deposito->id)->delete();

            return redirect()->route('aluno.contas.deposito', $conta->id)->with('mensagem', 'Depósito Excluido');
        }
        else{
            echo "Você não tem permissão para a exclusão do depósito";
        }
    }

    public function saques($id){
        $conta = Conta::where('id', $id)->first();

        $saques = Saque::where('id_conta', $conta->id)
            ->where('tpMovimento', 'Saque')
            ->get();

        return view('acessoAluno/contas/saques', compact('conta','saques'));
    }

    public function saquesAdicionar($id){
        $aluno = session()->get('aluno');
        $conta = Conta::where('id', $id)
            ->where('id_aluno', $aluno->id)
            ->first();

        return view('acessoAluno/contas/sacar', compact('conta'));
    }

    public function saquesInsert(Request $request){
        $aluno = session()->get('aluno');
        $conta = Conta::where('id', $request->get('id_conta'))->first();

        if($aluno->id == $conta->id_aluno){
            $dados = $request->all();
            $dados['vlMovimento'] = valorFormDb($dados['vlMovimento']);
            $dados['tpMovimento'] = "Saque";
            Saque::create($dados);

            return redirect()->route('aluno.contas.saque', $conta->id)->with('mensagem', 'Saque Cadastrado');
        }
        else{
            echo "Você não possui permissão para fazer esse tipo de saque";
        }
    }

    public function saquesExcluir($id){
        $saque = Saque::where('id', $id)->first();

        $conta = Conta::where('id', $saque->id_conta)->first();

        return view('acessoAluno/contas/excluirSaque', compact('saque','conta'));
    }

    public function saquesDelete(Request $request){
        $aluno = session()->get('aluno');
        $saque = Saque::where('id', $request->get('id'))->first();
        $conta = Conta::where('id', $saque->id_conta)->first();
        if($saque->tpMovimento == "Saque" && $conta->id_aluno == $aluno->id){
            Saque::where('id', $saque->id)->delete();

            return redirect()->route('aluno.contas.saque', $conta->id)->with('mensagem', 'Saque Excluido');
        }
        else{
            echo "Você não tem permissão para a exclusão do saque";
        }
    }


}
