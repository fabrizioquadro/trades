<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PlanTrade;
use App\Models\PlanTradeDia;
use App\Models\Ativo;
use App\Models\Aluno;

class PlanTradeAlunoController extends Controller
{
    public function index(){
        $aluno = session()->get('aluno');
        $aluno = Aluno::where('id', $aluno->id)->first();
        session()->put('aluno', $aluno);
        $plans = PlanTrade::where('aluno_id', $aluno->id)->get();

        return view('acessoAluno/planTrades/index', compact('plans'));
    }

    public function adicionar(){
        $aluno = session()->get('aluno');
        $aluno = Aluno::where('id', $aluno->id)->first();
        session()->put('aluno', $aluno);
        $ativos = Ativo::where('stAtivo', 'Ativo')->orderBy('nome')->get();
        $ativo1 = Ativo::where('id', $aluno->plan1AtivoBase)->first();
        $ativo2 = Ativo::where('id', $aluno->plan2AtivoBase)->first();
        $ativo3 = Ativo::where('id', $aluno->plan3AtivoBase)->first();
        $ativo4 = Ativo::where('id', $aluno->plan4AtivoBase)->first();
        $ativo5 = Ativo::where('id', $aluno->plan5AtivoBase)->first();

        return view('acessoAluno/planTrades/adicionar', compact('ativos','aluno','ativo1',
        'ativo2','ativo3','ativo4','ativo5'));
    }

    public function insert(Request $request){
        $aluno = session()->get('aluno');
        $aluno = Aluno::where('id', $aluno->id)->first();
        session()->put('aluno', $aluno);
        $nr = $request->get('nrPlan');

        $var = "plan".$nr."AtivoBase";
        $planAtivoBase = $aluno->$var;

        $var = "plan".$nr."MetaGanhoDiario";
        $planMetaGanhoDiario = $aluno->$var;

        $var = "plan".$nr."PontosContratoAtivo";
        $planPontosContratoAtivo = $aluno->$var;

        $var = "plan".$nr."MetaMaximaPontos";
        $planMetaMaximaPontos = $aluno->$var;

        $var = "plan".$nr."FatorCorrecaoGarantia";
        $planFatorCorrecaoGarantia = $aluno->$var;

        $var = "plan".$nr."LimiteGanhoDia";
        $planLimiteGanhoDia = $aluno->$var;

        $var = "plan".$nr."MaximoContratos";
        $planMaximoContratos = $aluno->$var;

        $ativo = Ativo::where('id', $planAtivoBase)->first();

        $dados = $request->all();
        $dados['id_ativo'] = $ativo->id;
        $dados['moeda'] = $ativo->moedaAtivo;
        $dados['garantiaContratoAtivo'] = round($ativo->dayTrading * $planFatorCorrecaoGarantia / 100, 2);
        $dados['aluno_id'] = $aluno->id;
        $dados['vlInc'] = valorFormDb($dados['vlInc']);

        if($ativo->valor == null OR $ativo->valor == 0){
            $dados['pontosContratoAtivo'] = $planPontosContratoAtivo;
        }
        else{
            $dados['pontosContratoAtivo'] = $ativo->valor;
        }

        if($dados['pontosContratoAtivo'] == 0){
            $dados['pontosContratoAtivo'] = 1;
        }

        $controleAtivoUSA= false;

        if($ativo->tamanhoContrato != null && $ativo->tamanhoContrato != 'Variável' && $ativo->valor != null && $ativo->valor != 0){
            $controleAtivoUSA = true;

            //ativo estados unidos conferir se possui mais de 1 tamanho do contrato
            if($dados['vlInc'] < $dados['garantiaContratoAtivo']){
                //se entrar aqui não permite que siga adiante
                return redirect()->route('aluno.planTrade')->with('mensagemAlerta','Você não possui margem de garantia suficiente para executar esse Trade Plan. Margem de garantia mínima exigida:'.buscaPrefixoMoeda($ativo->moedaAtivo)." ".valorDbForm($dados['garantiaContratoAtivo']));
            }
        }


        $planTrade = PlanTrade::create($dados);

        $semana = array('Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado');

        $valor = $planTrade->vlInc;
        $data = $planTrade->dtInc;

        $planGarantiaContrato = $planTrade->garantiaContratoAtivo;
        $planPontosContratoAtivo = $planTrade->pontosContratoAtivo;

        for($i=0 ; $i<730 ; $i++){
            $diasemana_numero = date('w', strtotime($data));
            if($diasemana_numero > 0 && $diasemana_numero < 6){
                $dados_dia = array();
                $dados_dia['planTrade_id'] = $planTrade->id;
                $dados_dia['dia'] = $data;
                $dados_dia['diaSemana'] = $semana[$diasemana_numero];
                $dados_dia['metaDiaAnterior'] = $valor;

                $meta = round($valor * $planMetaGanhoDiario / 100, 2);

                if($meta > $planLimiteGanhoDia){
                    $meta = $planLimiteGanhoDia;
                }
                $dados_dia['meta'] = $meta;
                $dados_dia['realizar'] = round($meta + $valor, 2);
                $dados_dia['riskMagagmentPlanejado'] = round($meta / $valor * 100, 2);
                if($controleAtivoUSA){
                    $contratosPlanejado = intval($valor / $planGarantiaContrato);
                }
                else{
                    $contratosPlanejado = round($valor / $planGarantiaContrato, 2);
                }

                if($contratosPlanejado > $planMaximoContratos){
                    $contratosPlanejado = $planMaximoContratos;
                }

                $dados_dia['contratosPlanejado'] = $contratosPlanejado;

                $dados_dia['pontosContratoPlanejado'] = round($meta / ($planPontosContratoAtivo * $dados_dia['contratosPlanejado']), 2);

                $valor += $meta;

                PlanTradeDia::create($dados_dia);
            }
            $data = date('Y-m-d', strtotime("+1 days",strtotime($data)));
        }

        return redirect()->route('aluno.planTrade')->with('mensagem', 'PlanTrade gerada!');
    }

