<!DOCTYPE html>

<html
  lang="pt-br"
  class="light-style layout-navbar-fixed layout-menu-fixed layout-compact"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="{{ asset('/public/assets/') }}"
  data-template="vertical-menu-template-no-customizer-starter">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Smart Money Makers - Alunos - Sistema Online</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('/public/img/logoCompleto.png') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&ampdisplay=swap"
      rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('/public/assets/vendor/fonts/materialdesignicons.css') }}" />
    <!-- <link rel="stylesheet" href="{{ asset('/public/assets/') }}vendor/fonts/flag-icons.css" /> -->


    <!-- Menu waves for no-customizer fix -->
    <link rel="stylesheet" href="{{ asset('/public/assets/vendor/libs/node-waves/node-waves.css') }}" />
    <link rel="stylesheet" href="{{ asset('/public/assets/vendor/libs/select2/select2.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('/public/assets/vendor/css/rtl/core-dark.css') }}" />
    <link rel="stylesheet" href="{{ asset('/public/assets/vendor/css/rtl/theme-raspberry-dark.css') }}" />
    <link rel="stylesheet" href="{{ asset('/public/assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('/public/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/public/css/bootstrap-combobox.css') }}" />
    <link rel="stylesheet" href="{{ asset('/public/assets/vendor/libs/apex-charts/apex-charts.css') }}" />
    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('/public/assets/vendor/js/helpers.js') }}"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('/public/assets/js/config.js') }}"></script>

    <!-- Core JS -->
    <!-- build:js {{ asset('/public/assets/') }}vendor/js/core.js -->
    <!-- <script src="{{ asset('/public/assets/vendor/libs/jquery/jquery.js') }}"></script> -->

    <script src="{{ asset('/public/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
    <script src="{{ asset('/public/assets/vendor/libs/chartjs/chartjs.js') }}"></script>
    <style>
        .table-responsive{
            min-height: 350px !important;
        }

        .tabela-index tr{
            background-color: #272a42 !important;
        }

        .dataTables_length, .dataTables_filter, .dataTables_info{
            color: #fff !important;
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

    </style>

  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="{{ route('aluno.dashboard') }}" class="app-brand-link">
              <span class="app-brand-logo demo">
                <span style="color: var(--bs-primary)">
                    <img src="{{ asset('/public/img/logoNaoCompleto.png') }}" style='height: 60px' alt="">
                </span>
              </span>
              <!-- <span class="app-brand-text demo menu-text fw-bold ms-2">SmartMoneyMakers</span> -->
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
              <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M11.4854 4.88844C11.0081 4.41121 10.2344 4.41121 9.75715 4.88844L4.51028 10.1353C4.03297 10.6126 4.03297 11.3865 4.51028 11.8638L9.75715 17.1107C10.2344 17.5879 11.0081 17.5879 11.4854 17.1107C11.9626 16.6334 11.9626 15.8597 11.4854 15.3824L7.96672 11.8638C7.48942 11.3865 7.48942 10.6126 7.96672 10.1353L11.4854 6.61667C11.9626 6.13943 11.9626 5.36568 11.4854 4.88844Z"
                  fill="currentColor"
                  fill-opacity="0.6" />
                <path
                  d="M15.8683 4.88844L10.6214 10.1353C10.1441 10.6126 10.1441 11.3865 10.6214 11.8638L15.8683 17.1107C16.3455 17.5879 17.1192 17.5879 17.5965 17.1107C18.0737 16.6334 18.0737 15.8597 17.5965 15.3824L14.0778 11.8638C13.6005 11.3865 13.6005 10.6126 14.0778 10.1353L17.5965 6.61667C18.0737 6.13943 18.0737 5.36568 17.5965 4.88844C17.1192 4.41121 16.3455 4.41121 15.8683 4.88844Z"
                  fill="currentColor"
                  fill-opacity="0.38" />
              </svg>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <li class="menu-item">
              <a href="{{ route('aluno.dashboard') }}" class="menu-link">
                <img src="{{ asset('/public/img/Icons/Dashboard.svg') }}" height="40px" alt="" style="margin-right: 10px">
                <div data-i18n="Email">Dashboard</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="{{ route('aluno.matrizDecisao') }}" class="menu-link">
                <img src="{{ asset('/public/img/Icons/Matriz Decisao.svg') }}" height="40px" alt="" style="margin-right: 10px">
                <div data-i18n="Email">Matriz Decisão</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="{{ route('aluno.contas') }}" class="menu-link">
                <img src="{{ asset('/public/img/Icons/Contas1.svg') }}" height="40px" alt="" style="margin-right: 10px">
                <div data-i18n="Email">Contas/Corretoras</div>
              </a>
            </li>
            <li class="menu-item" style="">
              <a href="javascript:void(0);" class="menu-link menu-toggle waves-effect">
                <img src="{{ asset('/public/img/Icons/Financeiro.svg') }}" height="40px" alt="" style="margin-right: 10px">
                <div data-i18n="Academy">Financeiro</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="{{ route('aluno.financeiro.extratoConta') }}" class="menu-link">
                    <div data-i18n="Dashboard">Extrato Conta</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="{{ route('aluno.financeiro.resumoGlobal') }}" class="menu-link">
                    <div data-i18n="Dashboard">Resumo Global</div>
                  </a>
                </li>
              </ul>
            </li>
            <li class="menu-item">
              <a href="{{ route('aluno.ativos') }}" class="menu-link">
                <img src="{{ asset('/public/img/Icons/Ativos.svg') }}" height="40px" alt="" style="margin-right: 10px">
                <div data-i18n="Email">Ativos</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="{{ route('aluno.trades') }}" class="menu-link">
                <img src="{{ asset('/public/img/Icons/Trades.svg') }}" height="40px" alt="" style="margin-right: 10px">
                <div data-i18n="Email">Trades</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="{{ route('aluno.resultados') }}" class="menu-link">
                <img src="{{ asset('/public/img/Icons/OnePageReport.svg') }}" height="40px" alt="" style="margin-right: 10px">
                <div data-i18n="Email">One Page Report</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="{{ route('aluno.mensagens') }}" class="menu-link">
                <img src="{{ asset('/public/img/Icons/Mensagens.svg') }}" height="40px" alt="" style="margin-right: 10px">
                <div data-i18n="Email">Mensagens</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="{{ route('aluno.tutoriais') }}" class="menu-link">
                <img src="{{ asset('/public/img/Icons/Tutoriais.svg') }}" height="40px" alt="" style="margin-right: 10px">
                <div data-i18n="Email">Tutoriais</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="{{ route('aluno.faq') }}" class="menu-link">
                <img src="{{ asset('/public/img/Icons/PerguntasFrequentes.svg') }}" height="40px" alt="" style="margin-right: 10px">
                <div data-i18n="Email">FAQ</div>
              </a>
            </li>

          </ul>
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="mdi mdi-menu mdi-24px"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              <!-- Search
              <div class="navbar-nav align-items-center">
                <div class="nav-item navbar-search-wrapper mb-0">
                  <a class="nav-item nav-link search-toggler fw-normal px-0" href="javascript:void(0);">
                    <i class="mdi mdi-magnify mdi-24px scaleX-n1-rtl"></i>
                    <span class="d-none d-md-inline-block text-muted">Search (Ctrl+/)</span>
                  </a>
                </div>
              </div>
               /Search -->

              <ul class="navbar-nav flex-row align-items-center ms-auto">
                @if(verificaMensagensAluno())
                    <li class="nav-item">
                        <a href="{{ route('aluno.mensagens') }}" title='Mensagens'>
                            <img style='height: 40px' src="{{ asset('/public/img/Icons/Notificacoes.svg') }}" alt="">
                        </a>
                    </li>
                @endif
                <!-- User -->
                @php
                $aluno = session()->get('aluno');
                if($aluno->imagem == ""){
                    $avatar = "/public/assets/img/avatars/1.png";
                }
                else{
                    $avatar = "/public/img/alunos/".$aluno->imagem."?".date('YmdHis');
                }
                @endphp
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      <img src="{{ asset($avatar) }}" alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="pages-account-settings-account.html">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                              <img src="{{ asset($avatar) }}" alt class="w-px-40 h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-medium d-block">{{ $aluno->nmAluno }}</span>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="{{ route('aluno.perfil') }}">
                        <i class="mdi mdi-account-outline me-2"></i>
                        <span class="align-middle">Perfil</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="{{ route('aluno.perfil.settings') }}">
                        <i class="mdi mdi-cog-outline me-2"></i>
                        <span class="align-middle">Settings</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="{{ route('aluno.perfil.alterarSenha') }}">
                        <i class="mdi mdi-lock-reset me-2"></i>
                        <span class="align-middle">Alterar Senha</span>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="{{ route('aluno.logout') }}">
                        <i class="mdi mdi-logout me-2"></i>
                        <span class="align-middle">Sair</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <!--/ User -->
              </ul>
            </div>

            <!-- Search Small Screens -->
            <div class="navbar-search-wrapper search-input-wrapper d-none">
              <input
                type="text"
                class="form-control search-input container-xxl border-0"
                placeholder="Search..."
                aria-label="Search..." />
              <i class="mdi mdi-close search-toggler cursor-pointer"></i>
            </div>
          </nav>

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            @yield('conteudo')
            <!-- / Content -->

            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl">
                <div class="footer-container d-flex align-items-center justify-content-between py-3 flex-md-row flex-column">
                  <div class="d-none d-lg-inline-block">
                    ©
                    <script>
                      document.write(new Date().getFullYear());
                    </script>
                    Smart Money Makers - Sistema Online<br>Desenvolvido por WEBEPEL SOLUÇÔES DIGITAIS
                  </div>
                </div>
              </div>
            </footer>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>

      <!-- Drag Target Area To SlideIn Menu On Small Screens -->
      <div class="drag-target"></div>
    </div>
    <!-- / Layout wrapper -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="{{ asset('/public/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('/public/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('/public/assets/vendor/libs/node-waves/node-waves.js') }}"></script>
    <script src="{{ asset('/public/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('/public/assets/vendor/libs/hammer/hammer.js') }}"></script>
    <script src="{{ asset('/public/assets/vendor/libs/select2/select2.js') }}"></script>

    <script src="{{ asset('/public/assets/vendor/js/menu.js') }}"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="{{ asset('/public/assets/js/main.js') }}"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('/public/js/script.js') }}"></script>
    <script src="{{ asset('/public/js/bootstrap-combobox.js') }}"></script>

    <!-- Page JS -->
  </body>
</html>
