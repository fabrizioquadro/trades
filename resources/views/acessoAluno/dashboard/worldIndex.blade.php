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
    <div class="row">
        <div class="col-md-12 mt-4" style="height: 500px">
            <!-- TradingView Widget BEGIN -->
            <div class="tradingview-widget-container">
                <div class="tradingview-widget-container__widget"></div>
                <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-events.js" async>
                    {
                        "width": "100%",
                        "height": "100%",
                        "colorTheme": "dark",
                        "isTransparent": false,
                        "locale": "br",
                        "importanceFilter": "-1,0,1",
                        "countryFilter": "ar,au,br,ca,cn,fr,de,in,id,it,jp,kr,mx,ru,sa,za,tr,gb,us,eu"
                    }
                </script>
            </div>
            <!-- TradingView Widget END -->
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-md-12" align='center'>
            <img src="{{ asset('/public/img/IconsPng/Nasdaq Banner.png') }}" style="height: 100px" alt="">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-2" style="height: 800px">
            <!-- TradingView Widget BEGIN -->
            <div class="tradingview-widget-container">
                <div class="tradingview-widget-container__widget"></div>
                <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-stock-heatmap.js" async>
                    {
                        "exchanges": [],
                        "dataSource": "NASDAQ100",
                        "grouping": "sector",
                        "blockSize": "market_cap_basic",
                        "blockColor": "change|60",
                        "locale": "br",
                        "symbolUrl": "",
                        "colorTheme": "dark",
                        "hasTopBar": false,
                        "isDataSetEnabled": false,
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
    <div class="row mt-5">
        <div class="col-md-12" align='center'>
            <img src="{{ asset('/public/img/IconsPng/SP500 Banner.png') }}" style="height: 100px" alt="">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-2" style="height: 800px">
            <!-- TradingView Widget BEGIN -->
            <div class="tradingview-widget-container">
                <div class="tradingview-widget-container__widget"></div>
                <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-stock-heatmap.js" async>
                    {
                        "exchanges": [],
                        "dataSource": "SPX500",
                        "grouping": "sector",
                        "blockSize": "market_cap_basic",
                        "blockColor": "change|60",
                        "locale": "br",
                        "symbolUrl": "",
                        "colorTheme": "dark",
                        "hasTopBar": false,
                        "isDataSetEnabled": false,
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
    <div class="row mt-5">
        <div class="col-md-12" align='center'>
            <img src="{{ asset('/public/img/IconsPng/Dow Jones Banner.png') }}" style="height: 100px" alt="">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-2" style="height: 800px">
            <!-- TradingView Widget BEGIN -->
            <div class="tradingview-widget-container">
                <div class="tradingview-widget-container__widget"></div>
                <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-stock-heatmap.js" async>
                    {
                        "exchanges": [],
                        "dataSource": "DJCA",
                        "grouping": "sector",
                        "blockSize": "market_cap_basic",
                        "blockColor": "change|60",
                        "locale": "br",
                        "symbolUrl": "",
                        "colorTheme": "dark",
                        "hasTopBar": false,
                        "isDataSetEnabled": false,
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
    <div class="row mt-5">
        <div class="col-md-12" align='center'>
            <img src="{{ asset('/public/img/IconsPng/Ibovespa Banner.png') }}" style="height: 100px" alt="">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-2" style="height: 800px">
            <!-- TradingView Widget BEGIN -->
            <div class="tradingview-widget-container">
                <div class="tradingview-widget-container__widget"></div>
                <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-stock-heatmap.js" async>
                    {
                        "exchanges": [],
                        "dataSource": "IBOV",
                        "grouping": "sector",
                        "blockSize": "market_cap_basic",
                        "blockColor": "change|60",
                        "locale": "br",
                        "symbolUrl": "",
                        "colorTheme": "dark",
                        "hasTopBar": false,
                        "isDataSetEnabled": false,
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
    <div class="row mt-5">
        <div class="col-md-12" align='center'>
            <img src="{{ asset('/public/img/IconsPng/ETFs Banner.png') }}" style="height: 100px" alt="">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-2" style="height: 800px">
            <!-- TradingView Widget BEGIN -->
            <div class="tradingview-widget-container">
                <div class="tradingview-widget-container__widget"></div>
                <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-etf-heatmap.js" async>
                    {
                        "dataSource": "AllUSEtf",
                        "blockSize": "aum",
                        "blockColor": "change",
                        "grouping": "asset_class",
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
@endsection
