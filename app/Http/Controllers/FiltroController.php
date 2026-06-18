<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Models\Tag;
Use App\Models\Aluno;
Use App\Models\Corretora;
Use App\Models\Ativo;

class FiltroController extends Controller
{
    public function index(){
        $redirect = 'filtro';
        $filtro = $this->gerarFiltro($redirect);

        return view('filtro/index', compact('filtro'));
    }

    public function filtroTagAluno(Request $request){
        $user = auth()->user();
        $dados = $request->all();

        if(isset($dados['tags'])){
            $tags = "";
            foreach($dados['tags'] as $tag){
                $tags .= ",".$tag;
            }
            $tags = substr($tags, 1);
            $user->filtroTag = $tags;
            $user->filtroAluno = null;
        }

        if(isset($dados['alunos'])){
            $alunos = "";
            foreach($dados['alunos'] as $aluno){
                $alunos .= ",".$aluno;
            }
            $alunos = substr($alunos, 1);
            $user->filtroAluno = $alunos;
        }

        $user->filtroDtEntradaInc = $request->get('filtro_dtEntradaInc');
        $user->filtroDtEntradaFn = $request->get('filtro_dtEntradaFn');
        $user->filtroDtSaidaInc = $request->get('filtro_dtSaidaInc');
        $user->filtroDtSaidaFn = $request->get('filtro_dtSaidaFn');
        $user->filtroTipoOperacao = substr($request->get('filtroTipoOperacao'), 1);
        $user->filtroPais = substr($request->get('filtroPais'), 1);
        $user->filtroCorretora = substr($request->get('filtroCorretora'), 1);
        $user->filtroTipoConta = substr($request->get('filtroTipoConta'), 1);
        $user->filtroAtivo = substr($request->get('filtroAtivo'), 1);
        $user->filtroTipoAtivo = substr($request->get('filtroTipoAtivo'), 1);
        $user->filtroOperacao = substr($request->get('filtroOperacao'), 1);
        $user->filtroDirecao = substr($request->get('filtroDirecao'), 1);
        $user->filtroFase = substr($request->get('filtroFase'), 1);
        $user->filtroMoeda = substr($request->get('filtroMoeda'), 1);
        $user->filtroTipoCusto = substr($request->get('filtroTipoCusto'), 1);
        $user->filtroResultado = substr($request->get('filtroResultado'), 1);
        $user->filtroTrades = null;

        $user->save();

        return redirect()->route($request->get('redirect'));
    }

    public function limpar($redirect){
        $user = auth()->user();
        $user->filtroTag = null;
        $user->filtroAluno = null;
        $user->filtroDtEntradaInc = null;
        $user->filtroDtEntradaFn = null;
        $user->filtroDtSaidaInc = null;
        $user->filtroDtSaidaFn = null;
        $user->filtroTipoOperacao = null;
        $user->filtroPais = null;
        $user->filtroCorretora = null;
        $user->filtroTipoConta = null;
        $user->filtroAtivo = null;
        $user->filtroTipoAtivo = null;
        $user->filtroOperacao = null;
        $user->filtroDirecao = null;
        $user->filtroFase = null;
        $user->filtroMoeda = null;
        $user->filtroTipoCusto = null;
        $user->filtroResultado = null;
        $user->filtroTrades = null;

        $user->save();

        return redirect()->route($redirect);
    }

