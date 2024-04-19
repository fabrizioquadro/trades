@extends('layoutAluno')

@section('conteudo')
<!--
<style>
.table-filtro th, td{
    font-size: 8px !important;
}

.dropdown-menu{
    width: 300px !important;
}

.dropdown-menu .card-title{
    font-size: 12px !important;
}

.dropdown-menu label{
    font-size: 10px !important;
}

</style>
-->
<style media="screen">
.table-trades th{
    font-size: 10px !important;
}

.table-trades td{
    font-size: 10px !important;
}
</style>
@php
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
@endphp

<div class="container-xxl flex-grow-1 container-p-y">
    <form id='formularioPesquisa' action="{{ route('aluno.trades') }}" method="post">
        @csrf
        <input type="hidden" name="pesquisar" value='true'>
        <input type="hidden" name='controleFiltro' value="filtro">
        <input type="hidden" id="form_dtEntradaInc" name='dtEntradaInc'>
        <input type="hidden" id="form_dtEntradaFn" name='dtEntradaFn'>
        <input type="hidden" id="form_dtSaidaInc" name='dtSaidaInc'>
        <input type="hidden" id="form_dtSaidaFn" name='dtSaidaFn'>
        <input type="hidden" id="form_fitroStatus" name='filtroStatus'>
        <input type="hidden" id="form_fitroTipoOperacao" name='filtroTipoOperacao'>
        <input type="hidden" id="form_fitroPais" name='filtroPais'>
        <input type="hidden" id="form_fitroCorretora" name='filtroCorretora'>
        <input type="hidden" id="form_filtroTipoConta" name='filtroTipoConta'>
        <input type="hidden" id="form_filtroConta" name='filtroConta'>
        <input type="hidden" id="form_filtroAtivo" name='filtroAtivo'>
        <input type="hidden" id="form_filtroTipoAtivo" name='filtroTipoAtivo'>
        <input type="hidden" id="form_filtroOperacao" name='filtroOperacao'>
        <input type="hidden" id="form_filtroDirecao" name='filtroDirecao'>
        <input type="hidden" id="form_filtroFase" name='filtroFase'>
        <input type="hidden" id="form_filtroMoeda" name='filtroMoeda'>
        <input type="hidden" id="form_filtroTipoCusto" name='filtroTipoCusto'>
        <input type="hidden" id="form_filtroResultado" name='filtroResultado'>
        <div class="row">
            <div class="col-md-6">
                <span class="card-title">Filtros</span>
            </div>
            <div class="col-md-6" align='right'>
                <button type="button" class='btn btn-sm btn-warning' id='btnLimparFiltos'>Limpar Filtros</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12" style="overflow-x: scroll;">
                <table class='table table-sm table-filtro mt-3'>
                    <tr>
                        <td>
                            <div style='display: flex'>
                                Entrada
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow show" data-bs-toggle="dropdown" aria-expanded="true">
                                        <i class="mdi mdi-menu-down"></i>
                                    </button>
                                    <div class="dropdown-menu" data-popper-placement="bottom-end">
                                        <div class="card">
                                            <div class="card-body">
                                                <h6 class="card-title">Filtro</h6>
                                                <div class="row mt-3">
                                                    <div class="col-md-12">
                                                        <div class="form-floating form-floating-outline">
                                                            <input class="form-control" type="date" id="filtro_dtEntradaInc" name="filtro_dtEntradaInc" placeholder="Início" value="{{ $aluno->dtEntradaInc }}"/>
                                                            <label for="filtro_dtEntradaInc">Início:</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-md-12">
                                                        <div class="form-floating form-floating-outline">
                                                            <input class="form-control" type="date" id="filtro_dtEntradaFn" name="filtro_dtEntradaFn" placeholder="Fim" value='{{ $aluno->dtEntradaFn }}'/>
                                                            <label for="filtro_dtEntradaFn">Fim:</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-md-12" align='center'>
                                                        <button type="button" onclick="executarFiltro()" class='btn btn-primary btn-sm'>Filtrar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div style='display: flex'>
                                Saída
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow show" data-bs-toggle="dropdown" aria-expanded="true">
                                        <i class="mdi mdi-menu-down"></i>
                                    </button>
                                    <div class="dropdown-menu" data-popper-placement="bottom-end">
                                        <div class="card">
                                            <div class="card-body">
                                                <h6 class="card-title">Filtro</h6>
                                                <div class="row mt-3">
                                                    <div class="col-md-12">
                                                        <div class="form-floating form-floating-outline">
                                                            <input class="form-control" type="date" id="filtro_dtSaidaInc" name="filtro_dtSaidaInc" placeholder="Início" value="{{ $aluno->dtSaidaInc }}" />
                                                            <label for="filtro_dtSaidaInc">Início:</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-md-12">
                                                        <div class="form-floating form-floating-outline">
                                                            <input class="form-control" type="date" id="filtro_dtSaidaFn" name="filtro_dtSaidaFn" placeholder="Fim"/ value="{{ $aluno->dtSaidaFn }}" >
                                                            <label for="filtro_dtSaidaFn">Fim:</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-md-12" align='center'>
                                                        <button type="button" onclick="executarFiltro()" class='btn btn-primary btn-sm'>Filtrar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div style='display: flex'>
                                Tipo Operação
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow show" data-bs-toggle="dropdown" aria-expanded="true">
                                        <i class="mdi mdi-menu-down"></i>
                                    </button>
                                    <div class="dropdown-menu" data-popper-placement="bottom-end">
                                        <div class="card">
                                            <div class="card-body">
                                                <h6 class="card-title">Filtro</h6>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-check mt-3">
                                                            @php
                                                            $controle = "";
                                                            if($filtroTipoOperacao){
                                                                foreach($filtroTipoOperacao as $linha){
                                                                    if($linha == 'Day Trade'){
                                                                        $controle = "checked";
                                                                    }
                                                                }
                                                            }
                                                            @endphp
                                                            <input class="form-check-input filtroTOperacao" {{ $controle }} type="checkbox" id='tpDayTrade' value="Day Trade">
                                                            <label class="form-check-label" for="tpDayTrade"> Day Trade </label>
                                                        </div>
                                                        </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-check mt-3">
                                                            @php
                                                            $controle = "";
                                                            if($filtroTipoOperacao){
                                                                foreach($filtroTipoOperacao as $linha){
                                                                    if($linha == 'Hedge'){
                                                                        $controle = "checked";
                                                                    }
                                                                }
                                                            }
                                                            @endphp
                                                            <input class="form-check-input filtroTOperacao" {{ $controle }} type="checkbox" id='tpDayTrade' value="Hedge">
                                                            <label class="form-check-label" for="tpHedge"> Hedge </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-check mt-3">
                                                            @php
                                                            $controle = "";
                                                            if($filtroTipoOperacao){
                                                                foreach($filtroTipoOperacao as $linha){
                                                                    if($linha == 'Position'){
                                                                        $controle = "checked";
                                                                    }
                                                                }
                                                            }
                                                            @endphp
                                                            <input class="form-check-input filtroTOperacao" {{ $controle }} type="checkbox" id='tpPosition' value="Position">
                                                            <label class="form-check-label" for="tpPosition"> Position </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-check mt-3">
                                                            @php
                                                            $controle = "";
                                                            if($filtroTipoOperacao){
                                                                foreach($filtroTipoOperacao as $linha){
                                                                    if($linha == 'Scalp'){
                                                                        $controle = "checked";
                                                                    }
                                                                }
                                                            }
                                                            @endphp
                                                            <input class="form-check-input filtroTOperacao" {{ $controle }} type="checkbox" id='tpScalp' value="Scalp">
                                                            <label class="form-check-label" for="tpScalp"> Scalp </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-check mt-3">
                                                            @php
                                                            $controle = "";
                                                            if($filtroTipoOperacao){
                                                                foreach($filtroTipoOperacao as $linha){
                                                                    if($linha == 'Swing Trade'){
                                                                        $controle = "checked";
                                                                    }
                                                                }
                                                            }
                                                            @endphp
                                                            <input class="form-check-input filtroTOperacao" {{ $controle }} type="checkbox" id='tpSwingTrade' value="Swing Trade">
                                                            <label class="form-check-label" for="tpSwingTrade"> Swing Trade </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-md-12" align='center'>
                                                        <button type="button" onclick="executarFiltro()" class='btn btn-primary btn-sm'>Filtrar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div style='display: flex'>
                                Pais
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow show" data-bs-toggle="dropdown" aria-expanded="true">
                                        <i class="mdi mdi-menu-down"></i>
                                    </button>
                                    <div class="dropdown-menu" data-popper-placement="bottom-end">
                                        <div class="card">
                                            <div class="card-body">
                                                <h6 class="card-title">Filtro</h6>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-check mt-3">
                                                            @php
                                                            $controle = "";
                                                            if($filtroPais){
                                                                foreach($filtroPais as $linha){
                                                                    if($linha == 'BRA'){
                                                                        $controle = "checked";
                                                                    }
                                                                }
                                                            }
                                                            @endphp
                                                            <input class="form-check-input filtroPais" {{ $controle }} type="checkbox" value="BRA" id="paisBRA">
                                                            <label class="form-check-label" for="paisBRA"> BRA </label>
                                                        </div>
                                                        </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-check mt-3">
                                                            @php
                                                            $controle = "";
                                                            if($filtroPais){
                                                                foreach($filtroPais as $linha){
                                                                    if($linha == 'EUA'){
                                                                        $controle = "checked";
                                                                    }
                                                                }
                                                            }
                                                            @endphp
                                                            <input class="form-check-input filtroPais" {{ $controle }} type="checkbox" value="EUA" id="paisEUA">
                                                            <label class="form-check-label" for="paisEUA"> EUA </label>
                                                        </div>
                                                        </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-check mt-3">
                                                            @php
                                                            $controle = "";
                                                            if($filtroPais){
                                                                foreach($filtroPais as $linha){
                                                                    if($linha == 'EUR'){
                                                                        $controle = "checked";
                                                                    }
                                                                }
                                                            }
                                                            @endphp
                                                            <input class="form-check-input filtroPais" {{ $controle }} type="checkbox" value="EUR" id="paisEUR">
                                                            <label class="form-check-label" for="paisEUR"> EUR </label>
                                                        </div>
                                                        </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-check mt-3">
                                                            @php
                                                            $controle = "";
                                                            if($filtroPais){
                                                                foreach($filtroPais as $linha){
                                                                    if($linha == 'UK'){
                                                                        $controle = "checked";
                                                                    }
                                                                }
                                                            }
                                                            @endphp
                                                            <input class="form-check-input filtroPais" {{ $controle }} type="checkbox" value="UK" id="paisUK">
                                                            <label class="form-check-label" for="paisUK"> UK </label>
                                                        </div>
                                                        </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-check mt-3">
                                                            @php
                                                            $controle = "";
                                                            if($filtroPais){
                                                                foreach($filtroPais as $linha){
                                                                    if($linha == 'Cryptos'){
                                                                        $controle = "checked";
                                                                    }
                                                                }
                                                            }
                                                            @endphp
                                                            <input class="form-check-input filtroPais" {{ $controle }} type="checkbox" value="Cryptos" id="paisCryptos">
                                                            <label class="form-check-label" for="paisCryptos"> Cryptos </label>
                                                        </div>
                                                        </div>
                                                </div>

                                                <div class="row mt-3">
                                                    <div class="col-md-12" align='center'>
                                                        <button type="button" onclick="executarFiltro()" class='btn btn-primary btn-sm'>Filtrar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div style='display: flex'>
                                Corretora
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow show" data-bs-toggle="dropdown" aria-expanded="true">
                                        <i class="mdi mdi-menu-down"></i>
                                    </button>
                                    <div class="dropdown-menu" data-popper-placement="bottom-end">
                                        <div class="card">
                                            <div class="card-body">
                                                <h6 class="card-title">Filtro</h6>
                                                @foreach($corretoras as $linha)
                                                    @php
                                                    $controle = "";
                                                    if($filtroCorretora){
                                                        foreach($filtroCorretora as $row){
                                                            if($row == $linha->id){
                                                                $controle = "checked";
                                                            }
                                                        }
                                                    }
                                                    @endphp
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-check mt-3">
                                                                <input class="form-check-input filtroCorretora" {{ $controle }} type="checkbox" value="{{ $linha->id }}" id="corretora{{ $linha->id }}">
                                                                <label class="form-check-label" for="corretora{{ $linha->id }}"> {{ $linha->nome }} </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                <div class="row mt-3">
                                                    <div class="col-md-12" align='center'>
                                                        <button type="button" onclick="executarFiltro()" class='btn btn-primary btn-sm'>Filtrar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div style='display: flex'>
                                Tipo de Conta
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow show" data-bs-toggle="dropdown" aria-expanded="true">
                                        <i class="mdi mdi-menu-down"></i>
                                    </button>
                                    <div class="dropdown-menu" data-popper-placement="bottom-end">
                                        <div class="card">
                                            <div class="card-body">
                                                <h6 class="card-title">Filtro</h6>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-check mt-3">
                                                            @php
                                                            $controle = "";
                                                            if($filtroTipoConta){
                                                                foreach($filtroTipoConta as $linha){
                                                                    if($linha == 'Demo'){
                                                                        $controle = "checked";
                                                                    }
                                                                }
                                                            }
                                                            @endphp
                                                            <input class="form-check-input filtroTipoConta" {{ $controle }} type="checkbox" value="Demo" id="tipoContaDemo">
                                                            <label class="form-check-label" for="tipoContaDemo"> Demo </label>
                                                        </div>
                                                        </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-check mt-3">
                                                            @php
                                                            $controle = "";
                                                            if($filtroTipoConta){
                                                                foreach($filtroTipoConta as $linha){
                                                                    if($linha == 'Real'){
                                                                        $controle = "checked";
                                                                    }
                                                                }
                                                            }
                                                            @endphp
                                                            <input class="form-check-input filtroTipoConta" {{ $controle }} type="checkbox" value="Real" id="tipoContaReal">
                                                            <label class="form-check-label" for="tipoContaReal"> Real </label>
                                                        </div>
                                                        </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-md-12" align='center'>
                                                        <button type="button" onclick="executarFiltro()" class='btn btn-primary btn-sm'>Filtrar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div style='display: flex'>
                                Contas
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow show" data-bs-toggle="dropdown" aria-expanded="true">
                                        <i class="mdi mdi-menu-down"></i>
                                    </button>
                                    <div class="dropdown-menu" data-popper-placement="bottom-end">
                                        <div class="card">
                                            <div class="card-body">
                                                <h6 class="card-title">Filtro</h6>
                                                @foreach($contas as $conta)
                                                    @php
                                                    $controle = "";
                                                    if($filtroConta){
                                                        foreach($filtroConta as $row){
                                                            if($row == $conta->id){
                                                                $controle = "checked";
                                                            }
                                                        }
                                                    }
                                                    @endphp
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-check mt-3">
                                                                <input class="form-check-input filtroConta" {{ $controle }} type="checkbox" value="{{ $conta->id }}" id="conta{{ $conta->id }}">
                                                                <label class="form-check-label" for="conta{{ $conta->id }}"> {{ $conta->nrConta }} - {{ $conta->nmConta }} </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                <div class="row mt-3">
                                                    <div class="col-md-12" align='center'>
                                                        <button type="button" onclick="executarFiltro()" class='btn btn-primary btn-sm'>Filtrar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div style='display: flex'>
                                Ativos
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow show" data-bs-toggle="dropdown" aria-expanded="true">
                                        <i class="mdi mdi-menu-down"></i>
                                    </button>
                                    <div class="dropdown-menu" data-popper-placement="bottom-end">
                                        <div class="card">
                                            <div class="card-body">
                                                <h6 class="card-title">Filtro</h6>
                                                @foreach($ativos as $linha)
                                                    @php
                                                    $controle = "";
                                                    if($filtroAtivo){
                                                        foreach($filtroAtivo as $row){
                                                            if($row == $linha->id){
                                                                $controle = "checked";
                                                            }
                                                        }
                                                    }
                                                    @endphp
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-check mt-3">
                                                                <input class="form-check-input filtroAtivo" {{ $controle }} type="checkbox" value="{{ $linha->id }}" id="ativo{{ $linha->id }}">
                                                                <label class="form-check-label" for="ativo{{ $linha->id }}"> {{ $linha->nome }} </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                <div class="row mt-3">
                                                    <div class="col-md-12" align='center'>
                                                        <button type="button" onclick="executarFiltro()" class='btn btn-primary btn-sm'>Filtrar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div style='display: flex'>
                                Tipo Ativo
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow show" data-bs-toggle="dropdown" aria-expanded="true">
                                        <i class="mdi mdi-menu-down"></i>
                                    </button>
                                    <div class="dropdown-menu" data-popper-placement="bottom-end">
                                        <div class="card">
                                            <div class="card-body">
                                                <h6 class="card-title">Filtro</h6>
                                                @php
                                                $arrayTipos = ['Índices','CFDs','Ações','Forex','Cryptos','Financeiros','ADRs','BDRs','ETFs','Fundos','Energéticos','Metais','Grãos','Carne','Softs'];
                                                $i = 0;
                                                @endphp
                                                @foreach($arrayTipos as $tp)
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-check mt-3">
                                                                @php
                                                                $i++;
                                                                $controle = "";
                                                                if($filtroTipoAtivo){
                                                                    foreach($filtroTipoAtivo as $linha){
                                                                        if($linha == $tp){
                                                                            $controle = "checked";
                                                                        }
                                                                    }
                                                                }
                                                                @endphp
                                                                <input class="form-check-input filtroTipoAtivo" {{ $controle }} type="checkbox" value="{{ $tp }}" id="tipoAtivo{{ $i }}">
                                                                <label class="form-check-label" for="tipoAtivo{{ $i }}"> {{ $tp }} </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                <div class="row mt-3">
                                                    <div class="col-md-12" align='center'>
                                                        <button type="button" onclick="executarFiltro()" class='btn btn-primary btn-sm'>Filtrar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div style='display: flex'>
                                Operação
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow show" data-bs-toggle="dropdown" aria-expanded="true">
                                        <i class="mdi mdi-menu-down"></i>
                                    </button>
                                    <div class="dropdown-menu" data-popper-placement="bottom-end">
                                        <div class="card">
                                            <div class="card-body">
                                                <h6 class="card-title">Filtro</h6>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        @php
                                                        $controle = "";
                                                        if($filtroOperacao){
                                                            foreach($filtroOperacao as $linha){
                                                                if($linha == 'Compra'){
                                                                    $controle = "checked";
                                                                }
                                                            }
                                                        }
                                                        @endphp
                                                        <div class="form-check mt-3">
                                                            <input class="form-check-input filtroOperacao" {{ $controle }} type="checkbox" value="Compra" id="operacaoCompra">
                                                            <label class="form-check-label" for="operacaoCompra"> Compra </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        @php
                                                        $controle = "";
                                                        if($filtroOperacao){
                                                            foreach($filtroOperacao as $linha){
                                                                if($linha == 'Venda'){
                                                                    $controle = "checked";
                                                                }
                                                            }
                                                        }
                                                        @endphp
                                                        <div class="form-check mt-3">
                                                            <input class="form-check-input filtroOperacao" {{ $controle }} type="checkbox" value="Venda" id="operacaoVenda">
                                                            <label class="form-check-label" for="operacaoVenda"> Venda </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        @php
                                                        $controle = "";
                                                        if($filtroOperacao){
                                                            foreach($filtroOperacao as $linha){
                                                                if($linha == 'Hedge Comprado'){
                                                                    $controle = "checked";
                                                                }
                                                            }
                                                        }
                                                        @endphp
                                                        <div class="form-check mt-3">
                                                            <input class="form-check-input filtroOperacao" {{ $controle }} type="checkbox" value="Hedge Comprado" id="operacaoHedgeComprado">
                                                            <label class="form-check-label" for="operacaoHedgeComprado"> Hedge Comprado </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        @php
                                                        $controle = "";
                                                        if($filtroOperacao){
                                                            foreach($filtroOperacao as $linha){
                                                                if($linha == 'Hedge Vendido'){
                                                                    $controle = "checked";
                                                                }
                                                            }
                                                        }
                                                        @endphp
                                                        <div class="form-check mt-3">
                                                            <input class="form-check-input filtroOperacao" {{ $controle }} type="checkbox" value="Hedge Vendido" id="operacaoHedgeVendido">
                                                            <label class="form-check-label" for="operacaoHedgeVendido"> Hedge Vendido </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-md-12" align='center'>
                                                        <button type="button" onclick="executarFiltro()" class='btn btn-primary btn-sm'>Filtrar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div style='display: flex'>
                                Direção
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow show" data-bs-toggle="dropdown" aria-expanded="true">
                                        <i class="mdi mdi-menu-down"></i>
                                    </button>
                                    <div class="dropdown-menu" data-popper-placement="bottom-end">
                                        <div class="card">
                                            <div class="card-body">
                                                <h6 class="card-title">Filtro</h6>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        @php
                                                        $controle = "";
                                                        if($filtroDirecao){
                                                            foreach($filtroDirecao as $linha){
                                                                if($linha == 'Tendência'){
                                                                    $controle = "checked";
                                                                }
                                                            }
                                                        }
                                                        @endphp
                                                        <div class="form-check mt-3">
                                                            <input class="form-check-input filtroDirecao" {{ $controle }} type="checkbox" value="Tendência" id="direcaoTendencia">
                                                            <label class="form-check-label" for="direcaoTendencia"> Tendência </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        @php
                                                        $controle = "";
                                                        if($filtroDirecao){
                                                            foreach($filtroDirecao as $linha){
                                                                if($linha == 'Contra-tendência'){
                                                                    $controle = "checked";
                                                                }
                                                            }
                                                        }
                                                        @endphp
                                                        <div class="form-check mt-3">
                                                            <input class="form-check-input filtroDirecao" {{ $controle }} type="checkbox" value="Contra-tendência" id="direcaoContraTendencia">
                                                            <label class="form-check-label" for="direcaoContraTendencia"> Contra-tendência </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        @php
                                                        $controle = "";
                                                        if($filtroDirecao){
                                                            foreach($filtroDirecao as $linha){
                                                                if($linha == 'Divergência'){
                                                                    $controle = "checked";
                                                                }
                                                            }
                                                        }
                                                        @endphp
                                                        <div class="form-check mt-3">
                                                            <input class="form-check-input filtroDirecao" {{ $controle }} type="checkbox" value="Divergência" id="direcaoDivergencia">
                                                            <label class="form-check-label" for="direcaoDivergencia"> Divergência </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-md-12" align='center'>
                                                        <button type="button" onclick="executarFiltro()" class='btn btn-primary btn-sm'>Filtrar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div style='display: flex'>
                                Fase
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow show" data-bs-toggle="dropdown" aria-expanded="true">
                                        <i class="mdi mdi-menu-down"></i>
                                    </button>
                                    <div class="dropdown-menu" data-popper-placement="bottom-end">
                                        <div class="card">
                                            <div class="card-body">
                                                <h6 class="card-title">Filtro</h6>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        @php
                                                        $controle = "";
                                                        if($filtroFase){
                                                            foreach($filtroFase as $linha){
                                                                if($linha == 'Fase 01'){
                                                                    $controle = "checked";
                                                                }
                                                            }
                                                        }
                                                        @endphp
                                                        <div class="form-check mt-3">
                                                            <input class="form-check-input filtroFase" {{ $controle }} type="checkbox" value="Fase 01" id="fase01">
                                                            <label class="form-check-label" for="fase01"> Fase 01 </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        @php
                                                        $controle = "";
                                                        if($filtroFase){
                                                            foreach($filtroFase as $linha){
                                                                if($linha == 'Fase 02'){
                                                                    $controle = "checked";
                                                                }
                                                            }
                                                        }
                                                        @endphp
                                                        <div class="form-check mt-3">
                                                            <input class="form-check-input filtroFase" {{ $controle }} type="checkbox" value="Fase 02" id="fase02">
                                                            <label class="form-check-label" for="fase02"> Fase 02 </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        @php
                                                        $controle = "";
                                                        if($filtroFase){
                                                            foreach($filtroFase as $linha){
                                                                if($linha == 'Fase 03'){
                                                                    $controle = "checked";
                                                                }
                                                            }
                                                        }
                                                        @endphp
                                                        <div class="form-check mt-3">
                                                            <input class="form-check-input filtroFase" {{ $controle }} type="checkbox" value="Fase 03" id="fase03">
                                                            <label class="form-check-label" for="fase03"> Fase 03 </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        @php
                                                        $controle = "";
                                                        if($filtroFase){
                                                            foreach($filtroFase as $linha){
                                                                if($linha == 'Fase 04'){
                                                                    $controle = "checked";
                                                                }
                                                            }
                                                        }
                                                        @endphp
                                                        <div class="form-check mt-3">
                                                            <input class="form-check-input filtroFase" {{ $controle }} type="checkbox" value="Fase 04" id="fase04">
                                                            <label class="form-check-label" for="fase04"> Fase 04 </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        @php
                                                        $controle = "";
                                                        if($filtroFase){
                                                            foreach($filtroFase as $linha){
                                                                if($linha == 'Fase 05'){
                                                                    $controle = "checked";
                                                                }
                                                            }
                                                        }
                                                        @endphp
                                                        <div class="form-check mt-3">
                                                            <input class="form-check-input filtroFase" {{ $controle }} type="checkbox" value="Fase 05" id="fase05">
                                                            <label class="form-check-label" for="fase05"> Fase 05 </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        @php
                                                        $controle = "";
                                                        if($filtroFase){
                                                            foreach($filtroFase as $linha){
                                                                if($linha == 'Fase 05'){
                                                                    $controle = "checked";
                                                                }
                                                            }
                                                        }
                                                        @endphp
                                                        <div class="form-check mt-3">
                                                            <input class="form-check-input filtroFase" {{ $controle }} type="checkbox" value="Fase 06" id="fase06">
                                                            <label class="form-check-label" for="fase06"> Fase 06 </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-md-12" align='center'>
                                                        <button type="button" onclick="executarFiltro()" class='btn btn-primary btn-sm'>Filtrar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div style='display: flex'>
                                Moeda
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow show" data-bs-toggle="dropdown" aria-expanded="true">
                                        <i class="mdi mdi-menu-down"></i>
                                    </button>
                                    <div class="dropdown-menu" data-popper-placement="bottom-end">
                                        <div class="card">
                                            <div class="card-body">
                                                <h6 class="card-title">Filtro</h6>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        @php
                                                        $controle = "";
                                                        if($filtroMoeda){
                                                            foreach($filtroMoeda as $linha){
                                                                if($linha == 'BRL'){
                                                                    $controle = "checked";
                                                                }
                                                            }
                                                        }
                                                        @endphp
                                                        <div class="form-check mt-3">
                                                            <input class="form-check-input filtroMoeda" {{ $controle }} type="checkbox" value="BRL" id="moedaBRL">
                                                            <label class="form-check-label" for="moedaBRL"> BRL </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        @php
                                                        $controle = "";
                                                        if($filtroMoeda){
                                                            foreach($filtroMoeda as $linha){
                                                                if($linha == 'USD'){
                                                                    $controle = "checked";
                                                                }
                                                            }
                                                        }
                                                        @endphp
                                                        <div class="form-check mt-3">
                                                            <input class="form-check-input filtroMoeda" {{ $controle }} type="checkbox" value="USD" id="moedaUSD">
                                                            <label class="form-check-label" for="moedaUSD"> USD </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        @php
                                                        $controle = "";
                                                        if($filtroMoeda){
                                                            foreach($filtroMoeda as $linha){
                                                                if($linha == 'EUR'){
                                                                    $controle = "checked";
                                                                }
                                                            }
                                                        }
                                                        @endphp
                                                        <div class="form-check mt-3">
                                                            <input class="form-check-input filtroMoeda" {{ $controle }} type="checkbox" value="EUR" id="moedaEUR">
                                                            <label class="form-check-label" for="moedaEUR"> EUR </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        @php
                                                        $controle = "";
                                                        if($filtroMoeda){
                                                            foreach($filtroMoeda as $linha){
                                                                if($linha == 'GBP'){
                                                                    $controle = "checked";
                                                                }
                                                            }
                                                        }
                                                        @endphp
                                                        <div class="form-check mt-3">
                                                            <input class="form-check-input filtroMoeda" {{ $controle }} type="checkbox" value="GBP" id="moedaGBP">
                                                            <label class="form-check-label" for="moedaGBP"> GBP </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        @php
                                                        $controle = "";
                                                        if($filtroMoeda){
                                                            foreach($filtroMoeda as $linha){
                                                                if($linha == 'JPY'){
                                                                    $controle = "checked";
                                                                }
                                                            }
                                                        }
                                                        @endphp
                                                        <div class="form-check mt-3">
                                                            <input class="form-check-input filtroMoeda" {{ $controle }} type="checkbox" value="JPY" id="moedaJPY">
                                                            <label class="form-check-label" for="moedaJPY"> JPY </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-md-12" align='center'>
                                                        <button type="button" onclick="executarFiltro()" class='btn btn-primary btn-sm'>Filtrar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div style='display: flex'>
                                Tipo<br>Custo
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow show" data-bs-toggle="dropdown" aria-expanded="true">
                                        <i class="mdi mdi-menu-down"></i>
                                    </button>
                                    <div class="dropdown-menu" data-popper-placement="bottom-end">
                                        <div class="card">
                                            <div class="card-body">
                                                <h6 class="card-title">Filtro</h6>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        @php
                                                        $controle = "";
                                                        if($filtroTipoCusto){
                                                            foreach($filtroTipoCusto as $linha){
                                                                if($linha == 'Spread'){
                                                                    $controle = "checked";
                                                                }
                                                            }
                                                        }
                                                        @endphp
                                                        <div class="form-check mt-3">
                                                            <input class="form-check-input filtroTipoCusto" {{ $controle }} type="checkbox" value="Spread" id="tipoCustoSpread">
                                                            <label class="form-check-label" for="tipoCustoSpread"> Spread </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        @php
                                                        $controle = "";
                                                        if($filtroTipoCusto){
                                                            foreach($filtroTipoCusto as $linha){
                                                                if($linha == 'Valor Fixo'){
                                                                    $controle = "checked";
                                                                }
                                                            }
                                                        }
                                                        @endphp
                                                        <div class="form-check mt-3">
                                                            <input class="form-check-input filtroTipoCusto" {{ $controle }} type="checkbox" value="Valor Fixo" id="tipoCustoValorFixo">
                                                            <label class="form-check-label" for="tipoCustoValorFixo"> Valor Fixo </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        @php
                                                        $controle = "";
                                                        if($filtroTipoCusto){
                                                            foreach($filtroTipoCusto as $linha){
                                                                if($linha == 'Percentual'){
                                                                    $controle = "checked";
                                                                }
                                                            }
                                                        }
                                                        @endphp
                                                        <div class="form-check mt-3">
                                                            <input class="form-check-input filtroTipoCusto" {{ $controle }} type="checkbox" value="Percentual" id="tipoCustoPercentual">
                                                            <label class="form-check-label" for="tipoCustoPercentual"> Percentual </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-md-12" align='center'>
                                                        <button type="button" onclick="executarFiltro()" class='btn btn-primary btn-sm'>Filtrar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div style='display: flex'>
                                Resultado
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow show" data-bs-toggle="dropdown" aria-expanded="true">
                                        <i class="mdi mdi-menu-down"></i>
                                    </button>
                                    <div class="dropdown-menu" data-popper-placement="bottom-end">
                                        <div class="card">
                                            <div class="card-body">
                                                <h6 class="card-title">Filtro</h6>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-check mt-3">
                                                            @php
                                                            $controle = "";
                                                            if($filtroResultado){
                                                                foreach($filtroResultado as $linha){
                                                                    if($linha == 'Gain'){
                                                                        $controle = "checked";
                                                                    }
                                                                }
                                                            }
                                                            @endphp
                                                            <input class="form-check-input filtroResultado" {{ $controle }} type="checkbox" value="Gain" id="resultadoGain">
                                                            <label class="form-check-label" for="resultadoGain"> Gain </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-check mt-3">
                                                            @php
                                                            $controle = "";
                                                            if($filtroResultado){
                                                                foreach($filtroResultado as $linha){
                                                                    if($linha == 'Loss'){
                                                                        $controle = "checked";
                                                                    }
                                                                }
                                                            }
                                                            @endphp
                                                            <input class="form-check-input filtroResultado" {{ $controle }} type="checkbox" value="Loss" id="resultadoLoss">
                                                            <label class="form-check-label" for="resultadoLoss"> Loss </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-check mt-3">
                                                            @php
                                                            $controle = "";
                                                            if($filtroResultado){
                                                                foreach($filtroResultado as $linha){
                                                                    if($linha == '0 x 0'){
                                                                        $controle = "checked";
                                                                    }
                                                                }
                                                            }
                                                            @endphp
                                                            <input class="form-check-input filtroResultado" {{ $controle }} type="checkbox" value="0 x 0" id="resultadoEmpate">
                                                            <label class="form-check-label" for="resultadoEmpate"> 0 x 0 </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-md-12" align='center'>
                                                        <button type="button" onclick="executarFiltro()" class='btn btn-primary btn-sm'>Filtrar</button>
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
                            @if($aluno->dtEntradaInc)
                                De: {{ dataDbForm($aluno->dtEntradaInc) }} <br>
                            @endif
                            @if($aluno->dtEntradaFn)
                                Até: {{ dataDbForm($aluno->dtEntradaFn) }} <br>
                            @endif
                        </th>
                        <th>
                            @if($aluno->dtSaidaInc)
                                De: {{ dataDbForm($aluno->dtSaidaInc) }} <br>
                            @endif
                            @if($aluno->dtSaidaFn)
                                Até: {{ dataDbForm($aluno->dtSaidaFn) }} <br>
                            @endif
                        </th>
                        <th>
                            @if($aluno->filtroTipoOperacao)
                                {{ str_replace(',', ', ',$aluno->filtroTipoOperacao) }}
                            @endif
                        </th>
                        <th>
                            @if($aluno->filtroPais)
                                {{ str_replace(',', ', ',$aluno->filtroPais) }}
                            @endif
                        </th>
                        <th>
                            @if($aluno->filtroCorretora)
                                {{ $stringCorretoras }}
                            @endif
                        </th>
                        <th>
                            @if($aluno->filtroTipoConta)
                                {{ str_replace(',', ', ',$aluno->filtroTipoConta) }}
                            @endif
                        </th>
                        <th>
                            @if($aluno->filtroConta)
                                {{ $stringContas }}
                            @endif
                        </th>
                        <th>
                            @if($aluno->filtroAtivo)
                                {{ $stringAtivos }}
                            @endif
                        </th>
                        <th>
                            @if($aluno->filtroTipoAtivo)
                                {{ str_replace(',', ', ',$aluno->filtroTipoAtivo) }}
                            @endif
                        </th>
                        <th>
                            @if($aluno->filtroOperacao)
                                {{ str_replace(',', ', ',$aluno->filtroOperacao) }}
                            @endif
                        </th>
                        <th>
                            @if($aluno->filtroDirecao)
                                {{ str_replace(',', ', ',$aluno->filtroDirecao) }}
                            @endif
                        </th>
                        <th>
                            @if($aluno->filtroFase)
                                {{ str_replace(',', ', ',$aluno->filtroFase) }}
                            @endif
                        </th>
                        <th>
                            @if($aluno->filtroMoeda)
                                {{ str_replace(',', ', ',$aluno->filtroMoeda) }}
                            @endif
                        </th>
                        <th>
                            @if($aluno->filtroTipoCusto)
                                {{ str_replace(',', ', ',$aluno->filtroTipoCusto) }}
                            @endif
                        </th>
                        <th>
                            @if($aluno->filtroResultado)
                                {{ str_replace(',', ', ',$aluno->filtroResultado) }}
                            @endif
                        </th>
                    </tr>
                </table>
            </div>
        </div>

    </form>
    <div class="card mt-3">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <h5 class="card-title">Trades</h5>
                </div>
                <div class="col-md-6" align='right'>
                    <div class="col-md-6">
                        <button type="button" class='btn btn-sm btn-primary' id='botaoAdicionarTrade'>Adicionar Trade</button>
                    </div>
                </div>
            </div>
            @if($mensagem = Session::get('mensagem'))
              <div class="alert alert-success alert-dismissible" role="alert">
                {{ $mensagem }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table-trades table " id="table-index">
                            <thead>
                                <tr>
                                    <td>Numero</td>
                                    <td>Entrada</td>
                                    <td>Saída</td>
                                    <td>Tempo</td>
                                    <td>Status</td>
                                    <td>Tipo</td>
                                    <td>Pais</td>
                                    <td>Corretora</td>
                                    <td>Tipo Conta</td>
                                    <td>Conta</td>
                                    <td>Ativo</td>
                                    <td>Tipo Ativo</td>
                                    <td>Operação</td>
                                    <td>Direção</td>
                                    <td>Fase</td>
                                    <td>Qt Contratos</td>
                                    <td>Moeda</td>
                                    <td>Valor Ponto Por Contrato</td>
                                    <td>Tipo Custo</td>
                                    <td>Custo Entrada por Contrato</td>
                                    <td>Custo Saída por Contrato</td>
                                    <td>Preço &nbspEntrada&nbsp</td>
                                    <td>Custo Entrada</td>
                                    <td>Preço &nbsp&nbspSaída&nbsp&nbsp</td>
                                    <td>Custo Saída</td>
                                    <td>Resultado Posição Pontos</td>
                                    <td>Resultado Posição Financeiro</td>
                                    <td>Resultado Contrato Pontos</td>
                                    <td>Resultado Contrato Financeiro</td>
                                    <td>Variação Entrada Saída</td>
                                    {{-- <th>Resultado Operação Capital</th> --}}
                                    <td>Gain ou Loss</td>
                                    {{-- <th>Saúde Conta</th> --}}
                                    {{-- <th>Validador</th> --}}
                                    <td>Motivos Entrada</td>
                                    <td>Motivos Saida</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($trades as $trade)
                                @php
                                if($trade->dtHrEntrada){
                                    $var = explode(' ',$trade->dtHrEntrada);
                                    $entrada = dataDbForm($var[0])." ".$var[1];
                                }
                                else{
                                  $entrada = "";
                                }

                                if($trade->dtHrSaida){
                                    $var = explode(' ',$trade->dtHrSaida);
                                    $saida = dataDbForm($var[0])." ".$var[1];
                                }
                                else{
                                  $saida = "";
                                }

                                $variacaoEntradaSaida = '';
                                if($trade->variacaoEntradaSaida){
                                    $variacaoEntradaSaida = $trade->variacaoEntradaSaida."%";
                                }

                                if($trade->gainOrLoss == 'Gain'){
                                    $color = 'green';
                                }
                                elseif($trade->gainOrLoss == 'Loss'){
                                    $color = 'red';
                                }
                                elseif($trade->gainOrLoss == '0 x 0'){
                                    $color = '#b8b814';
                                }
                                else{
                                    $color = '';
                                }

                                $moedaTrade = '';
                                if($trade->moeda == "BRL"){
                                    $moedaTrade = "R$";
                                }
                                elseif($trade->moeda == "USD"){
                                    $moedaTrade = "US$";
                                }
                                elseif($trade->moeda == "EUR"){
                                    $moedaTrade = "€";
                                }
                                elseif($trade->moeda == "GBP"){
                                    $moedaTrade = "£";
                                }
                                elseif($trade->moeda == "JPY"){
                                    $moedaTrade = "¥$";
                                }

                                if($trade->operacao == "Compra" || $trade->operacao == "Hedge Comprado"){
                                    $corOperacao = "#4472c4";
                                }
                                else{
                                    $corOperacao = "#ff0000";
                                }

                                if($trade->direcao == "Tendência"){
                                    $corDirecao = "#4472c4";
                                }
                                elseif($trade->direcao == "Contra-tendência"){
                                    $corDirecao = "#ff0000";
                                }
                                else{
                                    $corDirecao = "#cf6621";
                                }

                                @endphp
                                    <tr id='linha{{ $trade->id_trade }}' onclick="selecionaTrade({{ $trade->id_trade }})" style='cursor: pointer !important'>
                                        <td>{{ $trade->idOperacao }}</td>
                                        <td>{{ $entrada }}</td>
                                        <td>{{ $saida }}</td>
                                        <td>{{ $trade->tempoOperacao }}</td>
                                        <td>{{ $trade->stOperacao }}</td>
                                        <td>{{ $trade->tipoOperacao }}</td>
                                        <td>{{ $trade->pais }}</td>
                                        <td>{{ $trade->nmCorretora }}</td>
                                        <td>{{ $trade->tipoConta }}</td>
                                        <td>{{ $trade->nmConta }}</td>
                                        <td>{{ $trade->nmAtivo }}</td>
                                        <td>{{ $trade->tipoAtivo }}</td>
                                        <td style='color: {{ $corOperacao }};'>{{ $trade->operacao }}</td>
                                        <td style='color: {{ $corDirecao }};'>{{ $trade->direcao }}</td>
                                        <td>{{ $trade->fase }}</td>
                                        <td>{{ $trade->quantidadeContratos }}</td>
                                        <td>{{ $trade->moeda }}</td>
                                        <td>{{ $moedaTrade." ".valorDbForm($trade->valorPontoContrato) }}</td>
                                        <td>{{ $trade->tipoCusto }}</td>
                                        <td>{{ $moedaTrade." ".valorDbForm($trade->custoOperacaoEntrada) }}</td>
                                        <td>{{ $moedaTrade." ".valorDbForm($trade->custoOperacaoSaida) }}</td>
                                        <td>{{ $moedaTrade." ".valorDbForm($trade->precoEntrada) }}</td>
                                        <td>{{ $moedaTrade." ".valorDbForm($trade->custoEntrada) }}</td>
                                        <td>{{ $moedaTrade." ".valorDbForm($trade->precoSaida) }}</td>
                                        <td>{{ $moedaTrade." ".valorDbForm($trade->custoSaida) }}</td>
                                        <td>{{ $trade->resPosicaoPontos }}</td>
                                        <td>{{ $moedaTrade." ".valorDbForm($trade->resPosicaoFinanceiro) }}</td>
                                        <td>{{ $trade->resContratoPontos }}</td>
                                        <td>{{ $moedaTrade." ".valorDbForm($trade->resContratoFinanceiro) }}</td>
                                        <td>{{ $variacaoEntradaSaida }}</td>
                                        {{-- <td>{{ $trade->resOperacaoCapital }}</td> --}}
                                        <td style='color: {{ $color }};'>{{ $trade->gainOrLoss }}</td>
                                        {{-- <td>{{ $trade->saudeConta }}</td> --}}
                                        {{-- <td>{{ $trade->validador }}</td> --}}
                                        <td>{{ $trade->motivosEntrada }}</td>
                                        <td>{{ $trade->motivosSaida }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
window.addEventListener('load',()=>{
  $('#table-index').DataTable({
    order: [[0, 'desc']],
    "language": {
			"sEmptyTable": "Nenhum registro encontrado",
      "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
      "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
      "sInfoFiltered": "(Filtrados de _MAX_ registros)",
      "sInfoPostFix": "",
      "sInfoThousands": ".",
      "sLengthMenu": "_MENU_ resultados por página",
      "sLoadingRecords": "Carregando...",
      "sProcessing": "Processando...",
      "sZeroRecords": "Nenhum registro encontrado",
      "sSearch": "Pesquisar",
      "oPaginate": {
        "sNext": "Próximo",
        "sPrevious": "Anterior",
        "sFirst": "Primeiro",
        "sLast": "Último"
      },
      "oAria": {
        "sSortAscending": ": Ordenar colunas de forma ascendente",
        "sSortDescending": ": Ordenar colunas de forma descendente"
      }
    }
  });
})

</script>

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

document.getElementById('btnLimparFiltos').addEventListener('click', ()=>{
    window.location.href = "{{ route('aluno.limparFiltros') }}" + '/trades';
})
</script>

<style>
input, select, label{
    font-size: 14px !important;
}
</style>

<!-- Modal de adicionar trade -->
<div class="modal fade" id="modalTrade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <form id='formulario' action="{{ route('aluno.trades.insert') }}" method="post">
          <input type="hidden" name="id_trade" id='modalTrade_id'>
          @csrf
          <div class="modal-header">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <div class="card">
                  <div class="card-body">
                      <h5 class='card-title'>Trade</h5>
                      <div class="row mt-2 gy-4">
                          <div class="col-md-3">
                            <div class="form-floating form-floating-outline">
                              <input required class="form-control" max="{{ date('Y-m-d') }}" type="date" id="dtEntrada" name="dtEntrada" placeholder="Data Entrada"/>
                              <label for="dtEntrada">Data Entrada:</label>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-floating form-floating-outline">
                              <input class="form-control" type="time" id="hrEntrada" name="hrEntrada" placeholder="Hora Entrada"/>
                              <label for="hrEntrada">Hora Entrada:</label>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-floating form-floating-outline">
                              <input class="form-control" max="{{ date('Y-m-d') }}" type="date" id="dtSaida" name="dtSaida" placeholder="Data Saída"/>
                              <label for="dtSaida">Data Saída:</label>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-floating form-floating-outline">
                              <input class="form-control" type="time" id="hrSaida" name="hrSaida" placeholder="Hora Saída"/>
                              <label for="hrSaida">Hora Saída:</label>
                            </div>
                          </div>
                      </div>
                      <div class="row mt-2 gy-4">
                          <div class="col-md-3">
                            <div class="form-floating form-floating-outline">
                              <select id="tipoOperacao" name='tipoOperacao' class="select2 form-select">
                                  <option value="">Opções</option>
                                  <option value="Day Trade">Day Trade</option>
                                  <option value="Hedge">Hedge</option>
                                  <option value="Position">Position</option>
                                  <option value="Scalp">Scalp</option>
                                  <option value="Swing Trade">Swing Trade</option>

                              </select>
                              <label for="tipoOperacao">Tipo de Operação:</label>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-floating form-floating-outline">
                              <select id="modalTrade_id_conta" name='id_conta' onchange="buscaAtivosCorretora()" class="select2 form-select">
                                  <option value="">Opções</option>
                                  @foreach($contas as $linha)
                                      @php
                                      if($linha->moeda == "BRL"){
                                          $moeda = "R$";
                                      }
                                      elseif($linha->moeda == "USD"){
                                          $moeda = "US$";
                                      }
                                      elseif($linha->moeda == "EUR"){
                                          $moeda = "€";
                                      }
                                      elseif($linha->moeda == "GBP"){
                                          $moeda = "£";
                                      }
                                      elseif($linha->moeda == "JPY"){
                                          $moeda = "¥$";
                                      }
                                      @endphp
                                      <option value="{{ $linha->id }}">{{ $linha->nrConta }} - {{ $linha->nmConta." :Moeda ".$moeda }}</option>
                                  @endforeach
                              </select>
                              <label for="id_corretora">Conta Corretora:</label>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-floating form-floating-outline">
                              <select id="id_tipoConta" name='tipoConta' class="select2 form-select">
                                  <option value="">Opções</option>
                                  <option value="Demo">Demo</option>
                                  <option value="Real">Real</option>
                              </select>
                              <label for="id_tipoConta">Tipo de Conta:</label>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-floating form-floating-outline">
                              <select id="modalTrade_id_ativo" name='id_ativo' class="select2 form-select">
                                  <option value="">Opções</option>
                              </select>
                              <label for="id_tipoConta">Ativo:</label>
                            </div>
                          </div>
                      </div>
                      <div class="row mt-2 gy-4">
                          <div class="col-md-3">
                            <div class="form-floating form-floating-outline">
                              <select id="operacao" name='operacao' class="select2 form-select">
                                  <option value="">Opções</option>
                                  <option value="Compra">Compra</option>
                                  <option value="Venda">Venda</option>
                                  <option value="Hedge Comprado">Hedge Comprado</option>
                                  <option value="Hedge Vendido">Hedge Vendido</option>
                              </select>
                              <label for="operacao">Operação:</label>
                            </div>
                          </div>
                        <div class="col-md-3">
                          <div class="form-floating form-floating-outline">
                            <select id="direcao" name='direcao' class="select2 form-select">
                                <option value="">Opções</option>
                                <option value="Tendência">Tendência</option>
                                <option value="Contra-tendência">Contra-tendência</option>
                                <option value="Divergência">Divergência</option>
                            </select>
                            <label for="direcao">Direção:</label>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-floating form-floating-outline">
                            <select id="fase" name='fase' class="select2 form-select">
                                <option value="">Opções</option>
                                <option value="Fase 01">Fase 01</option>
                                <option value="Fase 02">Fase 02</option>
                                <option value="Fase 03">Fase 03</option>
                                <option value="Fase 04">Fase 04</option>
                                <option value="Fase 05">Fase 05</option>
                            </select>
                            <label for="fase">Fase:</label>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-floating form-floating-outline">
                                <input class="form-control" type="number" id="quantidadeContratos" name="quantidadeContratos" placeholder="Qtd. Contratos" pattern="[0-9]+([,\.][0-9]+)?" min="0" step="any"/>
                            <label for="quantidadeContratos">Qtd. Contratos:</label>
                          </div>
                        </div>
                      </div>
                      <div class="row mt-2 gy-4">
                          <div class="col-md-3">
                            <div class="form-floating form-floating-outline">
                              <input class="form-control" type="number" id="valorPontoContrato" name="valorPontoContrato" placeholder="Valor Por Ponto, por Contrato" pattern="[0-9]+([,\.][0-9]+)?" min="0" step="any"/>
                              <label for="valorPontoContrato">Valor Por Ponto, por Contrato:</label>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-floating form-floating-outline">
                              <select id="tipoCusto" name='tipoCusto' class="select2 form-select">
                                  <option value="">Opções</option>
                                  <option value="Spread">Spread</option>
                                  <option value="Valor Fixo">Valor Fixo</option>
                                  <option value="Percentual">Percentual</option>
                              </select>
                              <label for="tipoCusto">Tipo de Custo:</label>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-floating form-floating-outline">
                              <input class="form-control" type="text" id="custoOperacaoEntrada" name="custoOperacaoEntrada" placeholder="Valor (Spread / Fixo / %) Entrada:" pattern="[0-9]+([,\.][0-9]+)?" min="0" step="any"/>
                              <label for="custoOperacaoEntrada">Valor (Spread / Fixo / %) Entrada:</label>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-floating form-floating-outline">
                              <input class="form-control" type="text" id="custoOperacaoSaida" name="custoOperacaoSaida" placeholder="Valor (Spread / Fixo / %) Saída:" pattern="[0-9]+([,\.][0-9]+)?" min="0" step="any"/>
                              <label for="custoOperacaoSaida">Valor (Spread / Fixo / %) Saída:</label>
                            </div>
                          </div>
                      </div>
                      <div class="row mt-2 gy-4">
                          <div class="col-md-3">
                            <div class="form-floating form-floating-outline">
                              <input class="form-control" type="text" id="precoEntrada" name="precoEntrada" placeholder="Preço de Entrada" pattern="[0-9]+([,\.][0-9]+)?" min="0" step="any"/>
                              <label for="precoEntrada">Preço de Entrada:</label>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-floating form-floating-outline">
                              <input class="form-control" type="text" id="precoSaida" name="precoSaida" placeholder="Preço de Saída" pattern="[0-9]+([,\.][0-9]+)?" min="0" step="any"/>
                              <label for="precoSaida">Preço de Saída:</label>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-floating form-floating-outline mb-4">
                              <textarea class="form-control h-px-100" id="motivosEntrada" name='motivosEntrada' placeholder="Alguma observação pertinente ..."></textarea>
                              <label for="motivosEntrada">Motivos Entrada:</label>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-floating form-floating-outline mb-4">
                              <textarea class="form-control h-px-100" id="motivosSaida" name='motivosSaida' placeholder="Alguma observação pertinente ..."></textarea>
                              <label for="motivosSaida">Motivos Saída:</label>
                            </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="row mt-3">
                  <div class="col-md-6">
                      <button type="submit" class="btn btn-primary">Salvar</button>
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                  </div>
                  <div class="col-md-6" align='right' id='divFooterModal'>

                  </div>
              </div>
          </div>
      </form>
    </div>
  </div>
</div>

<script>
document.getElementById('dtEntrada').addEventListener('blur', (e)=>{
    if(e.target.value != ""){
        document.getElementById('dtSaida').setAttribute('min',e.target.value);
    }
    else{
        document.getElementById('dtSaida').removeAttribute('min');
    }
});

document.getElementById('dtSaida').addEventListener('blur', (e)=>{
    if(e.target.value != ""){
        dataEntrada = new Date(document.getElementById('dtEntrada').value);
        dataSaida = new Date(e.target.value);
        if(dataSaida <= dataEntrada && document.getElementById('hrEntrada').value != ""){
            document.getElementById('hrSaida').setAttribute('min', document.getElementById('hrEntrada').value);
        }
        else{
            document.getElementById('hrSaida').removeAttribute('min');
        }
    }
    else{
        document.getElementById('hrSaida').removeAttribute('min');
    }
});


document.getElementById('botaoAdicionarTrade').addEventListener('click', ()=>{
    const myModal = new bootstrap.Modal(document.getElementById('modalTrade'));
    document.getElementById('formulario').action = "{{ route('aluno.trades.insert') }}"
    myModal.show();
})

function selecionaTrade(id_trade){
    const myModal = new bootstrap.Modal(document.getElementById('modalTrade'));
    document.getElementById('formulario').action = "{{ route('aluno.trades.update') }}";
    document.getElementById('modalTrade_id').value = id_trade;

    document.getElementById('divFooterModal').innerHTML = "";

    //vamos criar o botao de excluir a trade
    botao = document.createElement('button');
    botao.innerHTML = "Excluir";
    botao.setAttribute('class', 'btn btn-danger');
    botao.setAttribute('type', 'button');
    botao.setAttribute('onclick', "deleteTrade(" + id_trade + ")");

    document.getElementById('divFooterModal').appendChild(botao);

    $.getJSON(
        "/alunoTradesbuscar/" + id_trade,
        {
            id : id_trade
        },
        function(json){
            document.getElementById('dtEntrada').value = json.dtEntrada;
            document.getElementById('hrEntrada').value = json.hrEntrada;
            document.getElementById('dtSaida').value = json.dtSaida;
            document.getElementById('hrSaida').value = json.hrSaida;
            document.getElementById('tipoOperacao').value = json.tipoOperacao;
            document.getElementById('modalTrade_id_conta').value = json.id_conta;
            document.getElementById('id_tipoConta').value = json.tipoConta;
            document.getElementById('modalTrade_id_ativo').innerHTML = json.ativoHtml;
            document.getElementById('operacao').value = json.operacao;
            document.getElementById('direcao').value = json.direcao;
            document.getElementById('fase').value = json.fase;
            document.getElementById('quantidadeContratos').value = json.quantidadeContratos;
            document.getElementById('valorPontoContrato').value = json.valorPontoContrato;
            document.getElementById('tipoCusto').value = json.tipoCusto;
            document.getElementById('custoOperacaoEntrada').value = json.custoOperacaoEntrada;
            document.getElementById('custoOperacaoSaida').value = json.custoOperacaoSaida;
            document.getElementById('precoEntrada').value = json.precoEntrada;
            document.getElementById('precoSaida').value = json.precoSaida;
            document.getElementById('motivosEntrada').value = json.motivosEntrada;
            document.getElementById('motivosSaida').value = json.motivosSaida;
        }
    );
    myModal.show();
}

function deleteTrade(id_trade){
    if(confirm('Tem certeza que deseja excluir a trade?')){
        window.location.href = "{{ route('aluno.trades.delete') }}/" + id_trade;
    }
}

function buscaAtivosCorretora(){
    if(document.getElementById('modalTrade_id_conta').value != ""){
        $.getJSON(
            "{{ route('aluno.trade.buscaAtivosCorretora') }}",
            {
                id_conta : document.getElementById('modalTrade_id_conta').value
            },
            function(json){
                document.getElementById('modalTrade_id_ativo').innerHTML = json.html;
            }
        );
    }
    else{
        document.getElementById('modalTrade_id_ativo').innerHTML = "<option value=''>Opções</option>";
    }
}
</script>

@endsection
