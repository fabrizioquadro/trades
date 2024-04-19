<!doctype html>
<html lang='en'>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css' integrity='sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T' crossorigin='anonymous'>
    <title>SmartMoneyMakers - Sistema Online</title>
    <style>
        .break { page-break-before: always; }
        <style>

        .table-responsive{
            min-height: 350px !important;
        }

        .dataTables_length, .dataTables_filter, .dataTables_info{
            color: #dcdcdc !important;
        }

        table, tr, td, th{
            border:none !important;
            font-size: 8px !important;
            vertical-align: bottom !important;
            text-align: center !important;
        }

        .btn-primary{
            border-color: #fdb528 !important;
            background-color: #fdb528 !important;
        }

        .btn-primary:hover{
            border-color: #eead2d !important;
            background-color: #eead2d !important;
        }

        input:checked{
            background-color: #fdb528 !important;
            border-color: #fdb528 !important;
        }

        .card{
            border: none !important;
        }
        </style>
    </style>
</head>
<body>
    <div class='container mb-2 mt-3'>
        <div class="row" style="background-color: #272a42; margin-bottom: 30px">
            <div class="col-md-3 pt-3 pb-2">
                <img src="{{ asset('/public/img/logoNaoCompleto.png') }}" class='img-fluid' alt="">
            </div>
        </div>
        @yield('conteudo')
    </div>
</body>
<script>
window.addEventListener('load', ()=>{
    print();
})
</script>
</html>
