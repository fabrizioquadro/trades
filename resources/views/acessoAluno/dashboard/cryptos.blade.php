@extends('layoutAluno')

@section('conteudo')
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- TradingView Widget BEGIN -->
    <div class="tradingview-widget-container">
        <div class="tradingview-widget-container__widget"></div>
        <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-ticker-tape.js" async>
            {
                "symbols": [
                    {
                    "description": "NASDAQ 100 USA",
                    "proName": "CME_MINI:MNQ1!"
                    },
                    {
                    "description": "S&P 500 USA",
                    "proName": "CME_MINI:MES1!"
                    },
                    {
                    "description": "DAX GER",
                    "proName": "EUREX:FDAX1!"
                    },
                    {
                    "description": "FUTSIE UK",
                    "proName": "EUREX:FTUK1!"
                    },
                    {
                    "description": "HANG SENG HK",
                    "proName": "HKEX:MHI1!"
                    },
                    {
                    "description": "IBOV BR",
                    "proName": "BMFBOVESPA:WIN1!"
                    },
                    {
                    "description": "Dollar / BR Real",
                    "proName": "BMFBOVESPA:WDO1!"
                    },
                    {
                    "description": "GBPUSD ICE",
                    "proName": "FX_IDC:GBPUSD"
                    },
                    {
                    "description": "EURUSD ICE",
                    "proName": "FX_IDC:EURUSD"
                    },
                    {
                    "description": "JPYUSD ICE",
                    "proName": "FX_IDC:JPYUSD"
                    },
                    {
                    "description": "BTCUSD CME",
                    "proName": "CME:BTC1!"
                    },
                    {
                    "description": "ETHUSD CME",
                    "proName": "CME:ETH1!"
                    }
                ],
                "showSymbolLogo": true,
                "isTransparent": false,
                "displayMode": "compact",
                "colorTheme": "dark",
                "locale": "br"
            }
        </script>
    </div>
    <!-- TradingView Widget END -->
    <div class="row mt-3">
        <div class="col-md-12" align='center'>
            <img src="{{ asset('/public/img/IconsPng/Head Footer Tradingview.png') }}" style="height: 100px" alt="">
        </div>
    </div>
    <div class="row mt-3 mb-2">
        <div class="col-md-4">
          <div class="form-floating form-floating-outline">
                <form action="{{ route('aluno.dashboard.mercado.cryptos') }}" method="get">
                    <select id="ativo" onchange='submit()' name='ativo' class="form-control combobox">
                        <option></option>
                        @foreach($ativos as $ativo)
                            <option value="{{ $ativo->simbolo }}">{{ $ativo->simbolo }}</option>
                        @endforeach
                    </select>
                </form>
          </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-12">
            <!-- TradingView Widget BEGIN -->
            <div class="tradingview-widget-container">
                <div class="tradingview-widget-container__widget"></div>
                <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-symbol-info.js" async>
                    {
                        "symbol": "{{ $simbolo }}",
                        "width": "100%",
                        "locale": "br",
                        "colorTheme": "dark",
                        "isTransparent": false
                    }
                </script>
            </div>
            <!-- TradingView Widget END -->
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-12">
            <!-- TradingView Widget BEGIN -->
            <div class="tradingview-widget-container">
                <div class="tradingview-widget-container__widget"></div>
                <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-symbol-profile.js" async>
                    {
                        "width": "100%",
                        "height": "100%",
                        "isTransparent": false,
                        "colorTheme": "dark",
                        "symbol": "{{ $simbolo }}",
                        "locale": "br"
                    }
                </script>
            </div>
            <!-- TradingView Widget END -->
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-12" style="height: 1000px">
            <!-- TradingView Widget BEGIN -->
            <div class="tradingview-widget-container" style="height:100%;width:100%">
                <div class="tradingview-widget-container__widget" style="height:calc(100% - 32px);width:100%"></div>
                <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-advanced-chart.js" async>
                    {
                        "autosize": true,
                        "symbol": "{{ $simbolo }}",
                        "timezone": "Etc/UTC",
                        "theme": "dark",
                        "style": "1",
                        "locale": "br",
                        "backgroundColor": "rgba(40, 42, 66, 0)",
                        "gridColor": "rgba(40, 42, 66, 0)",
                        "withdateranges": true,
                        "range": "5D",
                        "hide_side_toolbar": false,
                        "allow_symbol_change": false,
                        "details": true,
                        "calendar": false,
                        "studies": [ "STD;VWAP" ],
                        "support_host": "https://www.tradingview.com"
                    }
                </script>
            </div>
            <!-- TradingView Widget END -->
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-4" style="height: 800px">
            <!-- TradingView Widget BEGIN -->
            <div class="tradingview-widget-container">
                <div class="tradingview-widget-container__widget"></div>
                <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-technical-analysis.js" async>
                    {
                        "interval": "5m",
                        "width": "100%",
                        "isTransparent": false,
                        "height": "100%",
                        "symbol": "{{ $simbolo }}",
                        "showIntervalTabs": true,
                        "displayMode": "multiple",
                        "locale": "br",
                        "colorTheme": "dark"
                    }
                </script>
            </div>
            <!-- TradingView Widget END -->
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-4" style="height: 800px">
            <!-- TradingView Widget BEGIN -->
            <div class="tradingview-widget-container">
                <div class="tradingview-widget-container__widget"></div>
                <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-timeline.js" async>
                    {
                        "feedMode": "symbol",
                        "symbol": "{{ $simbolo }}",
                        "isTransparent": false,
                        "displayMode": "adaptive",
                        "width": "100%",
                        "height": "100%",
                        "colorTheme": "dark",
                        "locale": "br"
                    }
                </script>
            </div>
            <!-- TradingView Widget END -->
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-4" style="height: 800px">
            <!-- TradingView Widget BEGIN -->
            <div class="tradingview-widget-container">
                <div class="tradingview-widget-container__widget"></div>
                <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-crypto-coins-heatmap.js" async>
                    {
                        "dataSource": "Crypto",
                        "blockSize": "24h_vol_cmc",
                        "blockColor": "change|60",
                        "locale": "br",
                        "symbolUrl": "",
                        "colorTheme": "dark",
                        "hasTopBar": true,
                        "isDataSetEnabled": true,
                        "isZoomEnabled": true,
                        "hasSymbolTooltip": true,
                        "isMonoSize": false,
                        "width": "100%",
                        "height": "100%"
                    }
                </script>
            </div>
            <!-- TradingView Widget END -->
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-4" style="height: 800px">
            <!-- TradingView Widget BEGIN -->
            <div class="tradingview-widget-container">
                <div class="tradingview-widget-container__widget"></div>
                <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-screener.js" async>
                    {
                        "width": "100%",
                        "height": "100%",
                        "defaultColumn": "overview",
                        "screener_type": "crypto_mkt",
                        "displayCurrency": "USD",
                        "colorTheme": "dark",
                        "locale": "br",
                        "isTransparent": false
                    }
                </script>
            </div>
            <!-- TradingView Widget END -->
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-12" align='center'>
            <img src="{{ asset('/public/img/logoNaoCompleto.png') }}" style="height: 100px" alt="">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <p class='text-center p-5' style="color:#fff">
				As informações contídas nessa página são extraídas da plataforma TradingView e nenhuma recomendação de compra ou venda podem ser realizadas apenas com estas informações.
			</p>
        </div>
    </div>
</div>
<script>
window.addEventListener('load',()=>{
    $('.combobox').combobox();
});
</script>
@endsection
