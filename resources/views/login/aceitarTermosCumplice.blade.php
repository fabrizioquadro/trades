<!doctype html>
<html lang="pt-BR">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <title>Smart Money Metrics - Aceite Termos Cumplice</title>
    </head>
    <body style="background-color: #272a42">
        <form action="{{ route('aluno.aceitarTermosCumpliceSet') }}" method="post">
            @csrf
            <div class="container">
                <div class="row mt-5">
                    <div class="col-md-12" align='center'>
                        <img src="{{ asset('/public/img/logoCompleto.png') }}" height="120px" alt="">
                    </div>
                </div>
                @if(!$aluno->aceitePrivacyPolice)
                    <div class="card text-white bg-dark mb-3 mt-5">
                        <div class="card-header text-center">
                            <img src="{{ asset('/public/img/IconsPng/Privacy Policy 2.png') }}" height="80px" alt="">
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12" style="height: 300px; overflow-y: scroll;">
                                    <p class="card-text">{!! $agreements->termosPrivacyPolicy !!}</p>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-md-12">
                                    <input type="checkbox" required name="aceiteTermosPrivacyPolicy" value="sim">
                                    <label for="">Aceito os termos</label>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @if(!$aluno->aceiteCookiesPolice)
                    <div class="card text-white bg-dark mb-3">
                        <div class="card-header text-center">
                            <img src="{{ asset('/public/img/IconsPng/Cookies Policy.png') }}" height="80px" alt="">
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12" style="height: 300px; overflow-y: scroll;">
                                    <p class="card-text">{!! $agreements->cookiesPolicy !!}</p>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-md-12">
                                    <input type="checkbox" required name="aceiteCookiesPolicy" value="sim">
                                    <label for="">Aceito os termos</label>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @if(!$aluno->aceiteTermsAndConditions)
                    <div class="card text-white bg-dark mb-3">
                        <div class="card-header text-center">
                            <img src="{{ asset('/public/img/IconsPng/Terms Conditions.png') }}" height="80px" alt="">
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12" style="height: 300px; overflow-y: scroll;">
                                    <p class="card-text">{!! $agreements->termsAndConditions !!}</p>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-md-12">
                                    <input type="checkbox" required name="termsAndConditions" value="sim">
                                    <label for="">Aceito os termos</label>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @if(!$aluno->aceiteNonDisclosure)
                    <div class="card text-white bg-dark mb-3">
                        <div class="card-header text-center">
                            <img src="{{ asset('/public/img/IconsPng/Non-Disclosure.png') }}" height="80px" alt="">
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12" style="height: 300px; overflow-y: scroll;">
                                    <p class="card-text">{!! $agreements->nonDisclosure !!}</p>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-md-12">
                                    <input type="checkbox" required name="nonDisclosure" value="sim">
                                    <label for="">Aceito os termos</label>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @if(!$aluno->aceiteRiskWarning)
                    <div class="card text-white bg-dark mb-3">
                        <div class="card-header text-center">
                            <img src="{{ asset('/public/img/IconsPng/Risk Warning.png') }}" height="80px" alt="">
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12" style="height: 300px; overflow-y: scroll;">
                                    <p class="card-text">{!! $agreements->riskWarning !!}</p>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-md-12">
                                    <input type="checkbox" required name="riskWarning" value="sim">
                                    <label for="">Aceito os termos</label>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @if(!$aluno->setarNovaSenha)
                    <div class="card text-white bg-dark mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Nova Senha de Acesso</h5>
                            <div class="row align-items-end">
                                <div class="col md-6 form-group">
                                    <label for="">Informe a sua nova senha de acesso ao sistema:</label>
                                    <input type="password" required name="dsSenha" class="form-control">
                                </div>
                                <div class="col md-6 form-group">
                                    <input type="submit" value="Salvar" class="btn btn-primary">
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                <div class="row">
                    <div class="col-md-12">
                        <input type="submit" value="Salvar" class="btn btn-primary">
                    </div>
                </div>
                @endif
            </div>
        </form>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>
