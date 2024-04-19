<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ativo;
use App\Models\Corretora;
use App\Models\AtivoCorretora;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class AtivoController extends Controller
{
    public function index(){
        $ativos = Ativo::all()->sortBy('nome');

        return view('ativos/index', compact('ativos'));
    }

    public function adicionar(){
        $corretoras = Corretora::all()->sortBy('nome');

        return view('ativos/adicionar', compact('corretoras'));
    }

    public function insert(Request $request){
        $dados = $request->only('nome','simbolo','cqgSimbolo','pais','tipoAtivo','exchange','tamanhoContrato','meses','moedaAtivo','stAtivo','tipoCusto');
        $dados['valor'] = valorFormDb($request->get('valor'));
        $dados['tick'] = valorFormDb($request->get('tick'));
        $dados['swing'] = valorFormDb($request->get('swing'));
        $dados['dayTrading'] = valorFormDb($request->get('dayTrading'));

        $ativo = Ativo::create($dados);

        $corretoras = Corretora::all();

        foreach ($corretoras as $corretora){
            $var = "corretora_".$corretora->id;
            if($request->get($var) == "Sim"){
                $dados = [
                    'id_ativo' => $ativo->id,
                    'id_corretora' => $corretora->id,
                ];
                AtivoCorretora::create($dados);
            }
        }

        return redirect()->route('ativos')->with('mensagem', 'Ativo Cadastrado');
    }

    public function editar($id){
        $ativo = Ativo::where('id', $id)->first();

        $corretoras = Corretora::all()->sortBy('nome');

        return view('ativos/editar', compact('ativo','corretoras'));
    }

    public function update(Request $request){
        $id = $request->get('id_ativo');
        $dados = $request->only('nome','simbolo','cqgSimbolo','pais','tipoAtivo','exchange','tamanhoContrato','meses','moedaAtivo','stAtivo','tipoCusto');
        $dados['valor'] = valorFormDb($request->get('valor'));
        $dados['tick'] = valorFormDb($request->get('tick'));
        $dados['swing'] = valorFormDb($request->get('swing'));
        $dados['dayTrading'] = valorFormDb($request->get('dayTrading'));

        Ativo::where('id', $id)->update($dados);

        AtivoCorretora::where('id_ativo', $id)->delete();

        $corretoras = Corretora::all();

        foreach ($corretoras as $corretora){
            $var = "corretora_".$corretora->id;
            if($request->get($var) == "Sim"){
                $dados = [
                    'id_ativo' => $id,
                    'id_corretora' => $corretora->id,
                ];
                AtivoCorretora::create($dados);
            }
        }

        return redirect()->route('ativos')->with('mensagem', 'Ativo Editado');
    }

    public function excluir($id){
        $ativo = Ativo::where('id', $id)->first();

        return view('ativos/excluir', compact('ativo'));
    }

    public function delete(Request $request){
        $id = $request->get('id');

        AtivoCorretora::where('id_ativo', $id)->delete();
        Ativo::where('id', $id)->delete();

        return redirect()->route('ativos')->with('mensagem', 'Ativo Excluido');
    }

    public function visualizar($id){
        $ativo = Ativo::where('id', $id)->first();

        $corretoras = Corretora::all()->sortBy('nome');

        return view('ativos/visualizar', compact('ativo','corretoras'));
    }

    public function importar(){
        return view('ativos/importar');
    }

    public function importarInsert(Request $request){
        if($request->hasFile('arquivo') && $request->file('arquivo')->isValid()){
            $arquivo = $request->arquivo;
            $extensao = $arquivo->extension();

            $nmArquivo = date('Ymd_His').".".$extensao;
            $request->arquivo->move(public_path('imports'), $nmArquivo);

            $spreadsheet = IOFactory::load(public_path("imports/$nmArquivo"));
            $planilha = $spreadsheet->getActiveSheet()->toArray();

            for($i=7 ; $i<count($planilha) ; $i++){
                $linha = $planilha[$i];
                if($linha[0] != ""){
                    $dados = [
                        'nome' => $linha[0],
                        'simbolo' => $linha[1],
                        'cpgSimbolo' => $linha[2],
                        'pais' => $linha[3],
                        'tipoAtivo' => $linha[4],
                        'exchange' => $linha[5],
                        'tamanhoContrato' => $linha[6],
                        'meses' => $linha[7],
                        'valor' => valorDbForm($linha[8]),
                        'tick' => valorDbForm($linha[9]),
                        'swing' => valorDbForm($linha[10]),
                        'dayTrading' => valorDbForm($linha[11]),
                        'moedaAtivo' => $linha[12],
                        'tipoCusto' => $linha[13],
                        'stAtivo' => $linha[14],
                    ];

                    $ativo = Ativo::create($dados);
                    //vamos inserir as corretoras do ativos
                    $corretoras = explode(',',$linha[15]);

                    foreach ($corretoras as $nmCorretora){
                        $dados_pesquisa = [
                            "nome" => $nmCorretora,
                        ];
                        $corretora = Corretora::where($dados_pesquisa)->first();
                        $dados = [
                            'id_ativo' => $ativo->id,
                            'id_corretora' => $corretora->id,
                        ];
                        AtivoCorretora::create($dados);
                    }
                }
            }

            return redirect()->route('ativos')->with('mensagem', 'Importação completa!!!');
        }
    }

}
