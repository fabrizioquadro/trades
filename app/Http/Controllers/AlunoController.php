<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aluno;
use App\Models\Tag;
use App\Models\AlunoTag;

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
        $dados['dsSenha'] = md5($request->get('dsSenha'));

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
        $id = $request->get('id');
        Aluno::where('id', $id)->delete();
        AlunoTag::where('id_aluno', $id)->delete();

        return redirect()->route('alunos')->with('mensagem','Aluno Excluído');
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


}
