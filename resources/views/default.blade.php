<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{$titulo}}</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="/vendors/feather/feather.css">
    <link rel="stylesheet" href="/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="/vendors/ti-icons/css/themify-icons.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->

    <link rel="stylesheet" href="/css/vertical-layout-light/style.css">

    <link rel="stylesheet" href="/vendors/select2/select2.min.css">
    <link rel="stylesheet" href="/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="/img/logo.png"/>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/font-awesome-line-awesome/css/all.min.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
</head>
<body>
    <div class="container-scroller">

        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo mr-5" href="/"><img style="width: auto; height: 80px;" src="/img/logo.png" class="mr-2" alt="logo"/></a>
                <a class="navbar-brand brand-logo-mini" href="/"><img src="/img/logo.png" alt="logo"/></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="icon-menu"></span>
                </button>

                <ul class="navbar-nav navbar-nav-right">

                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                            Perfil
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">

                            <a class="dropdown-item" >
                                <i class="ti-power-off text-primary"></i>
                                Sair
                            </a>
                        </div>
                    </li>

                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                    <span class="icon-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">

            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">

                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                            <i class="icon-layout menu-icon"></i>
                            <span class="menu-title">Cadastros</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="ui-basic">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="/categorias">Categorias</a></li>
                                <li class="nav-item"> <a class="nav-link" href="/produtos">Produtos</a></li>
                                <li class="nav-item"> <a class="nav-link" href="/cidades">Cidades</a></li>
                                <li class="nav-item"> <a class="nav-link" href="/clientes">Clientes</a></li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                            <i class="icon-bag menu-icon"></i>
                            <span class="menu-title">Vendas</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="ui-basic">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="/vendas">Lista</a></li>
                                <li class="nav-item"> <a class="nav-link" href="/vendas/new">Nova</a></li>
                                
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/emitente">
                            <i class="icon-paper menu-icon"></i>
                            <span class="menu-title">Emitente</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-12"> 
                            @if(session()->has('sucesso'))
                            <div class="alert alert-success alert-dismissible fade show col-12" role="alert">
                                {{ session()->get('sucesso') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif
                            @if(session()->has('erro'))
                            <div class="alert alert-danger alert-dismissible fade show col-12" role="alert">
                                {{ session()->get('erro') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif
                        </div>

                        @yield('body')
                    </div>
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <div class="theme-setting-wrapper">
                    <div id="settings-trigger"><i class="ti-settings"></i></div>
                    <div id="theme-settings" class="settings-panel">
                      <i class="settings-close ti-close"></i>
                      <p class="settings-heading">Menu lateral</p>
                      <div class="sidebar-bg-options selected" id="sidebar-light-theme"><div class="img-ss rounded-circle bg-light border mr-3"></div>Light</div>
                      <div class="sidebar-bg-options" id="sidebar-dark-theme"><div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark</div>
                      <p class="settings-heading mt-2">Superior</p>
                      <div class="color-tiles mx-0 px-4">
                        <div class="tiles success"></div>
                        <div class="tiles warning"></div>
                        <div class="tiles danger"></div>
                        <div class="tiles info"></div>
                        <div class="tiles dark"></div>
                        <div class="tiles default"></div>
                    </div>
                </div>
            </div>
            <footer class="footer">
                <div class="d-sm-flex justify-content-center justify-content-sm-between">
                    <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © {{date('Y')}}.  Slym</span>
                </div>

            </footer> 
            <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>   
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->

<!-- plugins:js -->
<script src="/vendors/js/vendor.bundle.base.js"></script>
<script src="/vendors/chart.js/Chart.min.js"></script>
<script src="/vendors/datatables.net/jquery.dataTables.js"></script>
<script src="/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
<script src="/js_theme/dataTables.select.min.js"></script>

<script src="/js_theme/off-canvas.js"></script>
<script src="/js_theme/hoverable-collapse.js"></script>
<script src="/js_theme/template.js"></script>
<script src="/js_theme/settings.js"></script>
<script src="/js_theme/todolist.js"></script>
<script src="/vendors/select2/select2.min.js"></script>
<script src="/js_theme/select2.js"></script>
<script src="/js_theme/dashboard.js"></script>
<script src="/js_theme/Chart.roundedBarCharts.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="/js/jquery.mask.min.js"></script>
<script src="/js/app.js"></script>

@yield('javascript')
</body>

</html>

