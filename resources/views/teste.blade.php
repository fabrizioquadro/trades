<!doctype html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Stock Details</title>
		<style>
			:root {
				--gap-size: 32px;
				box-sizing: border-box;
				font-family: -apple-system, BlinkMacSystemFont, 'Trebuchet MS', Roboto,
					Ubuntu, sans-serif;
				color: #000;
			}

			* {
				box-sizing: border-box;
			}

			body {
				margin: 0;
				padding: 0;
				display: flex;
				flex-direction: column;
				align-items: center;
				background: #272a42;
			}

			header,
			footer {
				display: flex;
				width: 100%;
				align-items: center;
				background: rgba(0, 0, 0, 0.05);
				gap: 12px;
			}

			header {
				justify-content: space-between;
				padding: 0 var(--gap-size);
				gap: calc(var(--gap-size) * 2);
				box-shadow: rgba(0, 0, 0, 0.05) 0 2px 6px 0;
				flex-direction: row;
				z-index: 1;
			}

			header #site-logo {
				font-weight: 600;
				font-size: 32px;
				padding: 16px;
				background: var(
					--18-promo-gradient-02,
					linear-gradient(90deg, #00bce5 0%, #2962ff 100%)
				);
				-webkit-text-fill-color: transparent;
				-webkit-background-clip: text;
				background-clip: text;
			}

			header input[type='search'] {
				padding: 10px;
				width: 100%;
				height: 32px;
				max-width: 400px;
				border: 1px solid #ccc;
				border-radius: 20px;
			}

			footer {
				flex-direction: column;
				padding: calc(var(--gap-size) * 0.5) var(--gap-size);
				margin-top: var(--gap-size);
				border-top: solid 2px rgba(0, 0, 0, 0.1);
				justify-content: center;
			}

			footer p,
			#powered-by-tv p {
				margin: 0;
				font-size: 12px;
				color: rgba(0, 0, 0, 0.6);
			}

			main {
				display: grid;
				width: 100%;
				padding: 0 calc(var(--gap-size) * 0.5);
				max-width: 960px;
				grid-template-columns: 1fr 1fr;
				grid-gap: var(--gap-size);
			}

			.span-full-grid,
			#symbol-info,
			#advanced-chart,
			#company-profile,
			#fundamental-data {
				grid-column: span 2;
			}

			.span-one-column,
			#technical-analysis,
			#top-stories,
			#powered-by-tv {
				grid-column: span 1;
			}

			#ticker-tape {
				width: 100%;
				margin-bottom: var(--gap-size);
			}

			#advanced-chart {
				height: 500px;
			}

			#company-profile {
				height:390px;
			}

			#fundamental-data {
				height: 490px;
			}

			#technical-analysis,
			#top-stories {
				height: 425px;
			}

			#powered-by-tv {
				display: flex;
				background: #f8f9fd;
				border: solid 1px #e0e3eb;
				text-align: justify;
				flex-direction: column;
				gap: 8px;
				font-size: 14px;
				padding: 16px;
				border-radius: 6px;
			}

			#powered-by-tv a, #powered-by-tv a:visited {
				color: #2962ff;
			}

			@media (max-width: 800px) {
				main > section,
				.span-full-grid,
				#technical-analysis,
				#top-stories,
				#powered-by-tv {
					grid-column: span 2;
				}
			}
		</style>
	</head>
	<body>
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
                                "colorTheme": "dark",
                                "isTransparent": true,
                                "displayMode": "compact",
                                "locale": "br"
                            }
  </script>
</div>
<!-- TradingView Widget END -->
        <main>
			<section id="logo">
			</section>
			<section id="symbol-info">
			</section>
			<section style="height: 1000px" id="advanced-chart">
			</section>
			<section style="height: 500px" id="company-profile">
			</section>
			<section style="height: 800px" id="fundamental-data">
			</section>
			<section id="technical-analysis">
			</section>
			<section id="top-stories">
			</section>
		</main>
		<footer>
			<p style="color:#fff">
				As informações contídas nessa página são extraídas da plataforma TradingView e nenhuma recomendação de compra ou venda podem ser realizadas apenas com estas informações.
			</p>
		</footer>
	</body>

	<template id="symbol-info-template">
		<!-- TradingView Widget BEGIN -->
		<div class="tradingview-widget-container">
			<div class="tradingview-widget-container__widget"></div>
			<script
				type="text/javascript"
				src="https://s3.tradingview.com/external-embedding/embed-widget-symbol-info.js"
				async
			>
				{
				"symbol": "NASDAQ:NVDA",
				"width": "100%",
				"locale": "en",
				"colorTheme": "dark",
				"isTransparent": false
				 }
			</script>
		</div>
		<!-- TradingView Widget END -->
	</template>
	<template id="advanced-chart-template">
        <!-- TradingView Widget BEGIN -->