    public function gerarFiltro($redirect){
        $user = auth()->user();
        $tagsUser = explode(',',$user->filtroTag);
        $alunosUser = explode(',',$user->filtroAluno);

        $tags = Tag::all()->sortBy('nmTag');
        $alunos = Aluno::listarAlunosTags($user->filtroTag);

        //vamos buscar os filtros das trades
        $filtroTipoOperacao = $user->filtroTipoOperacao == NULL ? NULL : explode(',', $user->filtroTipoOperacao);
        $filtroPais = $user->filtroPais == NULL ? NULL : explode(',', $user->filtroPais);
        $filtroCorretora = $user->filtroCorretora == NULL ? NULL : explode(',', $user->filtroCorretora);
        $filtroTipoConta = $user->filtroTipoConta == NULL ? NULL : explode(',', $user->filtroTipoConta);
        $filtroConta = $user->filtroConta == NULL ? NULL : explode(',', $user->filtroConta);
        $filtroAtivo = $user->filtroAtivo == NULL ? NULL : explode(',', $user->filtroAtivo);
        $filtroTipoAtivo = $user->filtroTipoAtivo == NULL ? NULL : explode(',', $user->filtroTipoAtivo);
        $filtroOperacao = $user->filtroOperacao == NULL ? NULL : explode(',', $user->filtroOperacao);
        $filtroDirecao = $user->filtroDirecao == NULL ? NULL : explode(',', $user->filtroDirecao);
        $filtroFase = $user->filtroFase == NULL ? NULL : explode(',', $user->filtroFase);
        $filtroMoeda = $user->filtroMoeda == NULL ? NULL : explode(',', $user->filtroMoeda);
        $filtroTipoCusto = $user->filtroTipoCusto == NULL ? NULL : explode(',', $user->filtroTipoCusto);
        $filtroResultado = $user->filtroResultado == NULL ? NULL : explode(',', $user->filtroResultado);

        $varCorretoras = explode(',',$user->filtroCorretora);
        $stringCorretoras = "";
        foreach ($varCorretoras as $linha) {
            $var = Corretora::where('id', $linha)->first();
            if($var){
                $stringCorretoras .= ", ".$var->nome;
            }
        }
        $stringCorretoras = substr($stringCorretoras, 2);

        //vamos buscar os nomes dos ativos do filtros
        $varAtivos = explode(',',$user->filtroAtivo);
        $stringAtivos = "";
        foreach ($varAtivos as $linha) {
            $var = Ativo::where('id', $linha)->first();
            if($var){
                $stringAtivos .= ", ".$var->nome;
            }
        }
        $stringAtivos = substr($stringAtivos, 2);

        $arrayTipoOperacao = ['Day Trade','Hedge','Position','Scalp','Swing Trade'];
        $arrayPais = ['BRA','EUA','EUR','UK','INT','Cryptos'];
        $arrayTipoContas = ['Demo','Real'];
        $arrayTipoAtivos = ['Índices','Índice CFD','CFDs','Ações','Forex','Cryptos','Financeiros','ADRs','BDRs','ETFs','Fundos','Energéticos','Metais','Grãos','Carne','Softs'];
        $arrayOperacao = ['Compra','Venda','Hedge Comprado','Hedge Vendido'];
        $arrayDirecao = ['Tendência','Contra-tendência','Divergência'];
        $arrayFase = ['Não Informada','Fase 01','Fase 02','Fase 03','Fase 04','Fase 05'];
        $arrayMoeda = ['BRL','USD','EUR','GBP'];
        $arrayTipoCusto = ['Spread','Valor Fixo','Percentual'];
        $arrayResultado = ['Gain','Loss','0 x 0'];
        $corretoras = Corretora::all();
        $ativos = Ativo::all()->sortBy('nome');

        $html = "
        <div class='d-flex justify-content-between'>
            <h6 class='card-title'>Filtros</h6>
            <a href='".route('filtroLimpar', $redirect)."' class='btn btn-sm btn-warning'>Limpar Filtros</a>
        </div>
        <form id='formularioPesquisa' action='".route('filtroTagAluno')."' method='post'>
            <input type='hidden' name='_token' value='".csrf_token()."'>
            <input type='hidden' name='redirect' value='".$redirect."'>
            <input type='hidden' id='form_dtEntradaInc' name='dtEntradaInc'>
            <input type='hidden' id='form_dtEntradaFn' name='dtEntradaFn'>
            <input type='hidden' id='form_dtSaidaInc' name='dtSaidaInc'>
            <input type='hidden' id='form_dtSaidaFn' name='dtSaidaFn'>
            <input type='hidden' id='form_fitroStatus' name='filtroStatus'>
            <input type='hidden' id='form_fitroTipoOperacao' name='filtroTipoOperacao'>
            <input type='hidden' id='form_fitroPais' name='filtroPais'>
            <input type='hidden' id='form_fitroCorretora' name='filtroCorretora'>
            <input type='hidden' id='form_filtroTipoConta' name='filtroTipoConta'>
            <input type='hidden' id='form_filtroConta' name='filtroConta'>
            <input type='hidden' id='form_filtroAtivo' name='filtroAtivo'>
            <input type='hidden' id='form_filtroTipoAtivo' name='filtroTipoAtivo'>
            <input type='hidden' id='form_filtroOperacao' name='filtroOperacao'>
            <input type='hidden' id='form_filtroDirecao' name='filtroDirecao'>
            <input type='hidden' id='form_filtroFase' name='filtroFase'>
            <input type='hidden' id='form_filtroMoeda' name='filtroMoeda'>
            <input type='hidden' id='form_filtroTipoCusto' name='filtroTipoCusto'>
            <input type='hidden' id='form_filtroResultado' name='filtroResultado'>

            <style>
            #espaco{
                width: 14px !important;
            }
            </style>

            <div class='row'>
                <div class='col-md-6 form-group'>
                    <label class='mb-3'>Tags:</label>
                    <select name='tags[]' onchange='submit()' class='form-control' multiple>";
                    foreach($tags as $tag){
                        $selected = "";
                        if($user->filtroTag){
                            foreach($tagsUser as $tagUser){
                                if($tagUser == $tag->id){
                                    $selected = 'selected';
                                }
                            }
                        }
                        $html .= "<option $selected value='$tag->id'>$tag->nmTag</option>";
                    }
                    $html .= "
                    </select>
                </div>
                <div class='col-md-6 form-group'>
                    <label class='mb-3'>Alunos:</label>
                    <select name='alunos[]' onchange='submit()' class='form-control' multiple>";
                    foreach($alunos as $aluno){
                        $selected = "";
                        if($user->filtroAluno){
                            foreach($alunosUser as $alunoUser){
                                if($alunoUser == $aluno->id_aluno){
                                    $selected = 'selected';
                                }
                            }
                        }
                        $html .= "<option $selected value='$aluno->id_aluno'>$aluno->nmAluno</option>";
                    }
                    $html .= "
                    </select>
                </div>
            </div>

