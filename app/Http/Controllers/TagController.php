<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    public function index(){
        $tags = Tag::all()->sortBy('nmTag');

        return view('tags/index', compact('tags'));
    }

    public function adicionar(){
        return view('tags/adicionar');
    }

    public function insert(Request $request){
        $dados['nmTag'] = $request->get('nmTag');

        Tag::create($dados);

        return redirect()->route('tags')->with('mensagem','Tag Salva com Sucesso');
    }

    public function editar($id){
        $tag = Tag::where('id', $id)->first();

        return view('tags/editar', compact('tag'));
    }

    public function update(Request $request){
        $dados['nmTag'] = $request->get('nmTag');
        $id = $request->get('id_tag');

        Tag::where('id', $id)->update($dados);

        return redirect()->route('tags')->with('mensagem','Tag Editada com Sucesso');
    }

    public function excluir($id){
        $tag = Tag::where('id', $id)->first();

        return view('tags/excluir', compact('tag'));
    }

    public function delete(Request $request){
        $id = $request->get('id_tag');

        Tag::where('id', $id)->delete();

        return redirect()->route('tags')->with('mensagem','Tag Excluida com Sucesso');
    }
}