    public function acessar($id){
        $aluno = session()->get('aluno');
        $aluno = Aluno::where('id', $aluno->id)->first();
        session()->put('aluno', $aluno);
        $planTrade = PlanTrade::where('id', $id)->first();
        $dias = PlanTradeDia::where('planTrade_id', $planTrade->id)->orderBy('id')->get();

        //vamos pegar os dados do ativo
        $ativo = Ativo::where('id', $planTrade->id_ativo)->first();

        //vamos buscar o ultimo dia de preenchimento do plan
        $dia = PlanTradeDia::where('planTrade_id', $planTrade->id)->whereNotNull('valorRealizado')->orderByDesc('dia')->first();
        $ultimoDiaInsert = $dia ? $dia->dia : null;

        return view('acessoAluno/planTrades/acessar', compact('aluno','planTrade','dias','ativo','ultimoDiaInsert'));
    }

    public function lancar(Request $request){
        $aluno = session()->get('aluno');
        $aluno = Aluno::where('id', $aluno->id)->first();
        session()->put('aluno', $aluno);
        $id_planTradeDia = $request->get('id_planTradeDia');
        $dados = $request->except('id_planTradeDia','_token');
        //$dados['valorRealizado'] = valorFormDb($dados['valorRealizado']);
        $dados['valorRealizado'] = str_replace(',','.', $dados['valorRealizado']);
        $dados['custoRealizado'] = valorFormDb($dados['custoRealizado']);

        PlanTradeDia::where('id', $id_planTradeDia)->update($dados);
        $planTradeDia = PlanTradeDia::where('id', $id_planTradeDia)->first();

        return redirect()->route('aluno.planTrade.acessar', $planTradeDia->planTrade_id);
    }

    public function buscarLancado(){
        $dia = PlanTradeDia::where('id', $_GET['id'])->first();
        if($dia->valorRealizado){
            $retorno['controle'] = 'lancado';
            $retorno['valorRealizado'] = valorDbForm($dia->valorRealizado);
            $retorno['custoRealizado'] = valorDbForm($dia->custoRealizado);
            $retorno['nrTrades'] = $dia->nrTrades;
            $retorno['nrGains'] = $dia->nrGains;
            $retorno['nrLoss'] = $dia->nrLoss;
        }
        else{
            $retorno['controle'] = 'false';
        }

        echo json_encode($retorno);
    }

