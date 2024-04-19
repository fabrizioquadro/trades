@extends('layoutAdmin')

@section('conteudo')
@php
$user = Auth::user();
$filtroTag = $user->filtroTag != NULL ? explode(',', $user->filtroTag) : NULL;
$filtroAluno = $user->filtroAluno != NULL ? explode(',', $user->filtroAluno) : NULL;
$dtEntradaInc = $user->filtroDtEntradaInc;
$dtEntradaFn = $user->filtroDtEntradaFn;
$dtSaidaInc = $user->filtroDtSaidaInc;
$dtSaidaFn = $user->filtroDtSaidaFn;
$filtroTipoOperacao = explode(',', $user->filtroTipoOperacao);
$filtroPais = explode(',', $user->filtroPais);
$filtroCorretora = explode(',', $user->filtroCorretora);
$filtroTipoConta = explode(',', $user->filtroTipoConta);
$filtroConta = explode(',', $user->filtroConta);
$filtroAtivo = explode(',', $user->filtroAtivo);
$filtroTipoAtivo = explode(',', $user->filtroTipoAtivo);
$filtroOperacao = explode(',', $user->filtroOperacao);
$filtroDirecao = explode(',', $user->filtroDirecao);
$filtroFase = explode(',', $user->filtroFase);
$filtroMoeda = explode(',', $user->filtroMoeda);
$filtroTipoCusto = explode(',', $user->filtroTipoCusto);
$filtroResultado = explode(',', $user->filtroResultado);

if($user->moedaBase == "BRL"){
    $multiplicador = 'cotacaoBRL';
    $moeda = "R$";
}
elseif($user->moedaBase == "USD"){
    $multiplicador = 'cotacaoUSD';
    $moeda = "US$";
}
elseif($user->moedaBase == "EUR"){
    $multiplicador = 'cotacaoEUR';
    $moeda = "€";
}
elseif($user->moedaBase == "GBP"){
    $multiplicador = 'cotacaoGBP';
    $moeda = "£";
}
elseif($user->moedaBase == "JPY"){
    $multiplicador = 'cotacaoJPY';
    $moeda = "¥$";
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
    font-size: 12px !important;
}

</style>
-->
<form action="{{ route('dashboard') }}" method="post" id='formulario'>
    @csrf
    <input type="hidden" name="controle" id='controle' value="controle">
    <input type="hidden" name="filtroTag" id='filtroTag'>
    <input type="hidden" name="filtroAluno" id='filtroAluno'>
    <input type='hidden' name='dtEntradaInc' id='form_dtEntradaInc'>
    <input type='hidden' name='dtEntradaFn' id='form_dtEntradaFn'>
    <input type='hidden' name='dtSaidaInc' id='form_dtSaidaInc'>
    <input type='hidden' name='dtSaidaFn' id='form_dtSaidaFn'>
    <input type='hidden' name='filtroTipoOperacao' id='filtroTipoOperacao'>
    <input type='hidden' name='filtroPais' id='filtroPais'>
    <input type='hidden' name='filtroCorretora' id='filtroCorretora'>
    <input type='hidden' name='filtroTipoConta' id='filtroTipoConta'>
    <input type='hidden' name='filtroConta' id='filtroConta'>
    <input type='hidden' name='filtroAtivo' id='filtroAtivo'>
    <input type='hidden' name='filtroTipoAtivo' id='filtroTipoAtivo'>
    <input type='hidden' name='filtroOperacao' id='filtroOperacao'>
    <input type='hidden' name='filtroDirecao' id='filtroDirecao'>
    <input type='hidden' name='filtroFase' id='filtroFase'>
    <input type='hidden' name='filtroMoeda' id='filtroMoeda'>
    <input type='hidden' name='filtroTipoCusto' id='filtroTipoCusto'>
    <input type='hidden' name='filtroResultado' id='filtroResultado'>
