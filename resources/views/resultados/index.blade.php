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
<form action="{{ route('resultados') }}" method="post" id='formulario'>
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

    <div class="card mt-3">
        <div class="card-body">
            <div class="row justify-content-between">
                <div class="col-md-3">
                    <h6 class="card-title">One Page Report</h6>
                </div>
                <div class="col-md-9" align='right'>
                    <button type="button" id="btnExportarListaPdf" class="btn btn-sm btn-info">Exportar Lista de Trades</button>
                </div>
            </div>
            <div class="table-responsive">
                <table class='table table-sm table-trades'>
                    <thead>
                        <tr>
                            <th class="text-center"></th>
                            <td class="text-center">Aluno</td>
                            <td class="text-center">Numero</td>
                            <td class="text-center">Entrada</td>
                            <td class="text-center">Saída</td>
                            <td class="text-center">Tempo</td>
                            <td class="text-center">Status</td>
                            <td class="text-center">Tipo</td>
                            <td class="text-center">Pais</td>
                            <td class="text-center">Corretora</td>
                            <td class="text-center">Tipo Conta</td>
                            <td class="text-center">Conta</td>
                            <td class="text-center">Ativo</td>
                            <td class="text-center">Tipo Ativo</td>
                            <td class="text-center">Operação</td>
                            <td class="text-center">Direção</td>
                            <td class="text-center">Fase</td>
                            <td class="text-center">Qt Contratos</td>
                            <td class="text-center">Moeda</td>
                            <td class="text-center">Valor Ponto Por Contrato</td>
                            <td class="text-center">Tipo Custo</td>
                            <td class="text-center">Custo Entrada por Contrato</td>
                            <td class="text-center">Custo Saída por Contrato</td>
                            <td class="text-center">Preço &nbspEntrada&nbsp</td>
                            <td class="text-center">Custo Entrada</td>
                            <td class="text-center">Preço &nbsp&nbspSaída&nbsp&nbsp</td>
                            <td class="text-center">Custo Saída</td>
                            <td class="text-center">Resultado Posição Pontos</td>
                            <td class="text-center">Resultado Posição Financeiro</td>
                            <td class="text-center">Resultado Contrato Pontos</td>
                            <td class="text-center">Resultado Contrato Financeiro</td>
                            <td class="text-center">Variação Entrada Saída</td>
                            {{--<th>Resultado Operação Capital</th>--}}
                            <td class="text-center">Gain ou Loss</td>
                            {{--<th>Saúde Conta</th>--}}
                            {{--<th>Validador</th>--}}
                            <td class="text-center">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspMB&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Custo Entrada</td>
                            <td class="text-center">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspMB&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Custo Saída</td>
                            <td class="text-center">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspMB&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Resultado Contrato</td>
                            <td class="text-center">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspMB&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Resultado Posição</td>
                            <td class="text-center">Motivos Entrada</td>
                            <td class="text-center">Motivos Saida</td>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $totalMbCustoEntrada = 0;
                        $totalMbCustoSaida = 0;
                        $totalMbResultadoContrato = 0;
                        $totalMbResultadoPosicao = 0;
                        @endphp
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
                            $mbCustoEntrada = round($trade->custoEntrada * $trade->$multiplicador,2);
                            $mbCustoSaida = round($trade->custoSaida * $trade->$multiplicador,2);
                            $mbResultadoContrato = round($trade->resContratoFinanceiro * $trade->$multiplicador,2);
                            $mbResultadoPosicao = round($trade->resPosicaoFinanceiro * $trade->$multiplicador,2);

                            $totalMbCustoEntrada += $mbCustoEntrada;
                            $totalMbCustoSaida += $mbCustoSaida;
                            $totalMbResultadoContrato += $mbResultadoContrato;
                            $totalMbResultadoPosicao += $mbResultadoPosicao;

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
                            <tr>
                                <td><input type="checkbox" class='selecionados' value='{{ $trade->id_trade }}' checked></td>
                                <td>{{ $trade->nmAluno }}</td>
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
                                <td>{{ $moedaTrade.' '.valorDbForm($trade->valorPontoContrato) }}</td>
                                <td>{{ $trade->tipoCusto }}</td>
                                <td>{{ $moedaTrade.' '.valorDbForm($trade->custoOperacaoEntrada) }}</td>
                                <td>{{ $moedaTrade.' '.valorDbForm($trade->custoOperacaoSaida) }}</td>
                                <td>{{ $moedaTrade.' '.valorDbForm($trade->precoEntrada) }}</td>
                                <td>{{ $moedaTrade.' '.valorDbForm($trade->custoEntrada) }}</td>
                                <td>{{ $moedaTrade.' '.valorDbForm($trade->precoSaida) }}</td>
                                <td>{{ $moedaTrade.' '.valorDbForm($trade->custoSaida) }}</td>
                                <td>{{ $trade->resPosicaoPontos }}</td>
                                <td>{{ $moedaTrade.' '.valorDbForm($trade->resPosicaoFinanceiro) }}</td>
                                <td>{{ $trade->resContratoPontos }}</td>
                                <td>{{ $moedaTrade.' '.valorDbForm($trade->resContratoFinanceiro) }}</td>
                                <td>{{ $trade->variacaoEntradaSaida }}%</td>
                                {{--<td>{{ $trade->resOperacaoCapital }}</td>--}}
                                <td style='color: {{ $color }};'>{{ $trade->gainOrLoss }}</td>
                                {{--<td>{{ $trade->saudeConta }}</td>--}}
                                {{--<td>{{ $trade->validador }}</td>--}}
                                <td>{{ $moeda.' '.valorDbForm($mbCustoEntrada) }}</td>
                                <td>{{ $moeda.' '.valorDbForm($mbCustoSaida) }}</td>
                                <td>{{ $moeda.' '.valorDbForm($mbResultadoContrato) }}</td>
                                <td>{{ $moeda.' '.valorDbForm($mbResultadoPosicao) }}</td>
                                <td>{{ $trade->motivosEntrada }}</td>
                                <td>{{ $trade->motivosSaida }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="33" style="text-align: right !important;"><b>TOTAL</b></td>
                            <td><b>{{ $moeda.' '.$totalMbCustoEntrada }}</b></td>
                            <td><b>{{ $moeda.' '.$totalMbCustoSaida }}</b></td>
                            <td><b>{{ $moeda.' '.$totalMbResultadoContrato }}</b></td>
                            <td><b>{{ $moeda.' '.$totalMbResultadoPosicao }}</b></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="row mt-3">
                <div class="col-md-12">
                    <button type="button" name="button" id='btnExportar' class="btn btn-primary btn-sm">Exportar para Relatório</button>
                </div>
            </div>
        </div>
    </div>
</div>
<form id='formularioOnePageReport' action="{{ route('resultados.onePageReport') }}" method="post">
    @csrf
    <input type="hidden" name="trades" id='formularioOnePageReport_trades'>
</form>

<form id='formularioExportarListaTrades' action="{{ route('resultados.exportarListaTrades') }}" target='_blank' method="post">
    @csrf
    <input type="hidden" name="trades" id='formularioExportarListaTrades_trades'>
</form>
<script>

document.getElementById('btnExportarListaPdf').addEventListener('click', ()=>{
    var trades = '';
    var controle = false;
    inputs = document.querySelectorAll('input.selecionados');

    [].forEach.call(inputs, function(input) {
        if(input.checked == true){
            trades = trades + ',' + input.value;
            controle = true;
        }
    });

    if(controle){
        document.getElementById('formularioExportarListaTrades_trades').value = trades;
        document.getElementById('formularioExportarListaTrades').submit();
    }
    else{
        alert('É necessário escolher pelo menos 1 trade');
    }
});


document.getElementById('btnExportar').addEventListener('click', ()=>{
    var trades = '';
    var controle = false;
    inputs = document.querySelectorAll('input.selecionados');

    [].forEach.call(inputs, function(input) {
        if(input.checked == true){
            trades = trades + ',' + input.value;
            controle = true;
        }
    });

    if(controle){
        document.getElementById('formularioOnePageReport_trades').value = trades;
        document.getElementById('formularioOnePageReport').submit();
    }
    else{
        alert('É necessário escolher pelo menos 1 trade');
    }
})

document.getElementById('btnLimparFiltos').addEventListener('click', ()=>{
    document.getElementById('controle').value = 'limparFiltros';
    document.getElementById('formulario').submit();
})

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

function executarFiltro(){

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

    document.getElementById('form_dtEntradaInc').value = document.getElementById('filtro_dtEntradaInc').value;
    document.getElementById('form_dtEntradaFn').value = document.getElementById('filtro_dtEntradaFn').value;
    document.getElementById('form_dtSaidaInc').value = document.getElementById('filtro_dtSaidaInc').value;
    document.getElementById('form_dtSaidaFn').value = document.getElementById('filtro_dtSaidaFn').value;

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
