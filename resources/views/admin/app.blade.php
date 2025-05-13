<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Administration MCF-PME')</title>

    <!-- Fonts and styles -->
    <link href="{{ asset('admindashboard/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">
    <link href="{{ asset('admindashboard/css/sb-admin-2.min.css') }}" rel="stylesheet">

    @stack('styles')
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <hr class="sidebar-divider my-0">

            @php
                $admin = Auth::guard('administrateur')->user();
                $dashboardRoute = '#';

                if ($admin) {
                    if ($admin->role === 'president') {
                        $dashboardRoute = route('administrateur_dashboard');
                    } elseif ($admin->role === 'comite_credit') {
                        $dashboardRoute = route('comite-credit.dashboard');
                    } elseif ($admin->role === 'caf') {
                        $dashboardRoute = route('dashboard.caf');
                    }
                }
            @endphp

            <li class="nav-item active">
                <a class="nav-link" href="{{ $dashboardRoute }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Tableau de bord</span>
                </a>
            </li>


            <hr class="sidebar-divider">
            <div class="sidebar-heading">Interface</div>
            
            @if ($admin->role === 'president')
                <!-- Liens -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('produits-financiers.index') }}">
                        <i class="fas fa-fw fa-chart-area"></i>
                        <span>Produits Financiers</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('demande-credits.index')}}">
                        <i class="fas fa-fw fa-file-alt"></i>
                        <span>Demande de crédits</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('membres.index') }}">
                        <i class="fas fa-fw fa-users"></i>
                        <span>Membres</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.contenus.index')}}">
                        <i class="fas fa-fw fa-book"></i>
                        <span>Contenu</span>
                    </a>
                </li>
            @endif

            @if ($admin->role === 'caf')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('caf.index') }}">
                        <i class="fas fa-fw fa-check-circle"></i>
                        <span>Vérification CAF</span>
                    </a>
                </li>
            @endif
            
            @if ($admin->role === 'comite_credit')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('comite-credit.index') }}">
                        <i class="fas fa-fw fa-chart-pie"></i>
                        <span>Comité de Crédit</span>
                    </a>
                </li>
            @endif

            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 shadow">

                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Search -->
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Rechercher..."
                                aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- User Info -->
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    {{ Auth::guard('administrateur')->user()->name ?? 'Administrateur' }}
                                </span>
                                <img class="img-profile rounded-circle"
                                    src="{{ asset('admindashboard/img/undraw_profile.svg') }}">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Déconnexion
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    @yield('content')
                </div>
                <!-- End Page Content -->

            </div>
            <!-- End Main Content -->

        </div>
        <!-- End Content Wrapper -->

    </div>
    <!-- End Page Wrapper -->

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('administrateur_logout') }}" method="POST" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutModalLabel">Confirmer la déconnexion</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Fermer">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Appuyez sur "Déconnexion" pour terminer votre session actuelle.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
                    <button class="btn btn-primary" type="submit">Déconnexion</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('admindashboard/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admindashboard/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admindashboard/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('admindashboard/js/sb-admin-2.min.js') }}"></script>

    @stack('scripts')
</body>

</html>