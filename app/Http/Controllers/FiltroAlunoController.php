<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Corretora;
use App\Models\Conta;
use App\Models\Ativo;
use App\Models\Trade;

class FiltroAlunoController extends Controller
{
    public function index(){
        $filtro = $this->geraFiltroAluno('aluno.filtro');

        return view('acessoAluno/filtro/index', compact('filtro'));
    }

    public function geraFiltroAluno($redirect){
        $aluno = session()->get('aluno');
        $filtroStatus = $aluno->filtroStatus == NULL ? NULL : explode(',', $aluno->filtroStatus);
        $filtroTipoOperacao = $aluno->filtroTipoOperacao == NULL ? NULL : explode(',', $aluno->filtroTipoOperacao);
        $filtroPais = $aluno->filtroPais == NULL ? NULL : explode(',', $aluno->filtroPais);
        $filtroCorretora = $aluno->filtroCorretora == NULL ? NULL : explode(',', $aluno->filtroCorretora);
        $filtroTipoConta = $aluno->filtroTipoConta == NULL ? NULL : explode(',', $aluno->filtroTipoConta);
        $filtroConta = $aluno->filtroConta == NULL ? NULL : explode(',', $aluno->filtroConta);
        $filtroAtivo = $aluno->filtroAtivo == NULL ? NULL : explode(',', $aluno->filtroAtivo);
        $filtroTipoAtivo = $aluno->filtroTipoAtivo == NULL ? NULL : explode(',', $aluno->filtroTipoAtivo);
        $filtroOperacao = $aluno->filtroOperacao == NULL ? NULL : explode(',', $aluno->filtroOperacao);
        $filtroDirecao = $aluno->filtroDirecao == NULL ? NULL : explode(',', $aluno->filtroDirecao);
        $filtroFase = $aluno->filtroFase == NULL ? NULL : explode(',', $aluno->filtroFase);
        $filtroMoeda = $aluno->filtroMoeda == NULL ? NULL : explode(',', $aluno->filtroMoeda);
        $filtroTipoCusto = $aluno->filtroTipoCusto == NULL ? NULL : explode(',', $aluno->filtroTipoCusto);
        $filtroResultado = $aluno->filtroResultado == NULL ? NULL : explode(',', $aluno->filtroResultado);

        $varCorretoras = explode(',',$aluno->filtroCorretora);
        $stringCorretoras = "";
        foreach ($varCorretoras as $linha) {
            $var = Corretora::where('id', $linha)->first();
            if($var){
                $stringCorretoras .= ", ".$var->nome;
            }
        }
        $stringCorretoras = substr($stringCorretoras, 2);

        //vamos buscar os nomes das contas do filtros
        $varContas = explode(',',$aluno->filtroConta);
        $stringContas = "";
        foreach ($varContas as $linha) {
            $var = Conta::where('id', $linha)->first();
            if($var){
                $stringContas .= ", ".$var->nrConta."-".$var->nmConta;
            }
        }
        $stringContas = substr($stringContas, 2);

        //vamos buscar os nomes dos ativos do filtros
        $varAtivos = explode(',',$aluno->filtroAtivo);
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
        $contas = Conta::where('id_aluno', $aluno->id)->get();
        $ativos = Ativo::all()->sortBy('nome');


        $html = "
            <form action='".route('aluno.filtro.setar')."' method='post' id='formularioPesquisa'>
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
                    <div class='col-md-6'>
                        <span class='card-title'>Filtros</span>
                    </div>
                    <div class='col-md-6' align='right'>
                        <button type='button' class='btn btn-sm btn-warning' id='btnLimparFiltos'>Limpar Filtros</button>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-md-12' style='overflow-x: scroll;'>
                        <table class='table table-sm table-filtro mt-3'>
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
                                                                    <input class='form-control' type='date' id='filtro_dtEntradaInc' name='filtro_dtEntradaInc' placeholder='Início' value='$aluno->dtEntradaInc'/>
                                                                    <label for='filtro_dtEntradaInc'>Início:</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class='row mt-3'>
                                                            <div class='col-md-12'>
                                                                <div class='form-floating form-floating-outline'>
                                                                    <input class='form-control' type='date' id='filtro_dtEntradaFn' name='filtro_dtEntradaFn' placeholder='Fim' value='$aluno->dtEntradaFn'/>
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
                                                                    <input class='form-control' type='date' id='filtro_dtSaidaInc' name='filtro_dtSaidaInc' placeholder='Início' value='$aluno->dtSaidaInc'/>
                                                                    <label for='filtro_dtSaidaInc'>Início:</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class='row mt-3'>
                                                            <div class='col-md-12'>
                                                                <div class='form-floating form-floating-outline'>
                                                                    <input class='form-control' type='date' id='filtro_dtSaidaFn' name='filtro_dtSaidaFn' placeholder='Fim' value='$aluno->dtSaidaFn'/>
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
                                            Contas
                                        </div>
                                        <div class='dropdown'>
                                            <button type='button' class='btn p-0 dropdown-toggle hide-arrow show' data-bs-toggle='dropdown' aria-expanded='true'>
                                                <i class='mdi mdi-menu-down'></i>
                                            </button>
                                            <div class='dropdown-menu' data-popper-placement='bottom-end'>
                                                <div class='card'>
                                                    <div class='card-body'>
                                                        <h6 class='card-title'>Filtro</h6>";
                                                        foreach($contas as $conta){
                                                            $controle = "";

                                                            if($filtroConta){
                                                                foreach($filtroConta as $var){
                                                                    if($var == $conta->id){
                                                                        $controle = "checked";
                                                                    }
                                                                }
                                                            }

                                                            $html .= "
                                                            <div class='row mt-3'>
                                                                <div class='col-md-12'>
                                                                    <input class='form-check-input filtroConta' $controle type='checkbox' id='conta$conta->id' value='$conta->id'>
                                                                    <label class='form-check-label' for='corretora$conta->id'> $conta->nmConta </label>
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

                                        if($aluno->dtEntradaInc){
                                            $html .= "De: ".dataDbForm($aluno->dtEntradaInc)."<br>";
                                        }
                                        if($aluno->dtEntradaFn){
                                            $html .= "Até: ".dataDbForm($aluno->dtEntradaFn)."<br>";
                                        }

                                        $html .= "
                                        </div>
                                        <span id='espaco'></span>
                                    </div>
                                </th>
                                <th>
                                    <div class='d-flex justify-content-center align-items-center'>
                                        <div>";

                                        if($aluno->dtSaidaInc){
                                            $html .= "De: ".dataDbForm($aluno->dtSaidaInc)."<br>";
                                        }
                                        if($aluno->dtSaidaFn){
                                            $html .= "Até: ".dataDbForm($aluno->dtSaidaFn)."<br>";
                                        }

                                        $html .= "
                                        </div>
                                        <span id='espaco'></span>
                                    </div>
                                </th>
                                <th>
                                    <div class='d-flex justify-content-center align-items-center'>
                                        <div>";

                                        if($aluno->filtroTipoOperacao){
                                            $html .= str_replace(',', ', ',$aluno->filtroTipoOperacao);
                                        }

                                        $html .= "
                                        </div>
                                        <span id='espaco'></span>
                                    </div>
                                </th>
                                <th>
                                    <div class='d-flex justify-content-center align-items-center'>
                                        <div>";

                                        if($aluno->filtroPais){
                                            $html .= str_replace(',', ', ',$aluno->filtroPais);
                                        }

                                        $html .= "
                                        </div>
                                        <span id='espaco'></span>
                                    </div>
                                </th>
                                <th>
                                    <div class='d-flex justify-content-center align-items-center'>
                                        <div>";

                                        if($aluno->filtroCorretora){
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

                                        if($aluno->filtroTipoConta){
                                            $html .= str_replace(',', ', ',$aluno->filtroTipoConta);
                                        }

                                        $html .= "
                                        </div>
                                        <span id='espaco'></span>
                                    </div>
                                </th>
                                <th>
                                    <div class='d-flex justify-content-center align-items-center'>
                                        <div>";

                                        if($aluno->filtroConta){
                                            $html .= $stringContas;
                                        }

                                        $html .= "
                                        </div>
                                        <span id='espaco'></span>
                                    </div>
                                </th>
                                <th>
                                    <div class='d-flex justify-content-center align-items-center'>
                                        <div>";

                                        if($aluno->filtroAtivo){
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

                                        if($aluno->filtroTipoAtivo){
                                            $html .= str_replace(',', ', ',$aluno->filtroTipoAtivo);
                                        }

                                        $html .= "
                                        </div>
                                        <span id='espaco'></span>
                                    </div>
                                </th>
                                <th>
                                    <div class='d-flex justify-content-center align-items-center'>
                                        <div>";

                                        if($aluno->filtroOperacao){
                                            $html .= str_replace(',', ', ',$aluno->filtroOperacao);
                                        }

                                        $html .= "
                                        </div>
                                        <span id='espaco'></span>
                                    </div>
                                </th>
                                <th>
                                    <div class='d-flex justify-content-center align-items-center'>
                                        <div>";

                                        if($aluno->filtroDirecao){
                                            $html .= str_replace(',', ', ',$aluno->filtroDirecao);
                                        }

                                        $html .= "
                                        </div>
                                        <span id='espaco'></span>
                                    </div>
                                </th>
                                <th>
                                    <div class='d-flex justify-content-center align-items-center'>
                                        <div>";

                                        if($aluno->filtroFase){
                                            $html .= str_replace(',', ', ',$aluno->filtroFase);
                                        }

                                        $html .= "
                                        </div>
                                        <span id='espaco'></span>
                                    </div>
                                </th>
                                <th>
                                    <div class='d-flex justify-content-center align-items-center'>
                                        <div>";

                                        if($aluno->filtroMoeda){
                                            $html .= str_replace(',', ', ',$aluno->filtroMoeda);
                                        }

                                        $html .= "
                                        </div>
                                        <span id='espaco'></span>
                                    </div>
                                </th>
                                <th>
                                    <div class='d-flex justify-content-center align-items-center'>
                                        <div>";

                                        if($aluno->filtroTipoCusto){
                                            $html .= str_replace(',', ', ',$aluno->filtroTipoCusto);
                                        }

                                        $html .= "
                                        </div>
                                        <span id='espaco'></span>
                                    </div>
                                </th>
                                <th>
                                    <div class='d-flex justify-content-center align-items-center'>
                                        <div>";

                                        if($aluno->filtroResultado){
                                            $html .= str_replace(',', ', ',$aluno->filtroResultado);
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
            document.getElementById('btnLimparFiltos').addEventListener('click', ()=>{
                window.location.href = '".route('aluno.filtro.limpar', $redirect)."';
            });

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

                //vamos verificar os filtros da conta
                var filtroConta = '';
                inputs = document.querySelectorAll('input.filtroConta');

                [].forEach.call(inputs, function(input) {
                    if(input.checked == true){
                        filtroConta = filtroConta + ',' + input.value;
                    }
                });
                document.getElementById('form_filtroConta').value = filtroConta;

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

    public function limparFiltros($redirect){
        $aluno = session()->get('aluno');
        $aluno->dtEntradaInc = NULL;
        $aluno->dtEntradaFn = NULL;
        $aluno->dtSaidaInc = NULL;
        $aluno->dtSaidaFn = NULL;
        $aluno->filtroStatus = NULL;
        $aluno->filtroTipoOperacao = NULL;
        $aluno->filtroPais = NULL;
        $aluno->filtroCorretora = NULL;
        $aluno->filtroTipoConta = NULL;
        $aluno->filtroConta = NULL;
        $aluno->filtroAtivo = NULL;
        $aluno->filtroTipoAtivo = NULL;
        $aluno->filtroOperacao = NULL;
        $aluno->filtroDirecao = NULL;
        $aluno->filtroFase = NULL;
        $aluno->filtroMoeda = NULL;
        $aluno->filtroTipoCusto = NULL;
        $aluno->filtroResultado = NULL;
        $aluno->filtroTrades = NULL;

        $aluno->save();

        return redirect()->route($redirect);
    }

    public function setarFiltros(Request $request, $controle = null){ //$controle serve para verificar se só tem que refazer as trades ou salvar novamente os filtros
        $aluno = session()->get('aluno');

        if(!$controle){
            $dados = $request->all();

            $aluno->dtEntradaInc = $dados['dtEntradaInc'];
            $aluno->dtEntradaFn = $dados['dtEntradaFn'];
            $aluno->dtSaidaInc = $dados['dtSaidaInc'];
            $aluno->dtSaidaFn = $dados['dtSaidaFn'];
            $aluno->filtroStatus = $dados['filtroStatus'] == NULL ? NULL : substr($dados['filtroStatus'], 1);
            $aluno->filtroTipoOperacao = $dados['filtroTipoOperacao'] == NULL ? NULL : substr($dados['filtroTipoOperacao'], 1);
            $aluno->filtroPais = $dados['filtroPais'] == NULL ? NULL : substr($dados['filtroPais'], 1);
            $aluno->filtroCorretora = $dados['filtroCorretora'] == NULL ? NULL : substr($dados['filtroCorretora'], 1);
            $aluno->filtroTipoConta = $dados['filtroTipoConta'] == NULL ? NULL : substr($dados['filtroTipoConta'], 1);
            $aluno->filtroConta = $dados['filtroConta'] == NULL ? NULL : substr($dados['filtroConta'], 1);
            $aluno->filtroAtivo = $dados['filtroAtivo'] == NULL ? NULL : substr($dados['filtroAtivo'], 1);
            $aluno->filtroTipoAtivo = $dados['filtroTipoAtivo'] == NULL ? NULL : substr($dados['filtroTipoAtivo'], 1);
            $aluno->filtroOperacao = $dados['filtroOperacao'] == NULL ? NULL : substr($dados['filtroOperacao'], 1);
            $aluno->filtroDirecao = $dados['filtroDirecao'] == NULL ? NULL : substr($dados['filtroDirecao'], 1);
            $aluno->filtroFase = $dados['filtroFase'] == NULL ? NULL : substr($dados['filtroFase'], 1);
            $aluno->filtroMoeda = $dados['filtroMoeda'] == NULL ? NULL : substr($dados['filtroMoeda'], 1);
            $aluno->filtroTipoCusto = $dados['filtroTipoCusto'] == NULL ? NULL : substr($dados['filtroTipoCusto'], 1);
            $aluno->filtroResultado = $dados['filtroResultado'] == NULL ? NULL : substr($dados['filtroResultado'], 1);
            $aluno->filtroTrades = NULL;

            $aluno->save();
        }
        else{
            $aluno->dtEntradaInc = NULL;
            $aluno->dtEntradaFn = NULL;
            $aluno->dtSaidaInc = NULL;
            $aluno->dtSaidaFn = NULL;
            $aluno->filtroStatus = NULL;
            $aluno->filtroTipoOperacao = NULL;
            $aluno->filtroPais = NULL;
            $aluno->filtroCorretora = NULL;
            $aluno->filtroTipoConta = NULL;
            $aluno->filtroConta = NULL;
            $aluno->filtroAtivo = NULL;
            $aluno->filtroTipoAtivo = NULL;
            $aluno->filtroOperacao = NULL;
            $aluno->filtroDirecao = NULL;
            $aluno->filtroFase = NULL;
            $aluno->filtroMoeda = NULL;
            $aluno->filtroTipoCusto = NULL;
            $aluno->filtroResultado = NULL;
            $aluno->filtroTrades = NULL;

            $aluno->save();
        }

        $trades = Trade::listaResultados($aluno);

        $stringTrades = "";
        foreach($trades as $trade){
            $stringTrades .= ','.$trade->id_trade;
        }
        $stringTrades = substr($stringTrades, 1);

        $aluno->filtroTrades = $stringTrades;
        $aluno->save();

        if(!$controle){
            return redirect()->route($dados['redirect']);
        }

    }

    public function filtrarTempo($tempo, $redirect){
        $aluno = session()->get('aluno');
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

        $aluno->dtEntradaInc = $dtEntradaInc;
        $aluno->dtEntradaFn = $dtEntradaFn;
        $aluno->dtSaidaInc = null;
        $aluno->dtSaidaFn = null;
        $aluno->filtroTrades = null;

        $aluno->save();

        return redirect()->route($redirect);
        //$request = new Request();

        //$varTrades = "";
        //$trades = Trade::listaResultados($aluno);

        //foreach($trades as $trade){
        //    $varTrades .= ",".$trade->id_trade;
        //}

        //return $this->onePageReport($request, $varTrades, 'view');
    }

}