    public function recalcular(Request $request){
        $aluno = session()->get('aluno');
        $aluno = Aluno::where('id', $aluno->id)->first();
        session()->put('aluno', $aluno);
        $plan = PlanTrade::where('id', $request->get('planTrade_id'))->first();

        $plan->vlInc = valorFormDb($request->get('vlInc'));
        $plan->dtInc = $request->get('dtInc');

        $nr = $plan->nrPlan;

        $var = "plan".$nr."AtivoBase";
        $planAtivoBase = $aluno->$var;

        $var = "plan".$nr."MetaGanhoDiario";
        $planMetaGanhoDiario = $aluno->$var;

        $var = "plan".$nr."PontosContratoAtivo";
        $planPontosContratoAtivo = $aluno->$var;

        $var = "plan".$nr."MetaMaximaPontos";
        $planMetaMaximaPontos = $aluno->$var;

        $var = "plan".$nr."FatorCorrecaoGarantia";
        $planFatorCorrecaoGarantia = $aluno->$var;

        $var = "plan".$nr."LimiteGanhoDia";
        $planLimiteGanhoDia = $aluno->$var;

        $var = "plan".$nr."MaximoContratos";
        $planMaximoContratos = $aluno->$var;

        $ativo = Ativo::where('id', $planAtivoBase)->first();

        $plan->id_ativo = $ativo->id;
        $plan->moeda = $ativo->moedaAtivo;
        $plan->garantiaContratoAtivo = round($ativo->dayTrading * $planFatorCorrecaoGarantia / 100, 2);

        if($ativo->valor == null OR $ativo->valor == 0){
            $plan->pontosContratoAtivo = $planPontosContratoAtivo;
        }
        else{
            $plan->pontosContratoAtivo = $ativo->valor;
        }

        if($plan->pontosContratoAtivo == 0){
            $plan->pontosContratoAtivo = 1;
        }

        $controleAtivoUSA= false;

        if($ativo->tamanhoContrato != null && $ativo->tamanhoContrato != 'Variável' && $ativo->valor != null && $ativo->valor != 0){
            $controleAtivoUSA= true;
            //ativo estados unidos conferir se possui mais de 1 tamanho do contrato
            if($plan->vlInc < $plan->garantiaContratoAtivo){
                //se entrar aqui não permite que siga adiante
                return redirect()->route('aluno.planTrade')->with('mensagemAlerta','Você não possui margem de garantia suficiente para executar esse Trade Plan. Margem de garantia mínima exigida:'.buscaPrefixoMoeda($ativo->moedaAtivo)." ".valorDbForm($plan->garantiaContratoAtivo));
            }
        }

        $plan->save();

        $valor = $plan->vlInc;
        $data = $plan->dtInc;

        $planGarantiaContrato = $plan->garantiaContratoAtivo;
        $planPontosContratoAtivo = $plan->pontosContratoAtivo;

        $semana = array('Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado');

        $dias = PlanTradeDia::where('planTrade_id', $plan->id)->orderBy('id')->get();

        foreach($dias as $dia){
            $controle = true;
            while($controle){
                $diasemana_numero = date('w', strtotime($data));
                if($diasemana_numero == 0 || $diasemana_numero == 6){
                    $data = date('Y-m-d', strtotime("+1 days",strtotime($data)));
                }
                else{
                    $controle = false;
                }
            }

            $dia->metaDiaAnterior = $valor;
            $dia->dia = $data;
            $dia->diaSemana = $semana[$diasemana_numero];

            $meta = round($valor * $planMetaGanhoDiario / 100, 2);

            if($meta > $planLimiteGanhoDia){
                $meta = $planLimiteGanhoDia;
            }
            $dia->meta = $meta;
            $dia->realizar = round($meta + $valor, 2);
            $dia->riskMagagmentPlanejado = round($meta / $valor * 100, 2);
            if($controleAtivoUSA){
                $contratosPlanejado = intval($valor / $planGarantiaContrato);
            }
            else{
                $contratosPlanejado = round($valor / $planGarantiaContrato, 2);
            }

            if($contratosPlanejado > $planMaximoContratos){
                $contratosPlanejado = $planMaximoContratos;
            }
            $dia->contratosPlanejado = $contratosPlanejado;
            $dia->pontosContratoPlanejado = round($meta / ($planPontosContratoAtivo * $dia->contratosPlanejado), 2);

            $valor += $meta;

            $dia->save();
            $data = date('Y-m-d', strtotime("+1 days",strtotime($data)));
        }

        return redirect()->route('aluno.planTrade.acessar', $plan->id);
    }

    public function excluir($id){
        $plan = PlanTrade::where('id', $id)->first();

        return view('acessoAluno/planTrades/excluir', compact('plan'));
    }

    public function delete(Request $request){
        PlanTradeDia::where('planTrade_id', $request->get('planTrade_id'))->delete();

        PlanTrade::where('id', $request->get('planTrade_id'))->delete();

        return redirect()->route('aluno.planTrade')->with('mensagem','Trade Plan excluída!');
    }

}