<div class="tradingview-widget-container" style="height:100%;width:100%">
  <div class="tradingview-widget-container__widget" style="height:calc(100% - 32px);width:100%"></div>
  <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-advanced-chart.js" async>
  {
  "autosize": true,
  "symbol": "CME_MINI:MNQ1!",
  "interval": "5",
  "timezone": "Etc/UTC",
  "theme": "dark",
  "style": "1",
  "locale": "br",
  "backgroundColor": "rgba(0, 0, 0, 1)",
  "gridColor": "rgba(0, 0, 0, 0)",
  "withdateranges": true,
  "hide_side_toolbar": false,
  "allow_symbol_change": true,
  "watchlist": [
    "CME_MINI:MNQ1!",
    "CME_MINI:MES1!",
    "EUREX:FDAX1!",
    "EUREX:FTUK1!",
    "HKEX:HSI1!",
    "FX_IDC:GBPUSD",
    "FX_IDC:EURUSD",
    "FX_IDC:JPYUSD",
    "CME:BTC1!",
    "CME:ETH1!"
  ],
  "details": true,
  "calendar": false,
  "studies": [
    "STD;VWAP"
  ],
  "show_popup_button": true,
  "popup_width": "1000",
  "popup_height": "650",
  "support_host": "https://www.tradingview.com"
}
  </script>
</div>
<!-- TradingView Widget END -->
	</template>
	<template id="company-profile-template">
		<!-- TradingView Widget BEGIN -->
		<div class="tradingview-widget-container">
			<div class="tradingview-widget-container__widget"></div>
			<script
				type="text/javascript"
				src="https://s3.tradingview.com/external-embedding/embed-widget-symbol-profile.js"
				async
			>
				  {
				  "width": "100%",
				  "height": "100%",
				  "colorTheme": "dark",
				  "isTransparent": true,
				  "symbol": "NASDAQ:NVDA",
				  "locale": "br"
				}
			</script>
		</div>
		<!-- TradingView Widget END -->
	</template>
	<template id="fundamental-data-template">
        <!-- TradingView Widget BEGIN -->
<div class="tradingview-widget-container">
  <div class="tradingview-widget-container__widget"></div>
  <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-financials.js" async>
  {
  "isTransparent": true,
  "largeChartUrl": "",
  "displayMode": "regular",
  "width": "100%",
  "height": "100%",
  "colorTheme": "dark",
  "symbol": "NASDAQ:NVDA",
  "locale": "br"
}
  </script>
</div>
<!-- TradingView Widget END -->
	</template>
	<template id="technical-analysis-template">
		<!-- TradingView Widget BEGIN -->
		<div class="tradingview-widget-container">
			<div class="tradingview-widget-container__widget"></div>
			<script
				type="text/javascript"
				src="https://s3.tradingview.com/external-embedding/embed-widget-technical-analysis.js"
				async
			>
				{
				"interval": "15m",
				"width": "100%",
				"isTransparent": true,
				"height": "100%",
				"symbol": "NASDAQ:NVDA",
				"showIntervalTabs": true,
				"displayMode": "single",
				"locale": "en",
				"colorTheme": "dark"
				 }
			</script>
		</div>
		<!-- TradingView Widget END -->
	</template>
	<template id="top-stories-template">
		<!-- TradingView Widget BEGIN -->
		<div class="tradingview-widget-container">
			<div class="tradingview-widget-container__widget"></div>
			<script
				type="text/javascript"
				src="https://s3.tradingview.com/external-embedding/embed-widget-timeline.js"
				async
			>
				  {
				  "feedMode": "symbol",
				  "symbol": "NASDAQ:NVDA",
				  "colorTheme": "dark",
				  "isTransparent": true,
				  "displayMode": "regular",
				  "width": "100%",
				  "height": "100%",
				  "locale": "en"
				}
			</script>
		</div>
		<!-- TradingView Widget END -->
	</template>
	<script>
		function getQueryParam(param) {
			let urlSearchParams = new URLSearchParams(window.location.search);
			return urlSearchParams.get(param);
		}
		function readSymbolFromQueryString() {
			return getQueryParam('tvwidgetsymbol');
		}

		function cloneTemplateInto(templateId, targetId, rewrites) {
			const tmpl = document.querySelector(`#${templateId}`);
			if (!tmpl) return;
			const target = document.querySelector(`#${targetId}`);
			if (!target) return;
			target.innerText = '';
			const clone = tmpl.content.cloneNode(true);
			if (rewrites) {
				const script = clone.querySelector('script');
				script.textContent = rewrites(script.textContent);
			}
			target.appendChild(clone);
		}
		const symbol = readSymbolFromQueryString() || 'NASDAQ:NVDA';
		function setSymbol(scriptContent) {
			return scriptContent.replace(/"symbol": "([^"]*)"/g, () => {
				return `"symbol": "${symbol}"`;
			});
		}
		cloneTemplateInto('symbol-info-template', 'symbol-info', setSymbol);
		cloneTemplateInto('advanced-chart-template', 'advanced-chart');
		cloneTemplateInto('company-profile-template', 'company-profile', setSymbol);
		cloneTemplateInto('fundamental-data-template', 'fundamental-data', setSymbol);
		cloneTemplateInto('technical-analysis-template', 'technical-analysis', setSymbol);
		cloneTemplateInto('top-stories-template', 'top-stories', setSymbol);
		if (symbol) {
			document.title = `Stock Details - ${symbol}`;
		}
	</script>
</html>
