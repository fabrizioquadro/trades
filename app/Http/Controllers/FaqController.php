<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faq;

class FaqController extends Controller
{
    public function index(){
        $faqs = Faq::all()->sortBy('numero');

        return view('faq/index', compact('faqs'));
    }

    public function adicionar(){
        return view('faq/adicionar');
    }

    public function insert(Request $request){
        $dados = $request->all();
        //vamos buscar o proximo numero da pergunta
        $dados['numero'] = Faq::count();

        Faq::create($dados);
        return redirect()->route('faq')->with('mensagem', 'Faq Salva!!');
    }

    public function visualizar($id){
        $faq = Faq::where('id', $id)->first();

        return view('faq/visualizar', compact('faq'));
    }

    public function editar($id){
        $faq = Faq::where('id', $id)->first();

        return view('faq/editar', compact('faq'));
    }

    public function update(Request $request){
        $id = $request->get('id_faq');
        $dados = $request->only('pergunta','resposta');

        Faq::where('id', $id)->update($dados);
        return redirect()->route('faq')->with('mensagem', 'Faq Salva!!');
    }

    public function excluir($id){
        $faq = Faq::where('id', $id)->first();

        return view('faq/excluir', compact('faq'));
    }

    public function delete(Request $request){
        $id = $request->get('id_faq');

        Faq::where('id', $id)->delete();
        return redirect()->route('faq')->with('mensagem', 'Faq Excluída!!');
    }

    public function ordenaSequencia(Request $request){
        $retorno['retorno'] = 'true';
        $id_faq = $request->get('id_faq');
        $nrOrigem = $request->get('nrOrigem');
        $nrDestino = $request->get('nrDestino');

        if($nrOrigem < $nrDestino){
            //vamos buscar todas as faqs que são maiores que a origem e menores igual que o destino
            $faqs = Faq::where('numero','>',$nrOrigem)
            ->where('numero','<=',$nrDestino)
            ->orderBy('numero')
            ->get();

            foreach($faqs as $faq){
                Faq::where('id', $faq->id)->update(['numero' => $nrOrigem]);
                $nrOrigem++;
            }

            Faq::where('id',$id_faq)->update(['numero' => $nrDestino]);
        }
        elseif($nrOrigem > $nrDestino){
            //vamos buscar todas as faqs que são maiores que a origem e menores igual que o destino
            $faqs = Faq::where('numero','>=',$nrDestino)
            ->where('numero','<',$nrOrigem)
            ->orderBy('numero')
            ->get();

            Faq::where('id',$id_faq)->update(['numero' => $nrDestino]);
            $nrDestino++;

            foreach($faqs as $faq){
                Faq::where('id', $faq->id)->update(['numero' => $nrDestino]);
                $nrDestino++;
            }
        }

        $retorno['controle'] = 'true';

        echo json_encode($retorno);
    }
}
