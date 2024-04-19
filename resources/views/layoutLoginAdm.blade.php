
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Smart Money Makers - Sistema Online</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet">
    <link href="{{ asset('/public/dist-assets/css/themes/lite-blue.css')}}" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="{{ asset('/public/img/logoCompleto.png') }}" />
    <!-- <link rel="icon" type="image/x-icon" href="/img/favcon.jpeg"> -->
    <style>
        .o-hidden{
            background-color: rgba(255,255,255,0.0) !important;
        }

        .imgLogin{
            height: 200px !important;
        }

        .colorAmarelo{
            color: #ffb149 !important;
        }

        .colorBranco{
            color: #fff !important;
        }

        .btn-primary{
            border-color: #e67225 !important;
            background-color: #e67225 !important;
        }

        @media (max-width: 500px){
            .imgLogin{
                height: 100px !important;
            }
        }
    </style>
</head>
<div class="auth-layout-wrap" style="background-image: url({{ asset('/public//img/loginAdminSmartMoney.png') }});background-position: center;">
    <div class="auth-content">
        <div class="card o-hidden" style="box-shadow: none !important">
            @yield('conteudo')
        </div>
    </div>
</div>