            <div class='row' id='div_filtro_pagina_2'>
                <div class='col-md-12 mt-3'>
                    <div class='d-flex justify-content-end'>
                    <div class='btn-group'>
                        <button type='button' class='btn btn-secondary dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'>
                            Acesso Rápido
                        </button>
                        <ul class='dropdown-menu'>
                            <li><a class='dropdown-item' href='".route('filtroTempo', ['semana',$redirect])."'>Última Semana</a></li>
                            <li><a class='dropdown-item' href='".route('filtroTempo', ['mes',$redirect])."'>Última Mês</a></li>
                            <li><a class='dropdown-item' href='".route('filtroTempo', ['3meses',$redirect])."'>Últimos 3 Meses</a></li>
                            <li><a class='dropdown-item' href='".route('filtroTempo', ['6meses',$redirect])."'>Últimos 6 Meses</a></li>
                        </ul>
                    </div>
                </div>
                </div>
                <div class='col-md-12' style='overflow-x: scroll;'>
                    <table class='table table-sm table-filtro'>
                        <tr>
                            <td>
                                <div class='d-flex justify-content-center align-items-center'>
                                    <div>
                                        Entrada
                                    </div>
                                    <div class='dropdown'>
                                        <button type='button' class='btn p-0 dropdown-toggle hide-arrow show' data-bs-toggle='dropdown' aria-expanded='true'>
                                            <i class='mdi mdi-menu-down'></i>
                                        </button>
                                        <div class='dropdown-menu' data-popper-placement='bottom-end'>
                                            <div class='card'>
                                                <div class='card-body'>
                                                    <h6 class='card-title'>Filtro</h6>
                                                    <div class='row mt-3'>
                                                        <div class='col-md-12'>
                                                            <div class='form-floating form-floating-outline'>
                                                                <input class='form-control' type='date' id='filtro_dtEntradaInc' name='filtro_dtEntradaInc' placeholder='Início' value='$user->dtEntradaInc'/>
                                                                <label for='filtro_dtEntradaInc'>Início:</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class='row mt-3'>
                                                        <div class='col-md-12'>
                                                            <div class='form-floating form-floating-outline'>
                                                                <input class='form-control' type='date' id='filtro_dtEntradaFn' name='filtro_dtEntradaFn' placeholder='Fim' value='$user->dtEntradaFn'/>
                                                                <label for='filtro_dtEntradaFn'>Fim:</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class='row mt-3'>
                                                        <div class='col-md-12' align='center'>
                                                            <button type='button' onclick='executarFiltro()' class='btn btn-primary btn-sm'>Filtrar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class='d-flex justify-content-center align-items-center'>
                                    <div>
                                        Saída
                                    </div>
                                    <div class='dropdown'>
                                        <button type='button' class='btn p-0 dropdown-toggle hide-arrow show' data-bs-toggle='dropdown' aria-expanded='true'>
                                            <i class='mdi mdi-menu-down'></i>
                                        </button>
                                        <div class='dropdown-menu' data-popper-placement='bottom-end'>
                                            <div class='card'>
                                                <div class='card-body'>
                                                    <h6 class='card-title'>Filtro</h6>
                                                    <div class='row mt-3'>
                                                        <div class='col-md-12'>
                                                            <div class='form-floating form-floating-outline'>
                                                                <input class='form-control' type='date' id='filtro_dtSaidaInc' name='filtro_dtSaidaInc' placeholder='Início' value='$user->dtSaidaInc'/>
                                                                <label for='filtro_dtSaidaInc'>Início:</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class='row mt-3'>
                                                        <div class='col-md-12'>
                                                            <div class='form-floating form-floating-outline'>
                                                                <input class='form-control' type='date' id='filtro_dtSaidaFn' name='filtro_dtSaidaFn' placeholder='Fim' value='$user->dtSaidaFn'/>
                                                                <label for='filtro_dtSaidaFn'>Fim:</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class='row mt-3'>
                                                        <div class='col-md-12' align='center'>
                                                            <button type='button' onclick='executarFiltro()' class='btn btn-primary btn-sm'>Filtrar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class='d-flex justify-content-center align-items-center'>
                                    <div>
                                        Tipo Operação
                                    </div>
                                    <div class='dropdown'>
                                        <button type='button' class='btn p-0 dropdown-toggle hide-arrow show' data-bs-toggle='dropdown' aria-expanded='true'>
                                            <i class='mdi mdi-menu-down'></i>
                                        </button>
                                        <div class='dropdown-menu' data-popper-placement='bottom-end'>
                                            <div class='card'>
                                                <div class='card-body'>
                                                    <h6 class='card-title'>Filtro</h6>";
                                                    foreach($arrayTipoOperacao as $linha){
                                                        $controle = "";

                                                        if($filtroTipoOperacao){
                                                            foreach($filtroTipoOperacao as $var){
                                                                if($var == $linha){
                                                                    $controle = "checked";
                                                                }
                                                            }
                                                        }

                                                        $html .= "
                                                        <div class='row mt-3'>
                                                            <div class='col-md-12'>
                                                                <input class='form-check-input filtroTOperacao' $controle type='checkbox' id='tp$linha' value='$linha'>
                                                                <label class='form-check-label' for='tp$linha'> $linha </label>
                                                            </div>
                                                        </div>
                                                        ";
                                                    }
                                                    $html .= "
                                                    <div class='row mt-3'>
                                                        <div class='col-md-12' align='center'>
                                                            <button type='button' onclick='executarFiltro()' class='btn btn-primary btn-sm'>Filtrar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class='d-flex justify-content-center align-items-center'>
                                    <div>
                                        País
                                    </div>
                                    <div class='dropdown'>
                                        <button type='button' class='btn p-0 dropdown-toggle hide-arrow show' data-bs-toggle='dropdown' aria-expanded='true'>
                                            <i class='mdi mdi-menu-down'></i>
                                        </button>
                                        <div class='dropdown-menu' data-popper-placement='bottom-end'>
                                            <div class='card'>
                                                <div class='card-body'>
                                                    <h6 class='card-title'>Filtro</h6>";
                                                    foreach($arrayPais as $linha){
                                                        $controle = "";

                                                        if($filtroPais){
                                                            foreach($filtroPais as $var){
                                                                if($var == $linha){
                                                                    $controle = "checked";
                                                                }
                                                            }
                                                        }

                                                        $html .= "
                                                        <div class='row mt-3'>
                                                            <div class='col-md-12'>
                                                                <input class='form-check-input filtroPais' $controle type='checkbox' id='pais$linha' value='$linha'>
                                                                <label class='form-check-label' for='pais$linha'> $linha </label>
                                                            </div>
                                                        </div>
                                                        ";
                                                    }
                                                    $html .= "
                                                    <div class='row mt-3'>
                                                        <div class='col-md-12' align='center'>
                                                            <button type='button' onclick='executarFiltro()' class='btn btn-primary btn-sm'>Filtrar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class='d-flex justify-content-center align-items-center'>
                                    <div>
                                        Corretora
                                    </div>
                                    <div class='dropdown'>
                                        <button type='button' class='btn p-0 dropdown-toggle hide-arrow show' data-bs-toggle='dropdown' aria-expanded='true'>
                                            <i class='mdi mdi-menu-down'></i>
                                        </button>
                                        <div class='dropdown-menu' data-popper-placement='bottom-end'>
                                            <div class='card'>
                                                <div class='card-body'>
                                                    <h6 class='card-title'>Filtro</h6>";
                                                    foreach($corretoras as $corretora){
                                                        $controle = "";

                                                        if($filtroCorretora){
                                                            foreach($filtroCorretora as $var){
                                                                if($var == $corretora->id){
                                                                    $controle = "checked";
                                                                }
                                                            }
                                                        }

                                                        $html .= "
                                                        <div class='row mt-3'>
                                                            <div class='col-md-12'>
                                                                <input class='form-check-input filtroCorretora' $controle type='checkbox' id='corretora$corretora->id' value='$corretora->id'>
                                                                <label class='form-check-label' for='corretora$corretora->id'> $corretora->nome </label>
                                                            </div>
                                                        </div>
                                                        ";
                                                    }
                                                    $html .= "
                                                    <div class='row mt-3'>
                                                        <div class='col-md-12' align='center'>
                                                            <button type='button' onclick='executarFiltro()' class='btn btn-primary btn-sm'>Filtrar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class='d-flex justify-content-center align-items-center'>
                                    <div>
                                        Tipo de Contas
                                    </div>
                                    <div class='dropdown'>
                                        <button type='button' class='btn p-0 dropdown-toggle hide-arrow show' data-bs-toggle='dropdown' aria-expanded='true'>
                                            <i class='mdi mdi-menu-down'></i>
                                        </button>
                                        <div class='dropdown-menu' data-popper-placement='bottom-end'>
                                            <div class='card'>
                                                <div class='card-body'>
                                                    <h6 class='card-title'>Filtro</h6>";
                                                    foreach($arrayTipoContas as $linha){
                                                        $controle = "";

                                                        if($filtroTipoConta){
                                                            foreach($filtroTipoConta as $var){
                                                                if($var == $linha){
                                                                    $controle = "checked";
                                                                }
                                                            }
                                                        }

                                                        $html .= "
                                                        <div class='row mt-3'>
                                                            <div class='col-md-12'>
                                                                <input class='form-check-input filtroTipoConta' $controle type='checkbox' id='tipoConta$linha' value='$linha'>
                                                                <label class='form-check-label' for='tipoConta$linha'> $linha </label>
                                                            </div>
                                                        </div>
                                                        ";
                                                    }
                                                    $html .= "
                                                    <div class='row mt-3'>
                                                        <div class='col-md-12' align='center'>
                                                            <button type='button' onclick='executarFiltro()' class='btn btn-primary btn-sm'>Filtrar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class='d-flex justify-content-center align-items-center'>
                                    <div>
                                        Ativos
                                    </div>
                                    <div class='dropdown'>
                                        <button type='button' class='btn p-0 dropdown-toggle hide-arrow show' data-bs-toggle='dropdown' aria-expanded='true'>
                                            <i class='mdi mdi-menu-down'></i>
                                        </button>
                                        <div class='dropdown-menu' data-popper-placement='bottom-end'>
                                            <div class='card'>
                                                <div class='card-body'>
                                                    <h6 class='card-title'>Filtro</h6>";
                                                    foreach($ativos as $ativo){
                                                        $controle = "";

                                                        if($filtroAtivo){
                                                            foreach($filtroAtivo as $var){
                                                                if($var == $ativo->id){
                                                                    $controle = "checked";
                                                                }
                                                            }
                                                        }

                                                        $html .= "
                                                        <div class='row mt-3'>
                                                            <div class='col-md-12'>
                                                                <input class='form-check-input filtroAtivo' $controle type='checkbox' id='ativo$ativo->id' value='$ativo->id'>
                                                                <label class='form-check-label' for='ativo$ativo->id'> $ativo->simbolo - $ativo->nome </label>
                                                            </div>
                                                        </div>
                                                        ";
                                                    }
                                                    $html .= "
                                                    <div class='row mt-3'>
                                                        <div class='col-md-12' align='center'>
                                                            <button type='button' onclick='executarFiltro()' class='btn btn-primary btn-sm'>Filtrar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class='d-flex justify-content-center align-items-center'>
                                    <div>
                                        Tipo Ativo
                                    </div>
                                    <div class='dropdown'>
                                        <button type='button' class='btn p-0 dropdown-toggle hide-arrow show' data-bs-toggle='dropdown' aria-expanded='true'>
                                            <i class='mdi mdi-menu-down'></i>
                                        </button>
                                        <div class='dropdown-menu' data-popper-placement='bottom-end'>
                                            <div class='card'>
                                                <div class='card-body'>
                                                    <h6 class='card-title'>Filtro</h6>";
                                                    foreach($arrayTipoAtivos as $linha){
                                                        $controle = "";

                                                        if($filtroTipoAtivo){
                                                            foreach($filtroTipoAtivo as $var){
                                                                if($var == $linha){
                                                                    $controle = "checked";
                                                                }
                                                            }
                                                        }

                                                        $html .= "
                                                        <div class='row mt-3'>
                                                            <div class='col-md-12'>
                                                                <input class='form-check-input filtroTipoAtivo' $controle type='checkbox' id='tipoAtivo$linha' value='$linha'>
                                                                <label class='form-check-label' for='tipoAtivo$linha'> $linha </label>
                                                            </div>
                                                        </div>
                                                        ";
                                                    }
                                                    $html .= "
                                                    <div class='row mt-3'>
                                                        <div class='col-md-12' align='center'>
                                                            <button type='button' onclick='executarFiltro()' class='btn btn-primary btn-sm'>Filtrar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class='d-flex justify-content-center align-items-center'>
                                    <div>
                                        Operação
                                    </div>
                                    <div class='dropdown'>
                                        <button type='button' class='btn p-0 dropdown-toggle hide-arrow show' data-bs-toggle='dropdown' aria-expanded='true'>
                                            <i class='mdi mdi-menu-down'></i>
                                        </button>
                                        <div class='dropdown-menu' data-popper-placement='bottom-end'>
                                            <div class='card'>
                                                <div class='card-body'>
                                                    <h6 class='card-title'>Filtro</h6>";
                                                    foreach($arrayOperacao as $linha){
                                                        $controle = "";

                                                        if($filtroOperacao){
                                                            foreach($filtroOperacao as $var){
                                                                if($var == $linha){
                                                                    $controle = "checked";
                                                                }
                                                            }
                                                        }

                                                        $html .= "
                                                        <div class='row mt-3'>
                                                            <div class='col-md-12'>
                                                                <input class='form-check-input filtroOperacao' $controle type='checkbox' id='operacao$linha' value='$linha'>
                                                                <label class='form-check-label' for='operacao$linha'> $linha </label>
                                                            </div>
                                                        </div>
                                                        ";
                                                    }
                                                    $html .= "
                                                    <div class='row mt-3'>
                                                        <div class='col-md-12' align='center'>
                                                            <button type='button' onclick='executarFiltro()' class='btn btn-primary btn-sm'>Filtrar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class='d-flex justify-content-center align-items-center'>
                                    <div>
                                        Direção
                                    </div>
                                    <div class='dropdown'>
                                        <button type='button' class='btn p-0 dropdown-toggle hide-arrow show' data-bs-toggle='dropdown' aria-expanded='true'>
                                            <i class='mdi mdi-menu-down'></i>
                                        </button>
                                        <div class='dropdown-menu' data-popper-placement='bottom-end'>
                                            <div class='card'>
                                                <div class='card-body'>
                                                    <h6 class='card-title'>Filtro</h6>";
                                                    foreach($arrayDirecao as $linha){
                                                        $controle = "";

                                                        if($filtroDirecao){
                                                            foreach($filtroDirecao as $var){
                                                                if($var == $linha){
                                                                    $controle = "checked";
                                                                }
                                                            }
                                                        }

                                                        $html .= "
                                                        <div class='row mt-3'>
                                                            <div class='col-md-12'>
                                                                <input class='form-check-input filtroDirecao' $controle type='checkbox' id='direcao$linha' value='$linha'>
                                                                <label class='form-check-label' for='direcao$linha'> $linha </label>
                                                            </div>
                                                        </div>
                                                        ";
                                                    }
                                                    $html .= "
                                                    <div class='row mt-3'>
                                                        <div class='col-md-12' align='center'>
                                                            <button type='button' onclick='executarFiltro()' class='btn btn-primary btn-sm'>Filtrar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class='d-flex justify-content-center align-items-center'>
                                    <div>
                                        Fase
                                    </div>
                                    <div class='dropdown'>
                                        <button type='button' class='btn p-0 dropdown-toggle hide-arrow show' data-bs-toggle='dropdown' aria-expanded='true'>
                                            <i class='mdi mdi-menu-down'></i>
                                        </button>
                                        <div class='dropdown-menu' data-popper-placement='bottom-end'>
                                            <div class='card'>
                                                <div class='card-body'>
                                                    <h6 class='card-title'>Filtro</h6>";
                                                    foreach($arrayFase as $linha){
                                                        $controle = "";

                                                        if($filtroFase){
                                                            foreach($filtroFase as $var){
                                                                if($var == $linha){
                                                                    $controle = "checked";
                                                                }
                                                            }
                                                        }

                                                        $html .= "
                                                        <div class='row mt-3'>
                                                            <div class='col-md-12'>
                                                                <input class='form-check-input filtroFase' $controle type='checkbox' id='fase$linha' value='$linha'>
                                                                <label class='form-check-label' for='fase$linha'> $linha </label>
                                                            </div>
                                                        </div>
                                                        ";
                                                    }
                                                    $html .= "
                                                    <div class='row mt-3'>
                                                        <div class='col-md-12' align='center'>
                                                            <button type='button' onclick='executarFiltro()' class='btn btn-primary btn-sm'>Filtrar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class='d-flex justify-content-center align-items-center'>
                                    <div>
                                        Moeda
                                    </div>
                                    <div class='dropdown'>
                                        <button type='button' class='btn p-0 dropdown-toggle hide-arrow show' data-bs-toggle='dropdown' aria-expanded='true'>
                                            <i class='mdi mdi-menu-down'></i>
                                        </button>
                                        <div class='dropdown-menu' data-popper-placement='bottom-end'>
                                            <div class='card'>
                                                <div class='card-body'>
                                                    <h6 class='card-title'>Filtro</h6>";
                                                    foreach($arrayMoeda as $linha){
                                                        $controle = "";

                                                        if($filtroMoeda){
                                                            foreach($filtroMoeda as $var){
                                                                if($var == $linha){
                                                                    $controle = "checked";
                                                                }
                                                            }
                                                        }

                                                        $html .= "
                                                        <div class='row mt-3'>
                                                            <div class='col-md-12'>
                                                                <input class='form-check-input filtroMoeda' $controle type='checkbox' id='moeda$linha' value='$linha'>
                                                                <label class='form-check-label' for='moeda$linha'> $linha </label>
                                                            </div>
                                                        </div>
                                                        ";
                                                    }
                                                    $html .= "
                                                    <div class='row mt-3'>
                                                        <div class='col-md-12' align='center'>
                                                            <button type='button' onclick='executarFiltro()' class='btn btn-primary btn-sm'>Filtrar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class='d-flex justify-content-center align-items-center'>
                                    <div>
                                        Tipo Custo
                                    </div>
                                    <div class='dropdown'>
                                        <button type='button' class='btn p-0 dropdown-toggle hide-arrow show' data-bs-toggle='dropdown' aria-expanded='true'>
                                            <i class='mdi mdi-menu-down'></i>
                                        </button>
                                        <div class='dropdown-menu' data-popper-placement='bottom-end'>
                                            <div class='card'>
                                                <div class='card-body'>
                                                    <h6 class='card-title'>Filtro</h6>";
                                                    foreach($arrayTipoCusto as $linha){
                                                        $controle = "";

                                                        if($filtroTipoCusto){
                                                            foreach($filtroTipoCusto as $var){
                                                                if($var == $linha){
                                                                    $controle = "checked";
                                                                }
                                                            }
                                                        }

                                                        $html .= "
                                                        <div class='row mt-3'>
                                                            <div class='col-md-12'>
                                                                <input class='form-check-input filtroTipoCusto' $controle type='checkbox' id='tpCusto$linha' value='$linha'>
                                                                <label class='form-check-label' for='tpCusto$linha'> $linha </label>
                                                            </div>
                                                        </div>
                                                        ";
                                                    }
                                                    $html .= "
                                                    <div class='row mt-3'>
                                                        <div class='col-md-12' align='center'>
                                                            <button type='button' onclick='executarFiltro()' class='btn btn-primary btn-sm'>Filtrar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class='d-flex justify-content-center align-items-center'>
                                    <div>
                                        Resultado
                                    </div>
                                    <div class='dropdown'>
                                        <button type='button' class='btn p-0 dropdown-toggle hide-arrow show' data-bs-toggle='dropdown' aria-expanded='true'>
                                            <i class='mdi mdi-menu-down'></i>
                                        </button>
                                        <div class='dropdown-menu' data-popper-placement='bottom-end'>
                                            <div class='card'>
                                                <div class='card-body'>
                                                    <h6 class='card-title'>Filtro</h6>";
                                                    foreach($arrayResultado as $linha){
                                                        $controle = "";

                                                        if($filtroResultado){
                                                            foreach($filtroResultado as $var){
                                                                if($var == $linha){
                                                                    $controle = "checked";
                                                                }
                                                            }
                                                        }

                                                        $html .= "
                                                        <div class='row mt-3'>
                                                            <div class='col-md-12'>
                                                                <input class='form-check-input filtroResultado' $controle type='checkbox' id='resultado$linha' value='$linha'>
                                                                <label class='form-check-label' for='resultado$linha'> $linha </label>
                                                            </div>
                                                        </div>
                                                        ";
                                                    }
                                                    $html .= "
                                                    <div class='row mt-3'>
                                                        <div class='col-md-12' align='center'>
                                                            <button type='button' onclick='executarFiltro()' class='btn btn-primary btn-sm'>Filtrar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <div class='d-flex justify-content-center align-items-center'>
                                    <div>";

