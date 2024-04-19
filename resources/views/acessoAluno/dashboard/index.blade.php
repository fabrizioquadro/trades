@extends('layoutAluno')

@section('conteudo')
@php
if($aluno->moedaBase == "BRL"){
    $multiplicador = 'cotacaoBRL';
    $moedaBase = "R$";
}
elseif($aluno->moedaBase == "USD"){
    $multiplicador = 'cotacaoUSD';
    $moedaBase = "US$";
}
elseif($aluno->moedaBase == "EUR"){
    $multiplicador = 'cotacaoEUR';
    $moedaBase = "€";
}
elseif($aluno->moedaBase == "GBP"){
    $multiplicador = 'cotacaoGBP';
    $moedaBase = "£";
}
elseif($aluno->moedaBase == "JPY"){
    $multiplicador = 'cotacaoJPY';
    $moedaBase = "¥$";
}
@endphp
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

.table-trades th{
    font-size: 10px !important;
}

.table-trades td{
    font-size: 10px !important;
}

.fontSize12{
    font-size: 18px !important;
}

.fontSize25{
    font-size: 25px !important;
}

</style>
-->
<style>
    .dropdown-menu{
        z-index: 10000000;
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
    <form id='formularioPesquisa' action="{{ route('aluno.dashboard') }}" method="post">
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
                                        <div class="dropdown" style>
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
                                {{--
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
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-check mt-3">
                                                                    @php
                                                                    $controle = "";
                                                                    if($filtroTipoAtivo){
                                                                        foreach($filtroTipoAtivo as $linha){
                                                                            if($linha == 'Micro E-mini Futures'){
                                                                                $controle = "checked";
                                                                            }
                                                                        }
                                                                    }
                                                                    @endphp
                                                                    <input class="form-check-input filtroTipoAtivo" {{ $controle }} type="checkbox" value="Micro E-mini Futures" id="tipoAtivoMicro">
                                                                    <label class="form-check-label" for="tipoAtivoMicro"> Micro E-mini Futures </label>
                                                                </div>
                                                                </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-check mt-3">
                                                                    @php
                                                                    $controle = "";
                                                                    if($filtroTipoAtivo){
                                                                        foreach($filtroTipoAtivo as $linha){
                                                                            if($linha == 'Stock Index'){
                                                                                $controle = "checked";
                                                                            }
                                                                        }
                                                                    }
                                                                    @endphp
                                                                    <input class="form-check-input filtroTipoAtivo" {{ $controle }} type="checkbox" value="Stock Index" id="tipoAtivoStock">
                                                                    <label class="form-check-label" for="tipoAtivoStock"> Stock Index </label>
                                                                </div>
                                                                </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-check mt-3">
                                                                    @php
                                                                    $controle = "";
                                                                    if($filtroTipoAtivo){
                                                                        foreach($filtroTipoAtivo as $linha){
                                                                            if($linha == 'Currencies'){
                                                                                $controle = "checked";
                                                                            }
                                                                        }
                                                                    }
                                                                    @endphp
                                                                    <input class="form-check-input filtroTipoAtivo" {{ $controle }} type="checkbox" value="Currencies" id="tipoAtivoCurrencies">
                                                                    <label class="form-check-label" for="tipoAtivoCurrencies"> Currencies </label>
                                                                </div>
                                                                </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-check mt-3">
                                                                    @php
                                                                    $controle = "";
                                                                    if($filtroTipoAtivo){
                                                                        foreach($filtroTipoAtivo as $linha){
                                                                            if($linha == 'Energies'){
                                                                                $controle = "checked";
                                                                            }
                                                                        }
                                                                    }
                                                                    @endphp
                                                                    <input class="form-check-input filtroTipoAtivo" {{ $controle }} type="checkbox" value="Energies" id="tipoAtivoEnergies">
                                                                    <label class="form-check-label" for="tipoAtivoEnergies"> Energies </label>
                                                                </div>
                                                                </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-check mt-3">
                                                                    @php
                                                                    $controle = "";
                                                                    if($filtroTipoAtivo){
                                                                        foreach($filtroTipoAtivo as $linha){
                                                                            if($linha == 'Metals'){
                                                                                $controle = "checked";
                                                                            }
                                                                        }
                                                                    }
                                                                    @endphp
                                                                    <input class="form-check-input filtroTipoAtivo" {{ $controle }} type="checkbox" value="Metals" id="tipoAtivoMetals">
                                                                    <label class="form-check-label" for="tipoAtivoMetals"> Metals </label>
                                                                </div>
                                                                </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-check mt-3">
                                                                    @php
                                                                    $controle = "";
                                                                    if($filtroTipoAtivo){
                                                                        foreach($filtroTipoAtivo as $linha){
                                                                            if($linha == 'Financials'){
                                                                                $controle = "checked";
                                                                            }
                                                                        }
                                                                    }
                                                                    @endphp
                                                                    <input class="form-check-input filtroTipoAtivo" {{ $controle }} type="checkbox" value="Financials" id="tipoAtivoFinancials">
                                                                    <label class="form-check-label" for="tipoAtivoFinancials"> Financials </label>
                                                                </div>
                                                                </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-check mt-3">
                                                                    @php
                                                                    $controle = "";
                                                                    if($filtroTipoAtivo){
                                                                        foreach($filtroTipoAtivo as $linha){
                                                                            if($linha == 'Grains'){
                                                                                $controle = "checked";
                                                                            }
                                                                        }
                                                                    }
                                                                    @endphp
                                                                    <input class="form-check-input filtroTipoAtivo" {{ $controle }} type="checkbox" value="Grains" id="tipoAtivoGrains">
                                                                    <label class="form-check-label" for="tipoAtivoGrains"> Grains </label>
                                                                </div>
                                                                </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-check mt-3">
                                                                    @php
                                                                    $controle = "";
                                                                    if($filtroTipoAtivo){
                                                                        foreach($filtroTipoAtivo as $linha){
                                                                            if($linha == 'Softs'){
                                                                                $controle = "checked";
                                                                            }
                                                                        }
                                                                    }
                                                                    @endphp
                                                                    <input class="form-check-input filtroTipoAtivo" {{ $controle }} type="checkbox" value="Softs" id="tipoAtivoSofts">
                                                                    <label class="form-check-label" for="tipoAtivoSofts"> Softs </label>
                                                                </div>
                                                                </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-check mt-3">
                                                                    @php
                                                                    $controle = "";
                                                                    if($filtroTipoAtivo){
                                                                        foreach($filtroTipoAtivo as $linha){
                                                                            if($linha == 'Meats'){
                                                                                $controle = "checked";
                                                                            }
                                                                        }
                                                                    }
                                                                    @endphp
                                                                    <input class="form-check-input filtroTipoAtivo" {{ $controle }} type="checkbox" value="Meats" id="tipoAtivoMeats">
                                                                    <label class="form-check-label" for="tipoAtivoMeats"> Meats </label>
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
                                --}}
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
    <div class="row">
        <div class="col-lg-4 col-sm-12 mt-3">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between flex-wrap gap-2">
                        <p class="d-block mb-2 text-body fontSize25">Geral</p>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="row mt-3">
                        <div class="col-5">
                            <div class="d-flex gap-2 align-items-center mb-2">
                                <p class="mb-0 fontSize25" style="color: red;">Risk</p>
                            </div>
                            <h4 class="mb-0 pt-1 text-nowrap fontSize12">{{ $resultadosGerais['risk_reward_1'] }}</h4>
                        </div>
                        <div class="col-2">
                            <div class="divider divider-vertical">
                                <div class="divider-text">
                                    <span class="badge-divider-bg bg-label-secondary">VS</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-5 text-end pe-lg-0 pe-xl-2">
                            <div class="d-flex gap-2 justify-content-end align-items-center mb-2">
                                <p class="mb-0 fontSize25" style='color: #4472c4'>Reward</p>
                            </div>
                            <h4 class="mb-0 pt-1 text-nowrap fontSize12">{{ $resultadosGerais['risk_reward_2'] }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-12 mt-3">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between flex-wrap gap-2">
                        <p class="d-block mb-2 text-body fontSize25">Tendência</p>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="row mt-3">
                        <div class="col-5">
                            <div class="d-flex gap-2 align-items-center mb-2">
                                <p class="mb-0 fontSize25" style="color: red;">Risk</p>
                            </div>
                            <h4 class="mb-0 pt-1 text-nowrap fontSize12">{{ $resultadosTendencia['risk_reward_1'] }}</h4>
                        </div>
                        <div class="col-2">
                            <div class="divider divider-vertical">
                                <div class="divider-text">
                                    <span class="badge-divider-bg bg-label-secondary">VS</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-5 text-end pe-lg-0 pe-xl-2">
                            <div class="d-flex gap-2 justify-content-end align-items-center mb-2">
                                <p class="mb-0 fontSize25" style='color: #4472c4'>Reward</p>
                            </div>
                            <h4 class="mb-0 pt-1 text-nowrap fontSize12">{{ $resultadosTendencia['risk_reward_2'] }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-12 mt-3">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between flex-wrap gap-2">
                        <p class="d-block mb-2 text-body fontSize25">Contra-Tendência</p>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="row mt-3">
                        <div class="col-5">
                            <div class="d-flex gap-2 align-items-center mb-2">
                                <p class="mb-0 fontSize25" style="color: red;">Risk</p>
                            </div>
                            <h4 class="mb-0 pt-1 text-nowrap fontSize12">{{ $resultadosContraTendencia['risk_reward_1'] }}</h4>
                        </div>
                        <div class="col-2">
                            <div class="divider divider-vertical">
                                <div class="divider-text">
                                    <span class="badge-divider-bg bg-label-secondary">VS</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-5 text-end pe-lg-0 pe-xl-2">
                            <div class="d-flex gap-2 justify-content-end align-items-center mb-2">
                                <p class="mb-0 fontSize25" style='color: #4472c4'>Reward</p>
                            </div>
                            <h4 class="mb-0 pt-1 text-nowrap fontSize12">{{ $resultadosContraTendencia['risk_reward_2'] }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-sm-6 mt-3">
            <div class="card" style='height: 100% !important'>
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between flex-wrap gap-2">
                        <p class="d-block mb-2 text-body fontSize25">Taxa de Acertos - Geral</p>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div id="txAcertosGeral"></div>
                    <script>
                    var options = {
                        chart: {
                            height: 280,
                            type: "radialBar"
                        },
                        series: [{{ $resultadosGerais['txAcertos'] }}],
                        colors: ["#26c6f9"],
                        plotOptions: {
                            radialBar: {
                                hollow: {
                                    margin: 0,
                                    size: "40%"
                                },
                                dataLabels: {
                                    showOn: "always",
                                    name: {
                                        offsetY: -10,
                                        show: false,
                                        color: "#636578",
                                        fontSize: "13px"
                                    },
                                    value: {
                                        offsetY: 10,
                                        color: "#636578",
                                        fontSize: "30px",
                                        show: true
                                    }
                                }
                            }
                        },
                        stroke: {
                            lineCap: "round",
                        },
                        labels: ["Progress"]
                    };
                    var txAcertosGeral = new ApexCharts(document.querySelector("#txAcertosGeral"), options);
                    txAcertosGeral.render();
                    </script>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 mt-3">
            <div class="card" style='height: 100% !important'>
                <div class="card-body pb-0 pt-3" style='height: 50% !important'>
                    <div class="row d-flex align-items-center">
                        <div class="col-5 col-lg-6 col-xl-5">
                            <div id="txAcertosTendencia"></div>
                            <script>
                            var options = {
                                chart: {
                                    height: 160,
                                    type: "radialBar"
                                },
                                series: [{{ $resultadosTendencia['txAcertos'] }}],
                                colors: ["#26c6f9"],
                                plotOptions: {
                                    radialBar: {
                                        hollow: {
                                            margin: 0,
                                            size: "35%"
                                        },
                                        dataLabels: {
                                            showOn: "always",
                                            name: {
                                                offsetY: -10,
                                                show: false,
                                                color: "#636578",
                                                fontSize: "13px"
                                            },
                                            value: {
                                                offsetY: 5,
                                                color: "#636578",
                                                fontSize: "15px",
                                                show: true
                                            }
                                        }
                                    }
                                },
                                stroke: {
                                    lineCap: "round",
                                },
                                labels: ["Progress"]
                            };
                            var txAcertosTendencia = new ApexCharts(document.querySelector("#txAcertosTendencia"), options);
                            txAcertosTendencia.render();
                            </script>
                        </div>
                        <div class="col-7 col-lg-6 col-xl-7">
                            <div class="card-info">
                                <p class="mb-0 mt-1 text-center fontSize12">Taxa de Acertos<br>Tendência</p>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="my-2" />
                <div class="card-body pb-0 pt-2" style='height: 50% !important'>
                    <div class="row d-flex align-items-center">
                        <div class="col-5 col-lg-6 col-xl-5">
                            <div id="txAcertosContraTendencia"></div>
                            <script>
                            var options = {
                                chart: {
                                    height: 160,
                                    type: "radialBar"
                                },
                                series: [{{ $resultadosContraTendencia['txAcertos'] }}],
                                colors: ["#ff0000"],
                                plotOptions: {
                                    radialBar: {
                                        hollow: {
                                            margin: 0,
                                            size: "35%"
                                        },
                                        dataLabels: {
                                            showOn: "always",
                                            name: {
                                                offsetY: -10,
                                                show: false,
                                                color: "#636578",
                                                fontSize: "13px"
                                            },
                                            value: {
                                                offsetY: 5,
                                                color: "#636578",
                                                fontSize: "15px",
                                                show: true
                                            }
                                        }
                                    }
                                },
                                stroke: {
                                    lineCap: "round",
                                },
                                labels: ["Progress"]
                            };
                            var txAcertosContraTendencia = new ApexCharts(document.querySelector("#txAcertosContraTendencia"), options);
                            txAcertosContraTendencia.render();
                            </script>
                        </div>
                        <div class="col-7 col-lg-6 col-xl-7">
                            <div class="card-info">
                                <p class="mb-0 mt-0 text-center fontSize12">Taxa de Acertos<br>Contra-Tendência</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 mt-3">
            <div class="row" style="height: 100% !important;">
                <div class="col-12" style="height: 48% !important;">
                    <div class="row" style="height: 100% !important;">
                        <div class="col-6" style="height: 100% !important;">
                            <div class="card" style="height: 100% !important;">
                                <div class="card-body p-2" style="height: 100% !important;">
                                    <div class="d-flex justify-content-between align-items-start flex-wrap">
                                        <div class="avatar">
                                            <div class="avatar-initial bg-label-success rounded">
                                                <i class="mdi mdi-currency-usd mdi-24px"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-info mt-3">
                                        <h5 class="mt-1" style='font-size: 20px !important'>{{ $resultadosGerais['moeda']." ".valorDbForm($resultadosGerais['netProfitGrossLoss']) }}</h5>
                                        <p style='font-size: 14px; font-weight: 900'>Net Profit<br>Gross Loss</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6" style="height: 100% !important;">
                            <div class="card" style="height: 100% !important;">
                                <div class="card-body p-2" style="height: 100% !important;">
                                    <div class="d-flex justify-content-between align-items-start flex-wrap">
                                        <div class="avatar">
                                            <div class="avatar-initial bg-label-danger rounded">
                                                <i class="mdi mdi-currency-usd mdi-24px"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-info mt-3">
                                        <h5 class="mt-1" style='font-size: 20px !important'>{{ $resultadosGerais['moeda']." ".valorDbForm($resultadosGerais['despesas']) }}</h5>
                                        <p style='font-size: 14px; font-weight: 900'><br>Despesas</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 align-self-end" style="height: 48% !important;">
                    <div class="row" style="height: 100% !important;">
                        <div class="col-6" style="height: 100% !important;">
                            <div class="card" style="height: 100% !important;">
                                <div class="card-body p-2" style="height: 100% !important;">
                                    <div class="d-flex justify-content-between align-items-start flex-wrap">
                                        <div class="avatar">
                                            <div class="avatar-initial bg-label-success rounded">
                                                <i class="mdi mdi-currency-usd mdi-24px"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-info mt-3">
                                        <h5 class="mt-1" style='font-size: 20px !important'>{{ $resultadosGerais['moeda']." ".valorDbForm($resultadosTendencia['mediaDinheiroPosicaoGain']) }}</h5>
                                        <p style='font-size: 14px; font-weight: 900'>Média Gain<br>Tendência</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6" style="height: 100% !important;">
                            <div class="card" style="height: 100% !important;">
                                <div class="card-body p-2" style="height: 100% !important;">
                                    <div class="d-flex justify-content-between align-items-start flex-wrap">
                                        <div class="avatar">
                                            <div class="avatar-initial bg-label-success rounded">
                                                <i class="mdi mdi-currency-usd mdi-24px"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-info mt-3">
                                        <h5 class="mt-1" style='font-size: 20px !important'>{{ $resultadosGerais['moeda']." ".valorDbForm($resultadosContraTendencia['mediaDinheiroPosicaoGain']) }}</h5>
                                        <p style='font-size: 14px; font-weight: 900'>Média Gain<br>Contra-endência</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-3">
                <div class="card-header header-elements">
                    <div>
                        <p class="d-block mb-2 text-body fontSize25">Gain X Loss X 0x0</p>
                    </div>
                </div>
                <div class="card-body pt-2">
                    <div id="lineChart"></div>
                </div>
                <script>
                const lineChartEl = document.querySelector('#lineChart'),
                lineChartConfig = {
                    chart: {
                        height: 400,
                        fontFamily: 'Inter',
                        type: 'line',
                        parentHeightOffset: 0,
                        zoom: {
                            enabled: false
                        },
                        toolbar: {
                            show: false
                        }
                    },
                    series: [
                        {
                            name: 'Gain',
                            data: [{!! $arrayGraficoLine['gain'] !!}]
                        },
                        {
                            name: 'Loss',
                            data: [{!! $arrayGraficoLine['loss'] !!}]
                        },
                        {
                            name: '0x0',
                            data: [{!! $arrayGraficoLine['empate'] !!}]
                        }
                    ],
                    markers: {
                        strokeWidth: 7,
                        strokeOpacity: 1,
                        strokeColors: ['#ffffff'],
                        colors: ['#ffffff']
                    },
                    legend: {
                        show: true,
                        position: 'bottom',
                        markers: { offsetX: -3 },
                        itemMargin: {
                            vertical: 3,
                            horizontal: 10
                        },
                        labels: {
                            colors: '#cdcdcd',
                            useSeriesColors: false
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        curve: 'straight'
                    },
                    colors: ['#00ff00','#ff0000','#ffff00'],
                    grid: {
                        borderColor: '#ffffff',
                        xaxis: {
                            lines: {
                                show: false
                            }
                        },
                        yaxis: {
                            lines: {
                                show: false
                            }
                        },
                        padding: {
                            top: -20
                        }
                    },
                    tooltip: {
                        custom: function ({ series, seriesIndex, dataPointIndex, w }) {
                            return '<div class="px-3 py-2">' + '<span>' + series[seriesIndex][dataPointIndex] + '</span>' + '</div>';
                        }
                    },
                    xaxis: {
                        categories: [
                            {!! $arrayGraficoLine['cat'] !!}
                        ],
                        axisBorder: {
                            show: false
                        },
                        axisTicks: {
                            show: false
                        },
                        labels: {
                            show: false,
                            style: {
                                colors: '#ffffff',
                                fontSize: '9px'
                            }
                        }
                    },
                    yaxis: {
                        labels: {
                            formatter: function(val) {
                                return val.toFixed(0);
                            },
                            style: {
                                colors: '#cdcdcd',
                                fontSize: '15px'
                            }
                        }
                    }
                };
                if (typeof lineChartEl !== undefined && lineChartEl !== null) {
                    const lineChart = new ApexCharts(lineChartEl, lineChartConfig);
                    lineChart.render();
                }
                </script>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-3">
                <div class="card-header header-elements">
                    <div>
                        <p class="d-block mb-2 text-body fontSize25">Total X Tendência X Contra-Tendência</p>
                    </div>
                </div>
                <div class="card-body pt-2">
                    <div id="salesCountryChartTrade"></div>
                    <script>
                        const salesCountryChartElTrade = document.querySelector('#salesCountryChartTrade'),
                        salesCountryChartConfigTrade = {
                            chart: {
                                type: 'bar',
                                height: 200,
                                parentHeightOffset: 0,
                                toolbar: {
                                    show: false
                                }
                            },
                            series: [
                                {
                                    name: 'Numeros',
                                    data: [{{ $contador['total'] }}, {{ $contador['tendencia'] }}, {{ $contador['contra'] }}]
                                }
                            ],
                            plotOptions: {
                                bar: {
                                    borderRadius: 10,
                                    barHeight: '60%',
                                    horizontal: true,
                                    distributed: true,
                                    startingShape: 'rounded',
                                    dataLabels: {
                                        position: 'bottom'
                                    }
                                }
                            },
                            dataLabels: {
                                enabled: true,
                                textAnchor: 'start',
                                offsetY: 8,
                                offsetX: 11,
                                style: {
                                    fontWeight: 500,
                                    fontSize: '0.9375rem',
                                    fontFamily: 'Inter',
                                    colors: '#cdcdcd'
                                }
                            },
                            tooltip: {
                                enabled: false
                            },
                            legend: {
                                show: false
                            },
                            colors: [
                                '#00ff00',
                                '#26c6f9',
                                '#ff0000'
                            ],
                            grid: {
                                strokeDashArray: 8,
                                borderColor: '#ffffff',
                                xaxis: { lines: { show: false } },
                                yaxis: { lines: { show: false } },
                                padding: {
                                    top: -18,
                                    left: 10,
                                    right: 33,
                                    bottom: 10
                                }
                            },
                            xaxis: {
                                categories: ['Total', 'Tendência', 'Contra-Tendência'],
                                labels: {
                                    style: {
                                        fontSize: '0.9375rem',
                                        colors: '#cdcdcd',
                                        fontFamily: 'Inter'
                                    }
                                },
                                axisBorder: {
                                    show: false
                                },
                                axisTicks: {
                                    show: false
                                }
                            },
                            yaxis: {
                                labels: {
                                    style: {
                                        fontWeight: 500,
                                        fontSize: '0.7375rem',
                                        colors: '#cdcdcd',
                                        fontFamily: 'Inter'
                                    }
                                }
                            },
                            states: {
                                hover: {
                                    filter: {
                                        type: 'none'
                                    }
                                },
                                active: {
                                    filter: {
                                        type: 'none'
                                    }
                                }
                            }
                        };
                        if (typeof salesCountryChartElTrade !== undefined && salesCountryChartElTrade !== null) {
                            const salesCountryChartTrade = new ApexCharts(salesCountryChartElTrade, salesCountryChartConfigTrade);
                            salesCountryChartTrade.render();
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-3">
            <div class="card">
                <div class="card-header header-elements">
                    <div>
                        <p class="d-block mb-2 text-body fontSize25">Tempo Tendência X Contra-Tendência</p>
                    </div>
                </div>
                <div class="card-body">
                        <div class="d-none d-lg-flex vehicles-progress-labels mb-3">
                        <div class="vehicles-progress-label unloading-text fontSize12" style="width: {{ $tempo['tendenciaTotalPorcentagem'] }}%">Tendência</div>
                        <div class="vehicles-progress-label loading-text fontSize12" style="width: {{ $tempo['contraTotalPorcentagem'] }}%">Contra-Tendência</div>
                    </div>
                    <div class="vehicles-overview-progress progress rounded mb-3" style="height: 46px">
                        <div
                            class="progress-bar fs-big fw-medium text-start text-bg-info px-1 px-lg-3"
                            role="progressbar"
                            style="width: {{ $tempo['tendenciaTotalPorcentagem'] }}%; font-size: 16px !important"
                            aria-valuenow="{{ $tempo['tendenciaTotalPorcentagem'] }}"
                            aria-valuemin="0"
                            aria-valuemax="100">
                            {{ $tempo['tendenciaTotalView'] }}%
                        </div>
                        <div
                            class="progress-bar fs-big fw-medium text-start bg-gray-900 px-1 px-lg-3"
                            role="progressbar"
                            style="width: {{ $tempo['contraTotalPorcentagem'] }}%; font-size: 16px !important; background-color: red !important"
                            aria-valuenow="{{ $tempo['contraTotalPorcentagem'] }}"
                            aria-valuemin="0"
                            aria-valuemax="100">
                            {{ $tempo['contraTotalView'] }}%
                        </div>
                    </div>
                    <div class="table-responsive" style='min-height: auto !important'>
                        <table class="table card-table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Total</th>
                                    <th>%</th>
                                    <th>Média</th>
                                    <th>Qtd</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                <tr>
                                    <td class="w-50 ps-0">
                                        <div class="d-flex justify-content-start align-items-center">
                                            <h6 class="mb-0 fw-normal">Tendência</h6>
                                        </div>
                                    </td>
                                    <td class="pe-0 text-nowrap">
                                        <h6 class="mb-0">{{ $tempo['tendenciaTotalDescricao'] }}</h6>
                                    </td>
                                    <td class="pe-0 text-nowrap">
                                        <h6 class="mb-0">{{ $tempo['tendenciaTotalView'] }}%</h6>
                                    </td>
                                    <td class="pe-0 text-nowrap">
                                        <h6 class="mb-0">{{ $tempo['tendenciaMediaDescricao'] }}</h6>
                                    </td>
                                    <td class="pe-0 text-nowrap">
                                        <h6 class="mb-0">{{ $contador['tendencia'] }}</h6>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="w-50 ps-0">
                                        <div class="d-flex justify-content-start align-items-center">
                                            <h6 class="mb-0 fw-normal">Contra-Tendência</h6>
                                        </div>
                                    </td>
                                    <td class="pe-0 text-nowrap">
                                        <h6 class="mb-0">{{ $tempo['contraTotalDescricao'] }}</h6>
                                    </td>
                                    <td class="pe-0 text-nowrap">
                                        <h6 class="mb-0">{{ $tempo['contraTotalView'] }}%</h6>
                                    </td>
                                    <td class="pe-0 text-nowrap">
                                        <h6 class="mb-0">{{ $tempo['contraMediaDescricao'] }}</h6>
                                    </td>
                                    <td class="pe-0 text-nowrap">
                                        <h6 class="mb-0">{{ $contador['contra'] }}</h6>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-3">
            <div class="card">
                <div class="card-header header-elements">
                    <div>
                        <p class="d-block mb-2 text-body fontSize25">Tempo Gain X Loss X 0x0</p>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-none d-lg-flex vehicles-progress-labels mb-3">
                        <div class="vehicles-progress-label unloading-text fontSize12" style="width: {{ $tempo['gainTotalPorcentagem'] }}%">Gain</div>
                        <div class="vehicles-progress-label loading-text fontSize12" style="width: {{ $tempo['lossTotalPorcentagem'] }}%">Loss</div>
                        <div class="vehicles-progress-label waiting-text fontSize12" style="width: {{ $tempo['empateTotalPorcentagem'] }}%">0x0</div>
                    </div>
                    <div class="vehicles-overview-progress progress rounded mb-3" style="height: 46px">
                        <div
                            class="progress-bar fs-big fw-medium text-start text-bg-info px-1 px-lg-3"
                            role="progressbar"
                            style="width: {{ $tempo['gainTotalPorcentagem'] }}%; font-size: 16px !important;"
                            aria-valuenow="{{ $tempo['gainTotalPorcentagem'] }}"
                            aria-valuemin="0"
                            aria-valuemax="100">
                            {{ $tempo['gainTotalView'] }}%
                        </div>
                        <div
                            class="progress-bar fs-big fw-medium text-start bg-gray-900 px-1 px-lg-3"
                            role="progressbar"
                            style="width: {{ $tempo['lossTotalPorcentagem'] }}%; font-size: 16px !important; background-color: red !important"
                            aria-valuenow="{{ $tempo['lossTotalPorcentagem'] }}"
                            aria-valuemin="0"
                            aria-valuemax="100">
                            {{ $tempo['lossTotalView'] }}%
                        </div>
                        <div
                            class="progress-bar fs-big fw-medium text-start bg-secondary px-1 px-lg-3"
                            role="progressbar"
                            style="width: {{ $tempo['empateTotalPorcentagem'] }}%; font-size: 16px !important"
                            aria-valuenow="{{ $tempo['empateTotalPorcentagem'] }}"
                            aria-valuemin="0"
                            aria-valuemax="100">
                            {{ $tempo['empateTotalView'] }}%
                        </div>
                    </div>
                    <div class="table-responsive" style='min-height: auto !important'>
                        <table class="table card-table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Total</th>
                                    <th>%</th>
                                    <th>Média</th>
                                    <th>Qtd</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                <tr>
                                    <td class="w-50 ps-0">
                                        <div class="d-flex justify-content-start align-items-center">
                                            <h6 class="mb-0 fw-normal">Gain</h6>
                                        </div>
                                    </td>
                                    <td class="pe-0 text-nowrap">
                                        <h6 class="mb-0">{{ $tempo['gainTotalDescricao'] }}</h6>
                                    </td>
                                    <td class="pe-0 text-nowrap">
                                        <h6 class="mb-0">{{ $tempo['gainTotalView'] }}%</h6>
                                    </td>
                                    <td class="pe-0 text-nowrap">
                                        <h6 class="mb-0">{{ $tempo['gainMediaDescricao'] }}</h6>
                                    </td>
                                    <td class="pe-0 text-nowrap">
                                        <h6 class="mb-0">{{ $contador['gain'] }}</h6>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="w-50 ps-0">
                                        <div class="d-flex justify-content-start align-items-center">
                                            <h6 class="mb-0 fw-normal">Loss</h6>
                                        </div>
                                    </td>
                                    <td class="pe-0 text-nowrap">
                                        <h6 class="mb-0">{{ $tempo['lossTotalDescricao'] }}</h6>
                                    </td>
                                    <td class="pe-0 text-nowrap">
                                        <h6 class="mb-0">{{ $tempo['lossTotalView'] }}%</h6>
                                    </td>
                                    <td class="pe-0 text-nowrap">
                                        <h6 class="mb-0">{{ $tempo['lossMediaDescricao'] }}</h6>
                                    </td>
                                    <td class="pe-0 text-nowrap">
                                        <h6 class="mb-0">{{ $contador['loss'] }}</h6>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="w-50 ps-0">
                                        <div class="d-flex justify-content-start align-items-center">
                                            <h6 class="mb-0 fw-normal">0x0</h6>
                                        </div>
                                    </td>
                                    <td class="pe-0 text-nowrap">
                                        <h6 class="mb-0">{{ $tempo['empateTotalDescricao'] }}</h6>
                                    </td>
                                    <td class="pe-0 text-nowrap">
                                        <h6 class="mb-0">{{ $tempo['empateTotalView'] }}%</h6>
                                    </td>
                                    <td class="pe-0 text-nowrap">
                                        <h6 class="mb-0">{{ $tempo['empateMediaDescricao'] }}</h6>
                                    </td>
                                    <td class="pe-0 text-nowrap">
                                        <h6 class="mb-0">{{ $contador['empate'] }}</h6>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class='row'>
        <div class='col-md-3 mt-3'>
            <div class="card">
                <div class="card-header header-elements">
                    <div>
                        <h5 class="card-title mb-0">Gain X Loss Moeda Base</h5>
                    </div>
                </div>
                <div class="card-body">
                    <div id="donutChart"></div>
                    <script>
                    const donutChartEl = document.querySelector('#donutChart'),
                    donutChartConfig = {
                        chart: {
                            height: 200,
                            type: 'donut'
                        },
                        labels: ['Gain', 'Loss'],
                        series: [{{ $totalGainMB }}, {{ abs($totalLossMB) }}],
                        colors: [
                            '#008000',
                            '#ff0000'
                        ],
                        stroke: {
                            show: false,
                            curve: 'straight'
                        },
                        dataLabels: {
                            enabled: true,
                            formatter: function (val, opt) {
                                return parseInt(val, 10) + '%';
                            }
                        },
                        legend: {
                            show: false,
                            position: 'bottom',
                            markers: { offsetX: -3 },
                            itemMargin: {
                                vertical: 3,
                                horizontal: 10
                            },
                            labels: {
                                colors: '#ffffff',
                                useSeriesColors: false
                            }
                        },
                        plotOptions: {
                            pie: {
                                donut: {
                                    labels: {
                                        show: true,
                                        name: {
                                            fontSize: '2rem',
                                            fontFamily: 'Arial'
                                        },
                                        value: {
                                            fontSize: '1.2rem',
                                            color: '#cdcdcd',
                                            fontFamily: 'Arial',
                                            formatter: function (val) {
                                                return "{!! @$moedaBase !!} " + parseInt(val, 10);
                                            }
                                        },
                                        total: {
                                            show: false,
                                            fontSize: '1.5rem',
                                            color: '#ffffff',
                                            label: 'Operational',
                                            formatter: function (w) {
                                                return '31%';
                                            }
                                        }
                                    }
                                }
                            }
                        },
                        responsive: [
                            {
                                breakpoint: 992,
                                options: {
                                    chart: {
                                        height: 380
                                    },
                                    legend: {
                                        position: 'bottom',
                                        labels: {
                                            colors: '#ffffff',
                                            useSeriesColors: false
                                        }
                                    }
                                }
                            },
                            {
                                breakpoint: 576,
                                options: {
                                    chart: {
                                        height: 320
                                    },
                                    plotOptions: {
                                        pie: {
                                            donut: {
                                                labels: {
                                                    show: true,
                                                    name: {
                                                        fontSize: '1.5rem'
                                                    },
                                                    value: {
                                                        fontSize: '1rem'
                                                    },
                                                    total: {
                                                        fontSize: '1.5rem'
                                                    }
                                                }
                                            }
                                        }
                                    },
                                    legend: {
                                        position: 'bottom',
                                        labels: {
                                            colors: '#ffffff',
                                            useSeriesColors: false
                                        }
                                    }
                                }
                            },
                            {
                                breakpoint: 420,
                                options: {
                                    chart: {
                                        height: 280
                                    },
                                    legend: {
                                        show: false
                                    }
                                }
                            },
                            {
                                breakpoint: 360,
                                options: {
                                    chart: {
                                        height: 250
                                    },
                                    legend: {
                                        show: false
                                    }
                                }
                            }
                        ]
                    };
                    if (typeof donutChartEl !== undefined && donutChartEl !== null) {
                        const donutChart = new ApexCharts(donutChartEl, donutChartConfig);
                        donutChart.render();
                    }
                    </script>
                </div>
            </div>
        </div>
        <div class="col-md-7 mt-3">
            <div class="card" style='height: 100% !important'>
                <div class="card-header header-elements">
                    <div>
                        <h5 class="card-title mb-0">Maior Gain e Maior Loss</h5>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive" style='min-height: auto !important'>
                        <table class="table card-table">
                            <thead>
                                <tr>
                                    <td style="font-size: 16px !important"><b>Operação</b></td>
                                    <td style="font-size: 16px !important"><b>Nº</b></td>
                                    <td style="font-size: 16px !important"><b>Moeda</b></td>
                                    <td style="font-size: 16px !important"><b>Valor</b></td>
                                    <td style="font-size: 16px !important"><b>Valor MB</b></td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="font-size: 16px !important">Maior Gain</td>
                                    <td style="font-size: 16px !important">{{ @$tradeMaiorGain->idOperacao }}</td>
                                    <td style="font-size: 16px !important">{{ @$tradeMaiorGain->moeda }}</td>
                                    <td style="font-size: 16px !important">{{ @buscaPrefixoMoeda($tradeMaiorGain->moeda)." ".@valorDbForm($tradeMaiorGain->resPosicaoFinanceiro) }}</td>
                                    <td style="font-size: 16px !important">{{ @$moedaBase." ".@valorDbForm($tradeMaiorGain->resPosicaoFinanceiro * $tradeMaiorGain->$multiplicador) }}</td>
                                </tr>
                                <tr>
                                    <td style="font-size: 16px !important">Maior Loss</td>
                                    <td style="font-size: 16px !important">{{ @$tradeMaiorLoss->idOperacao }}</td>
                                    <td style="font-size: 16px !important">{{ @$tradeMaiorLoss->moeda }}</td>
                                    <td style="font-size: 16px !important">{{ @buscaPrefixoMoeda($tradeMaiorLoss->moeda)." ".@valorDbForm($tradeMaiorLoss->resPosicaoFinanceiro) }}</td>
                                    <td style="font-size: 16px !important">{{ @$moedaBase." ".@valorDbForm($tradeMaiorLoss->resPosicaoFinanceiro * $tradeMaiorGain->$multiplicador) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2 mt-3">
            <div class="card" style='height: 100% !important'>
                <div class="card-body pb-0 pt-4" style='height: 50% !important'>
                    <div class="d-flex align-items-center gap-3 me-4 me-sm-0">
                        <div class="avatar avatar-md">
                            <div class="avatar-initial bg-label-info rounded">
                                <i class="mdi mdi-elevator-up mdi-36px"></i>
                            </div>
                        </div>
                        <div class="content-right">
                            <span class="text-info mb-0 display-6">{{ $resultadosGerais['maiorSequenciaGain'] }}</span>
                            <p class="mb-0 fw-medium" style="font-size: 12px !important">Maior Sequência Gain</p>
                        </div>
                    </div>
                </div>
                <hr class="my-2" />
                <div class="card-body pb-0 pt-4" style='height: 50% !important'>
                    <div class="d-flex align-items-center gap-3 me-4 me-sm-0">
                        <div class="avatar avatar-md">
                            <div class="avatar-initial bg-label-danger rounded">
                                <i class="mdi mdi-elevator-down mdi-36px"></i>
                            </div>
                        </div>
                        <div class="content-right">
                            <span class="text-danger mb-0 display-6">{{ $resultadosGerais['maiorSequenciaLoss'] }}</span>
                            <p class="mb-0 fw-medium" style="font-size: 12px !important">Maior Sequencia Loss</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mt-3">
            <div class="card" style='height: 100% !important'>
                <div class="card-header header-elements">
                    <div>
                        <h5 class="card-title mb-0">3 Maiores Gains</h5>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive" style='min-height: auto !important'>
                        <table class="table card-table">
                            <thead>
                                <tr>
                                    <td style='font-size: 12px !important'><b>Nº Trade</b></td>
                                    <td style='font-size: 12px !important'><b>Data Entrada</b></td>
                                    <td style='font-size: 12px !important'><b>Data Saida</b></td>
                                    <td style='font-size: 12px !important'><b>Moeda</b></td>
                                    <td style='font-size: 12px !important'><b>Valor</b></td>
                                    <td style='font-size: 12px !important'><b>Valor MB</b></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($gains3Maiores as $gain)
                                    @php
                                    $var = explode(" ", $gain->dtHrEntrada);
                                    $dtHrEntrada = dataDbForm($var[0])." ".$var[1];
                                    $var = explode(" ", $gain->dtHrSaida);
                                    $dtHrSaida = dataDbForm($var[0])." ".$var[1];
                                    @endphp
                                    <tr>
                                        <td style='font-size: 12px !important'>{{ $gain->idOperacao }}</td>
                                        <td style='font-size: 12px !important'>{{ $dtHrEntrada }}</td>
                                        <td style='font-size: 12px !important'>{{ $dtHrSaida }}</td>
                                        <td style='font-size: 12px !important'>{{ $gain->moeda }}</td>
                                        <td style='font-size: 12px !important'>{{ buscaPrefixoMoeda($gain->moeda)." ".valorDbForm($gain->resPosicaoFinanceiro) }}</td>
                                        <td style='font-size: 12px !important'>{{ $moedaBase." ".valorDbForm($gain->resPosicaoFinanceiro * $gain->$multiplicador) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 mt-3">
            <div class="card" style='height: 100% !important'>
                <div class="card-header header-elements">
                    <div>
                        <h5 class="card-title mb-0">3 Maiores Loss</h5>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive" style='min-height: auto !important'>
                        <table class="table card-table">
                            <thead>
                                <tr>
                                    <td style='font-size: 12px !important'><b>Nº Trade</b></td>
                                    <td style='font-size: 12px !important'><b>Data Entrada</b></td>
                                    <td style='font-size: 12px !important'><b>Data Saida</b></td>
                                    <td style='font-size: 12px !important'><b>Moeda</b></td>
                                    <td style='font-size: 12px !important'><b>Valor</b></td>
                                    <td style='font-size: 12px !important'><b>Valor MB</b></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($loss3Maiores as $loss)
                                    @php
                                    $var = explode(" ", $loss->dtHrEntrada);
                                    $dtHrEntrada = dataDbForm($var[0])." ".$var[1];
                                    $var = explode(" ", $loss->dtHrSaida);
                                    $dtHrSaida = dataDbForm($var[0])." ".$var[1];
                                    @endphp
                                    <tr>
                                        <td style='font-size: 12px !important'>{{ $loss->idOperacao }}</td>
                                        <td style='font-size: 12px !important'>{{ $dtHrEntrada }}</td>
                                        <td style='font-size: 12px !important'>{{ $dtHrSaida }}</td>
                                        <td style='font-size: 12px !important'>{{ $loss->moeda }}</td>
                                        <td style='font-size: 12px !important'>{{ buscaPrefixoMoeda($loss->moeda)." ".valorDbForm($loss->resPosicaoFinanceiro) }}</td>
                                        <td style='font-size: 12px !important'>{{ $moedaBase." ".valorDbForm($loss->resPosicaoFinanceiro * $loss->$multiplicador) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-3">
                <div class="card-header header-elements">
                    <div>
                        <h5 class="card-title mb-0">Evolução Financeira Moeda Base</h5>
                    </div>
                </div>
                <div class="card-body pt-2">
                    <div id="lineChartEvolucao"></div>
                </div>
                <script>
                const lineChartEvolucao = document.querySelector('#lineChartEvolucao'),
                lineChartConfigEv = {
                    chart: {
                        height: 400,
                        fontFamily: 'Inter',
                        type: 'line',
                        parentHeightOffset: 0,
                        zoom: {
                            enabled: false
                        },
                        toolbar: {
                            show: false
                        }
                    },
                    series: [
                        {
                            name: 'Evolução',
                            data: [{!! $stringSomadorTrades !!}]
                        }
                    ],
                    markers: {
                        strokeWidth: 7,
                        strokeOpacity: 1,
                        strokeColors: ['#ffffff'],
                        colors: ['#ffffff']
                    },
                    legend: {
                        show: true,
                        position: 'bottom',
                        markers: { offsetX: -3 },
                        itemMargin: {
                            vertical: 3,
                            horizontal: 10
                        },
                        labels: {
                            colors: '#ffffff',
                            useSeriesColors: false
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        curve: 'straight'
                    },
                    colors: ['#ffff00','#ff0000','#ffff00'],
                    grid: {
                        borderColor: '#ffffff',
                        xaxis: {
                            lines: {
                                show: false
                            }
                        },
                        yaxis: {
                            lines: {
                                show: false
                            }
                        },
                        padding: {
                            top: -20
                        }
                    },
                    tooltip: {
                        custom: function ({ series, seriesIndex, dataPointIndex, w }) {
                            return '<div class="px-3 py-2">' + '<span> {!! @$moedaBase !!} ' + series[seriesIndex][dataPointIndex] + '</span>' + '</div>';
                        }
                    },
                    xaxis: {
                        categories: [
                            {!! $arrayGraficoLine['cat'] !!}
                        ],
                        axisBorder: {
                            show: false
                        },
                        axisTicks: {
                            show: false
                        },
                        labels: {
                            show: false,
                            style: {
                                colors: '#ffffff',
                                fontSize: '11px'
                            }
                        }
                    },
                    yaxis: {
                        labels: {
                            formatter: function(val) {
                                return val.toFixed(0);
                            },
                            style: {
                                colors: '#cdcdcd',
                                fontSize: '11px'
                            }
                        }
                    }
                };
                if (typeof lineChartEvolucao !== undefined && lineChartEvolucao !== null) {
                    const lineChartEv = new ApexCharts(lineChartEvolucao, lineChartConfigEv);
                    lineChartEv.render();
                }
                </script>
            </div>
        </div>
    </div>
</div>

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
    window.location.href = "{{ route('aluno.limparFiltros') }}" + '/dashboard';
})
</script>
@endsection