</form>
<div class="container-xxl flex-grow-1 container-p-y">

            <div class="row">
                <div class="col-md-6">
                    <span class="card-title">Filtros</span>
                </div>
                <div class="col-md-6" align='right'>
                    <button type="button" class='btn btn-sm btn-warning' id='btnLimparFiltos'>Limpar Filtros</button>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-6 form-group">
                    <label for="">Tags</label>
                    <select name="filtroTag" id="tags" class="form-control" multiple>
                        @foreach($tags as $tag)
                            @php
                            if($filtroTag){
                                $selected = "";
                                foreach($filtroTag as $var){
                                    if($var == $tag->id){
                                        $selected = "selected";
                                    }
                                }
                            }
                            else{
                                $selected = "selected";
                            }
                            @endphp
                            <option {{ $selected }} value="{{ $tag->id }}">{{ $tag->nmTag }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 form-group">
                    <label for="">Alunos</label>
                    <select name="filtroAluno" id="alunos" class="form-control" multiple>
                        @foreach($alunos as $aluno)
                            @php
                            if($filtroAluno){
                                $selected = "";
                                foreach($filtroAluno as $var){
                                    if($var == $aluno->id_aluno){
                                        $selected = "selected";
                                    }
                                }
                            }
                            else{
                                $selected = "selected";
                            }
                            @endphp
                            <option value="{{ $aluno->id_aluno }}" {{ $selected }}>{{ $aluno->nmAluno }}</option>
                        @endforeach
                    </select>
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
                                                                <input class="form-control" type="date" id="filtro_dtEntradaInc" name="filtro_dtEntradaInc" placeholder="Início" value="{{ $dtEntradaInc }}"/>
                                                                <label for="filtro_dtEntradaInc">Início:</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-3">
                                                        <div class="col-md-12">
                                                            <div class="form-floating form-floating-outline">
                                                                <input class="form-control" type="date" id="filtro_dtEntradaFn" name="filtro_dtEntradaFn" placeholder="Fim" value='{{ $dtEntradaFn }}'/>
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
                                                                <input class="form-control" type="date" id="filtro_dtSaidaInc" name="filtro_dtSaidaInc" placeholder="Início" value="{{ $dtSaidaInc }}" />
                                                                <label for="filtro_dtSaidaInc">Início:</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-3">
                                                        <div class="col-md-12">
                                                            <div class="form-floating form-floating-outline">
                                                                <input class="form-control" type="date" id="filtro_dtSaidaFn" name="filtro_dtSaidaFn" placeholder="Fim"/ value="{{ $dtSaidaFn }}" >
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
                                                                        if($linha == 'DAY TRADE'){
                                                                            $controle = "checked";
                                                                        }
                                                                    }
                                                                }
                                                                @endphp
                                                                <input class="form-check-input filtroTipoOperacao" {{ $controle }} type="checkbox" id='tpDayTrade' value="DAY TRADE">
                                                                <label class="form-check-label" for="tpDayTrade"> DAY TRADE </label>
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
                                                                        if($linha == 'HEDGE'){
                                                                            $controle = "checked";
                                                                        }
                                                                    }
                                                                }
                                                                @endphp
                                                                <input class="form-check-input filtroTipoOperacao" {{ $controle }} type="checkbox" id='tpDayTrade' value="HEDGE">
                                                                <label class="form-check-label" for="tpHedge"> HEDGE </label>
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
                                                                        if($linha == 'POSITION'){
                                                                            $controle = "checked";
                                                                        }
                                                                    }
                                                                }
                                                                @endphp
                                                                <input class="form-check-input filtroTipoOperacao" {{ $controle }} type="checkbox" id='tpPosition' value="POSITION">
                                                                <label class="form-check-label" for="tpPosition"> POSITION </label>
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
                                                                        if($linha == 'SCALP'){
                                                                            $controle = "checked";
                                                                        }
                                                                    }
                                                                }
                                                                @endphp
                                                                <input class="form-check-input filtroTipoOperacao" {{ $controle }} type="checkbox" id='tpScalp' value="SCALP">
                                                                <label class="form-check-label" for="tpScalp"> SCALP </label>
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
                                                                        if($linha == 'SWING TRADE'){
                                                                            $controle = "checked";
                                                                        }
                                                                    }
                                                                }
                                                                @endphp
                                                                <input class="form-check-input filtroTipoOperacao" {{ $controle }} type="checkbox" id='tpSwingTrade' value="SWING TRADE">
                                                                <label class="form-check-label" for="tpSwingTrade"> SWING TRADE </label>
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
                            @if($user->filtroDtEntradaInc)
                                De: {{ dataDbForm($user->filtroDtEntradaInc) }} <br>
                            @endif
                            @if($user->filtroDtEntradaFn)
                                Até: {{ dataDbForm($user->filtroDtEntradaFn) }} <br>
                            @endif
                        </th>
                        <th>
                            @if($user->filtroDtSaidaInc)
                                De: {{ dataDbForm($user->filtroDtSaidaInc) }} <br>
                            @endif
                            @if($user->filtroDtSaidaFn)
                                Até: {{ dataDbForm($user->filtroDtSaidaFn) }} <br>
                            @endif
                        </th>
                        <th>
                            @if($user->filtroTipoOperacao)
                                {{ str_replace(',', ', ',$user->filtroTipoOperacao) }}
                            @endif
                        </th>
                        <th>
                            @if($user->filtroPais)
                                {{ str_replace(',', ', ',$user->filtroPais) }}
                            @endif
                        </th>
                        <th>
                            @if($user->filtroCorretora)
                                {{ $stringCorretoras }}
                            @endif
                        </th>
                        <th>
                            @if($user->filtroTipoConta)
                                {{ str_replace(',', ', ',$user->filtroTipoConta) }}
                            @endif
                        </th>
                        <th>
                            @if($user->filtroAtivo)
                                {{ $stringAtivos }}
                            @endif
                        </th>
                        <th>
                            @if($user->filtroTipoAtivo)
                                {{ str_replace(',', ', ',$user->filtroTipoAtivo) }}
                            @endif
                        </th>
                        <th>
                            @if($user->filtroOperacao)
                                {{ str_replace(',', ', ',$user->filtroOperacao) }}
                            @endif
                        </th>
                        <th>
                            @if($user->filtroDirecao)
                                {{ str_replace(',', ', ',$user->filtroDirecao) }}
                            @endif
                        </th>
                        <th>
                            @if($user->filtroFase)
                                {{ str_replace(',', ', ',$user->filtroFase) }}
                            @endif
                        </th>
                        <th>
                            @if($user->filtroMoeda)
                                {{ str_replace(',', ', ',$user->filtroMoeda) }}
                            @endif
                        </th>
                        <th>
                            @if($user->filtroTipoCusto)
                                {{ str_replace(',', ', ',$user->filtroTipoCusto) }}
                            @endif
                        </th>
                        <th>
                            @if($user->filtroResultado)
                                {{ str_replace(',', ', ',$user->filtroResultado) }}
                            @endif
                        </th>
                    </tr>
                    </table>
                </div>
            </div>



            <div class="row mt-3">
                <div class="col-md-2">
                    <button class="btn btn-primary btn-sm" onclick="executarFiltro()" type='button'>Filtrar</button>
                </div>
            </div>


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
</div>
<script>