                                    if($user->filtroDtEntradaInc){
                                        $html .= "De: ".dataDbForm($user->filtroDtEntradaInc)."<br>";
                                    }
                                    if($user->filtroDtEntradaFn){
                                        $html .= "Até: ".dataDbForm($user->filtroDtEntradaFn)."<br>";
                                    }

                                    $html .= "
                                    </div>
                                    <span id='espaco'></span>
                                </div>
                            </th>
                            <th>
                                <div class='d-flex justify-content-center align-items-center'>
                                    <div>";

                                    if($user->filtroDtSaidaInc){
                                        $html .= "De: ".dataDbForm($user->filtroDtSaidaInc)."<br>";
                                    }
                                    if($user->filtroDtSaidaFn){
                                        $html .= "Até: ".dataDbForm($user->filtroDtSaidaFn)."<br>";
                                    }

                                    $html .= "
                                    </div>
                                    <span id='espaco'></span>
                                </div>
                            </th>
                            <th>
                                <div class='d-flex justify-content-center align-items-center'>
                                    <div>";

                                    if($user->filtroTipoOperacao){
                                        $html .= str_replace(',', ', ',$user->filtroTipoOperacao);
                                    }

                                    $html .= "
                                    </div>
                                    <span id='espaco'></span>
                                </div>
                            </th>
                            <th>
                                <div class='d-flex justify-content-center align-items-center'>
                                    <div>";

