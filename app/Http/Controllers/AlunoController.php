<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aluno;
use App\Models\Tag;
use App\Models\AlunoTag;
use App\Models\Ativo;
use Illuminate\Support\Facades\DB;

class AlunoController extends Controller
{
    public function index(){
        $alunos = Aluno::all();

        return view('alunos/index', compact('alunos'));
    }

    public function adicionar(){
        $tags = Tag::all()->sortBy('nmTag');

        return view('alunos/adicionar', compact('tags'));
    }

    public function insert(Request $request){
        $dados = $request->all();
        if($request->get('enviarSenhaEmail') == 'sim'){
            $senha = createPassword(8,true,true,true,true);
            $dados['dsSenha'] = md5($senha);

            $mensagem = "
            Senha de acesso ao sistema Smart Money Metrics<br>
            Senha: '$senha'
            ";
            enviarMail($request->get('dsEmail'),'Senha de Acesso',$mensagem);
        }
        else{
            $dados['dsSenha'] = md5($request->get('dsSenha'));
        }

        $aluno = Aluno::create($dados);

        //vamos verificar as suas tags
        $tags = $request->get('tags');
        $dados_tag = [
            'id_aluno' => $aluno->id,
        ];
        foreach ($tags as $tag){
            $dados_tag['id_tag'] = $tag;
            AlunoTag::create($dados_tag);
        }

        if($request->hasFile('imagem') && $request->file('imagem')->isValid()){
            $imagem = $request->imagem;
            $extensao = $imagem->extension();

            $nmImagem = $aluno->id.".".$extensao;

            $request->imagem->move(public_path('img/alunos'), $nmImagem);

            $aluno['imagem'] = $nmImagem;

            $aluno->save();
        }

        return redirect()->route('alunos')->with('mensagem', 'Aluno Cadastrado');
    }

    public function visualizar($id){
        $aluno = Aluno::where('id', $id)->first();
        $tags = Tag::all()->sortBy('nmTag');
        $alunoTags = AlunoTag::where('id_aluno', $aluno->id)->get();

        return view('alunos/visualizar', compact('aluno','tags','alunoTags'));
    }

    public function editar($id){
        $aluno = Aluno::where('id', $id)->first();
        $tags = Tag::all()->sortBy('nmTag');
        $alunoTags = AlunoTag::where('id_aluno', $aluno->id)->get();

        return view('alunos/editar', compact('aluno','tags','alunoTags'));
    }

    public function update(Request $request){
        $id = $request->get('id');
        $dados = $request->only('nmAluno','dsEmail','dsEndereco','nrEndereco','dsComplemento','dsBairro','nmCidade','dsEstado','nmPais','nrCep','nrTel','stAluno');

        Aluno::where('id', $id)->update($dados);

        $aluno = Aluno::where('id', $id)->first();

        //vamos apagar todas as tage e inserilas novamente
        AlunoTag::where('id_aluno', $aluno->id)->delete();

        $tags = $request->get('tags');
        $dados_tag = [
            'id_aluno' => $aluno->id,
        ];
        foreach ($tags as $tag){
            $dados_tag['id_tag'] = $tag;
            AlunoTag::create($dados_tag);
        }

        if($request->hasFile('imagem') && $request->file('imagem')->isValid()){
            $imagem = $request->imagem;
            $extensao = $imagem->extension();

            $nmImagem = $aluno->id.".".$extensao;

            $request->imagem->move(public_path('img/alunos'), $nmImagem);

            $aluno['imagem'] = $nmImagem;

            $aluno->save();
        }
        return redirect()->route('alunos')->with('mensagem', 'Aluno Editado');

    }

    public function excluir($id){
        $aluno = Aluno::where('id', $id)->first();

        return view('alunos/excluir', compact('aluno'));
    }

    public function delete(Request $request){
        DB::beginTransaction();

        try {
            $id = $request->get('id');
            $aluno = Aluno::where('id', $id)->first();

            AlunoTag::where('id_aluno', $id)->delete();


            DB::commit();
            return redirect()->route('alunos')->with('mensagem','Aluno Excluído');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('alunos')->with('mensagem',$e->getMessage());
        }
    }

    public function alterarSenha($id){
      $aluno = Aluno::where('id', $id)->first();

      return view('alunos/alterarSenha', compact('aluno'));
    }

    public function alterarSenhaUpdate(Request $request){
        $aluno = Aluno::where('id', $request->get('id'))->first();

        $aluno->dsSenha = md5($request->get('dsSenha'));

        $aluno->save();

        return redirect()->route('alunos')->with('mensagem','Senha Alterada');
    }

    public function planTrade($id){
        $aluno = Aluno::where('id', $id)->first();
        $ativos = Ativo::where('stAtivo', 'Ativo')->orderBy('nome')->get();

        return view('alunos/planTrade', compact('aluno','ativos'));
    }

    public function planTradeSet(Request $request){
        $dados = $request->except('id','_token');
        $id = $request->get('id');

        $dados['plan1MetaGanhoDiario'] = str_replace(',','.',$dados['plan1MetaGanhoDiario']);
        $dados['plan2MetaGanhoDiario'] = str_replace(',','.',$dados['plan2MetaGanhoDiario']);
        $dados['plan3MetaGanhoDiario'] = str_replace(',','.',$dados['plan3MetaGanhoDiario']);
        $dados['plan4MetaGanhoDiario'] = str_replace(',','.',$dados['plan4MetaGanhoDiario']);
        $dados['plan5MetaGanhoDiario'] = str_replace(',','.',$dados['plan5MetaGanhoDiario']);

        $dados['plan1PontosContratoAtivo'] = str_replace(',','.',$dados['plan1PontosContratoAtivo']);
        $dados['plan2PontosContratoAtivo'] = str_replace(',','.',$dados['plan2PontosContratoAtivo']);
        $dados['plan3PontosContratoAtivo'] = str_replace(',','.',$dados['plan3PontosContratoAtivo']);
        $dados['plan4PontosContratoAtivo'] = str_replace(',','.',$dados['plan4PontosContratoAtivo']);
        $dados['plan5PontosContratoAtivo'] = str_replace(',','.',$dados['plan5PontosContratoAtivo']);

        Aluno::where('id', $id)->update($dados);
        return redirect()->route('alunos.planTrade', $id)->with('mensagem','Planos Salvos');
    }


}
