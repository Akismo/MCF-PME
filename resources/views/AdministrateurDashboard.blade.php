@extends('admin.app')

@section('title', 'Tableau de bord')

@section('content')

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tableau de Bord Administrateur</h1>
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i> Générer Rapport
        </a> -->
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Membres Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Membres Inscrits</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ App\Models\Membre::count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Produits Financiers Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Produits Financiers</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ App\Models\ProduitFinancier::count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-money-bill-wave fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Demandes de Crédit Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Demandes de Crédit</div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                        {{ App\Models\DemandeCredit::count() }}
                                    </div>
                                </div>
                                <div class="col">
                                    @php
                                        $totalDemandes = App\Models\DemandeCredit::count();
                                        $demandesEnAttente = App\Models\DemandeCredit::where('statut', 'en attente')->count();
                                        $pourcentage = $totalDemandes > 0 ? ($demandesEnAttente / $totalDemandes) * 100 : 0;
                                    @endphp
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar"
                                            style="width: {{ $pourcentage }}%" 
                                            aria-valuenow="{{ $pourcentage }}" 
                                            aria-valuemin="0"
                                            aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contenus Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Contenus Publiés</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ App\Models\Contenu::count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-newspaper fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Derniers Contenus -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Derniers Contenus Publiés</h6>
                    <a href="{{ route('admin.contenus.index') }}" class="btn btn-sm btn-link">Voir tout</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Titre</th>
                                    <th>Type</th>
                                    <th>Date Publication</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(App\Models\Contenu::latest()->take(5)->get() as $contenu)
                                <tr>
                                    <td>{{ Str::limit($contenu->titre, 30) }}</td>
                                    <td>{{ $contenu->type }}</td>
                                    <td>{{ $contenu->date_publication->format('d/m/Y') }}</td>
                                    <td>
                                        <a href="{{ route('admin.contenus.show', $contenu->id) }}" class="btn btn-info btn-circle btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Demandes de Crédit -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Statut des Demandes</h6>
                    <a href="{{ route('demande-credits.index') }}" class="btn btn-sm btn-link">Voir tout</a>
                </div>
                <div class="card-body">
                    @php
                        $demandes = App\Models\DemandeCredit::select('statut', \DB::raw('count(*) as total'))
                            ->groupBy('statut')
                            ->get();
                    @endphp
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="demandesPieChart"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        @foreach($demandes as $demande)
                        <span class="mr-2">
                            <i class="fas fa-circle 
                                @if($demande->statut == 'accepté') text-success
                                @elseif($demande->statut == 'rejeté') text-danger
                                @else text-warning @endif"></i> 
                            {{ ucfirst($demande->statut) }}
                        </span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Derniers Membres -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Derniers Membres Inscrits</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Email</th>
                                    <th>Date Inscription</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(App\Models\Membre::latest()->take(5)->get() as $membre)
                                <tr>
                                    <td>{{ $membre->name }} {{ $membre->prenom }}</td>
                                    <td>{{ $membre->email }}</td>
                                    <td>{{ $membre->date_inscription->format('d/m/Y') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Produits Financiers -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Produits Financiers</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Date Création</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(App\Models\ProduitFinancier::latest()->take(5)->get() as $produit)
                                <tr>
                                    <td>{{ Str::limit($produit->nom, 20) }}</td>
                                    <td>{{ $produit->date_creation->format('d/m/Y') }}</td>
                                    <td>
                                        <a href="{{ route('produits-financiers.show', $produit->id) }}" class="btn btn-info btn-circle btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
// Diagramme circulaire des demandes de crédit
document.addEventListener('DOMContentLoaded', function() {
    var ctx = document.getElementById('demandesPieChart');
    var demandesData = @json($demandes);
    
    var labels = demandesData.map(item => item.statut);
    var data = demandesData.map(item => item.total);
    var backgroundColors = demandesData.map(item => 
        item.statut == 'accepté' ? '#1cc88a' : 
        (item.statut == 'rejeté' ? '#e74a3b' : '#f6c23e')
    );

    var myPieChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: labels,
            datasets: [{
                data: data,
                backgroundColor: backgroundColors,
                hoverBackgroundColor: backgroundColors,
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
            },
            legend: {
                display: false
            },
            cutoutPercentage: 80,
        },
    });
});
</script>
@endpush

@endsection