                                    if($user->filtroPais){
                                        $html .= str_replace(',', ', ',$user->filtroPais);
                                    }

                                    $html .= "
                                    </div>
                                    <span id='espaco'></span>
                                </div>
                            </th>
                            <th>
                                <div class='d-flex justify-content-center align-items-center'>
                                    <div>";

                                    if($user->filtroCorretora){
                                        $html .= $stringCorretoras;
                                    }

                                    $html .= "
                                    </div>
                                    <span id='espaco'></span>
                                </div>
                            </th>
                            <th>
                                <div class='d-flex justify-content-center align-items-center'>
                                    <div>";

                                    if($user->filtroTipoConta){
                                        $html .= str_replace(',', ', ',$user->filtroTipoConta);
                                    }

                                    $html .= "
                                    </div>
                                    <span id='espaco'></span>
                                </div>
                            </th>
                            <th>
                                <div class='d-flex justify-content-center align-items-center'>
                                    <div>";

                                    if($user->filtroAtivo){
                                        $html .= $stringAtivos;
                                    }

                                    $html .= "
                                    </div>
                                    <span id='espaco'></span>
                                </div>
                            </th>
                            <th>
                                <div class='d-flex justify-content-center align-items-center'>
                                    <div>";

                                    if($user->filtroTipoAtivo){
                                        $html .= str_replace(',', ', ',$user->filtroTipoAtivo);
                                    }

