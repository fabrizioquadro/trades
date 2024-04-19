<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tutorial;

class TutorialAlunoController extends Controller
{
    public function index(Request $request){
        $tag = '';
        if($request->has('controle')){
            //aqui entra se tiver que fazer algum tipo de pesquisa
            if($request->get('controle') == 'tag'){
                //aqui entra a pesquisa por tag
                if($request->has('controle') && $request->get('tag') != "All"){
                    //aqui se tiver alguma tag especifica
                    $tutoriais = Tutorial::where('tag', $request->get('tag'))->orderBy('nmTutorial')->get();
                    $tag = $request->get('tag');
                }
                else{
                    //aqui todos as tags
                    $tutoriais = Tutorial::orderBy('nmTutorial')->get();
                }
            }
            elseif($request->get('controle') == "pesquisar"){
                //vamos fazer a pesquisa por palavra
                $tutoriais = Tutorial::where('nmTutorial','LIKE',"%".$request->get('pesquisar')."%")
                ->orWhere('dsTutorial','LIKE',"%".$request->get('pesquisar')."%")
                ->get();
            }
            else{
                $tutoriais = Tutorial::orderBy('nmTutorial')->get();
            }
        }
        else{
            $tutoriais = Tutorial::orderBy('nmTutorial')->get();
        }















        $tags = Tutorial::buscaTags();

        return view('acessoAluno/tutoriais/index', compact('tutoriais','tags','tag'));
    }
}