document.getElementById('tags').addEventListener('change', (e)=>{
    opcoes = document.querySelectorAll('select[name=filtroTag] option');
    tags = '';
    for (var i = 0, j = opcoes.length; i < j; i++) {
        if (opcoes[i].selected == true) {
            tags = tags + ',' + opcoes[i].value;
        }
    }

    $.getJSON(
        "{{ route('filtroTagsAlunos') }}",
        {
            tags : tags
        },
        function(json){
            document.getElementById('alunos').innerHTML = json.html;
        }
    );

})

document.getElementById('btnLimparFiltos').addEventListener('click', ()=>{
    document.getElementById('controle').value = 'limparFiltros';
    document.getElementById('formulario').submit();
})

function executarFiltro(){
    document.getElementById('form_dtEntradaInc').value = document.getElementById('filtro_dtEntradaInc').value;
    document.getElementById('form_dtEntradaFn').value = document.getElementById('filtro_dtEntradaFn').value;
    document.getElementById('form_dtSaidaInc').value = document.getElementById('filtro_dtSaidaInc').value;
    document.getElementById('form_dtSaidaFn').value = document.getElementById('filtro_dtSaidaFn').value;

    //vamos verificar o filtro de tags e de alunos
    filtroTag = "";
    filtroAluno = "";

    opcoes = document.querySelectorAll('select[name=filtroTag] option');
    for (var i = 0, j = opcoes.length; i < j; i++) {
        if (opcoes[i].selected == true) {
            filtroTag = filtroTag + ',' + opcoes[i].value;
        }
    }

    opcoes = document.querySelectorAll('select[name=filtroAluno] option');
    for (var i = 0, j = opcoes.length; i < j; i++) {
        if (opcoes[i].selected == true) {
            filtroAluno = filtroAluno + ',' + opcoes[i].value;
        }
    }

    document.getElementById('filtroTag').value = filtroTag;
    document.getElementById('filtroAluno').value = filtroAluno;

    //vamos verificar os filtros das corretoras
    arrayFiltros = [
        'filtroTipoOperacao',
        'filtroPais',
        'filtroCorretora',
        'filtroTipoConta',
        'filtroConta',
        'filtroAtivo',
        'filtroTipoAtivo',
        'filtroOperacao',
        'filtroDirecao',
        'filtroFase',
        'filtroMoeda',
        'filtroTipoCusto',
        'filtroResultado'
    ];

    arrayFiltros.forEach((item) => {
        variavel = 'input.' + item;
        inputs = document.querySelectorAll(variavel);
        filtro = '';
        inputs.forEach((input) => {
            if(input.checked == true){
                filtro = filtro + "," + input.value;
            }
        });

        document.getElementById(item).value = filtro;

    });

    document.getElementById('formulario').submit();
}
</script>
@endsection