                                    $html .= "
                                    </div>
                                    <span id='espaco'></span>
                                </div>
                            </th>
                            <th>
                                <div class='d-flex justify-content-center align-items-center'>
                                    <div>";

                                    if($user->filtroOperacao){
                                        $html .= str_replace(',', ', ',$user->filtroOperacao);
                                    }

                                    $html .= "
                                    </div>
                                    <span id='espaco'></span>
                                </div>
                            </th>
                            <th>
                                <div class='d-flex justify-content-center align-items-center'>
                                    <div>";

                                    if($user->filtroDirecao){
                                        $html .= str_replace(',', ', ',$user->filtroDirecao);
                                    }

                                    $html .= "
                                    </div>
                                    <span id='espaco'></span>
                                </div>
                            </th>
                            <th>
                                <div class='d-flex justify-content-center align-items-center'>
                                    <div>";

                                    if($user->filtroFase){
                                        $html .= str_replace(',', ', ',$user->filtroFase);
                                    }

                                    $html .= "
                                    </div>
                                    <span id='espaco'></span>
                                </div>
                            </th>
                            <th>
                                <div class='d-flex justify-content-center align-items-center'>
                                    <div>";

                                    if($user->filtroMoeda){
                                        $html .= str_replace(',', ', ',$user->filtroMoeda);
                                    }

                                    $html .= "
                                    </div>
                                    <span id='espaco'></span>
                                </div>
                            </th>
                            <th>
                                <div class='d-flex justify-content-center align-items-center'>
                                    <div>";

                                    if($user->filtroTipoCusto){
                                        $html .= str_replace(',', ', ',$user->filtroTipoCusto);
                                    }

                                    $html .= "
                                    </div>
                                    <span id='espaco'></span>
                                </div>
                            </th>
                            <th>
                                <div class='d-flex justify-content-center align-items-center'>
                                    <div>";

                                    if($user->filtroResultado){
                                        $html .= str_replace(',', ', ',$user->filtroResultado);
                                    }

                                    $html .= "
                                    </div>
                                    <span id='espaco'></span>
                                </div>
                            </th>
                        </tr>
                    </table>
                </div>
            </div>
        </form>
        <script>
        function executarFiltro(){

            //vamos verificar os filtros de entrada e saida da traide
            document.getElementById('form_dtEntradaInc').value = document.getElementById('filtro_dtEntradaInc').value;
            document.getElementById('form_dtEntradaFn').value = document.getElementById('filtro_dtEntradaFn').value;
            document.getElementById('form_dtSaidaInc').value = document.getElementById('filtro_dtSaidaInc').value;
            document.getElementById('form_dtSaidaFn').value = document.getElementById('filtro_dtSaidaFn').value;

            //vamos verificar os filtros do Status
            var filtroStatus = '';
            inputs = document.querySelectorAll('input.filtroStatus');

            [].forEach.call(inputs, function(input) {
                if(input.checked == true){
                    filtroStatus = filtroStatus + ',' + input.value;
                }
            });
            document.getElementById('form_fitroStatus').value = filtroStatus;

            //vamos verificar os filtros do tipo operação
            var filtroTipoOperacao = '';
            inputs = document.querySelectorAll('input.filtroTOperacao');

            [].forEach.call(inputs, function(input) {
                if(input.checked == true){
                    filtroTipoOperacao = filtroTipoOperacao + ',' + input.value;
                }
            });
            document.getElementById('form_fitroTipoOperacao').value = filtroTipoOperacao;

            //vamos verificar os filtros do pais
            var filtroPais = '';
            inputs = document.querySelectorAll('input.filtroPais');

            [].forEach.call(inputs, function(input) {
                if(input.checked == true){
                    filtroPais = filtroPais + ',' + input.value;
                }
            });
            document.getElementById('form_fitroPais').value = filtroPais;

            //vamos verificar os filtros das corretoras
            var filtroCorretora = '';
            inputs = document.querySelectorAll('input.filtroCorretora');

            [].forEach.call(inputs, function(input) {
                if(input.checked == true){
                    filtroCorretora = filtroCorretora + ',' + input.value;
                }
            });
            document.getElementById('form_fitroCorretora').value = filtroCorretora;

            //vamos verificar os filtros do tipo de conta
            var filtroTipoConta = '';
            inputs = document.querySelectorAll('input.filtroTipoConta');

            [].forEach.call(inputs, function(input) {
                if(input.checked == true){
                    filtroTipoConta = filtroTipoConta + ',' + input.value;
                }
            });
            document.getElementById('form_filtroTipoConta').value = filtroTipoConta;

            //vamos verificar os filtros de ativos
            var filtroAtivo = '';
            inputs = document.querySelectorAll('input.filtroAtivo');

            [].forEach.call(inputs, function(input) {
                if(input.checked == true){
                    filtroAtivo = filtroAtivo + ',' + input.value;
                }
            });
            document.getElementById('form_filtroAtivo').value = filtroAtivo;

            //vamos verificar os filtros de tipos ativos
            var filtroTipoAtivo = '';
            inputs = document.querySelectorAll('input.filtroTipoAtivo');

            [].forEach.call(inputs, function(input) {
                if(input.checked == true){
                    filtroTipoAtivo = filtroTipoAtivo + ',' + input.value;
                }
            });
            document.getElementById('form_filtroTipoAtivo').value = filtroTipoAtivo;

            //vamos verificar os filtros de operações
            var filtroOperacao = '';
            inputs = document.querySelectorAll('input.filtroOperacao');

            [].forEach.call(inputs, function(input) {
                if(input.checked == true){
                    filtroOperacao = filtroOperacao + ',' + input.value;
                }
            });
            document.getElementById('form_filtroOperacao').value = filtroOperacao;

            //vamos verificar os filtros de direção
            var filtroDirecao = '';
            inputs = document.querySelectorAll('input.filtroDirecao');

            [].forEach.call(inputs, function(input) {
                if(input.checked == true){
                    filtroDirecao = filtroDirecao + ',' + input.value;
                }
            });
            document.getElementById('form_filtroDirecao').value = filtroDirecao;

            //vamos verificar os filtros de fase
            var filtroFase = '';
            inputs = document.querySelectorAll('input.filtroFase');

            [].forEach.call(inputs, function(input) {
                if(input.checked == true){
                    filtroFase = filtroFase + ',' + input.value;
                }
            });
            document.getElementById('form_filtroFase').value = filtroFase;

            //vamos verificar os filtros de moeda
            var filtroMoeda = '';
            inputs = document.querySelectorAll('input.filtroMoeda');

            [].forEach.call(inputs, function(input) {
                if(input.checked == true){
                    filtroMoeda = filtroMoeda + ',' + input.value;
                }
            });
            document.getElementById('form_filtroMoeda').value = filtroMoeda;

            //vamos verificar os filtros de tipo de custo
            var filtroTipoCusto = '';
            inputs = document.querySelectorAll('input.filtroTipoCusto');

            [].forEach.call(inputs, function(input) {
                if(input.checked == true){
                    filtroTipoCusto = filtroTipoCusto + ',' + input.value;
                }
            });
            document.getElementById('form_filtroTipoCusto').value = filtroTipoCusto;

            //vamos verificar os filtros de Resultado
            var filtroResultado = '';
            inputs = document.querySelectorAll('input.filtroResultado');

            [].forEach.call(inputs, function(input) {
                if(input.checked == true){
                    filtroResultado = filtroResultado + ',' + input.value;
                }
            });
            document.getElementById('form_filtroResultado').value = filtroResultado;

            document.getElementById('formularioPesquisa').submit();
        }

        </script>
        ";
        return $html;
    }

    public function filtroTempo($tempo, $redirect){
        $user = auth()->user();
        $dtEntradaFn = date('Y-m-d');
        if($tempo == 'semana'){
            $dtEntradaInc = date("Y-m-d", strtotime("-7 days",strtotime($dtEntradaFn)));
        }
        elseif($tempo == 'mes'){
            $dtEntradaInc = date("Y-m-d", strtotime("-30 days",strtotime($dtEntradaFn)));
        }
        elseif($tempo == '3meses'){
            $dtEntradaInc = date("Y-m-d", strtotime("-90 days",strtotime($dtEntradaFn)));
        }
        elseif($tempo == '6meses'){
            $dtEntradaInc = date("Y-m-d", strtotime("-180 days",strtotime($dtEntradaFn)));
        }

        $user->filtroDtEntradaInc = $dtEntradaInc;
        $user->filtroDtEntradaFn = $dtEntradaFn;
        $user->filtroDtSaidaInc = null;
        $user->filtroDtSaidaFn = null;
        $user->filtroTrades = null;

        $user->save();

        return redirect()->route($redirect);
    }

}
