@extends('admin.app')

@section('title', 'Tableau de bord - Comité de Crédit')
@section('content')
    <div class="container-fluid">
        <div class="row mb-4">
            <!-- Cartes de statistiques -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Demandes totales</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total'] }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    En attente de décision</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['en_attente'] }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clock fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Crédits approuvés</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['approuves'] }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                    Montant total accordé</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ number_format($stats['montant_total'], 0, ',', ' ') }} FCFA
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-money-bill-wave fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Dernières décisions -->
            <div class="col-xl-12 col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Dernières décisions</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Membre</th>
                                        <th>Type</th>
                                        <th>Montant</th>
                                        <th>Décision</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($decisions as $decision)
                                        <tr>
                                            <td>{{ $decision->updated_at->format('d/m/Y') }}</td>
                                            <td>{{ $decision->membre->name }}</td>
                                            <td>{{ $decision->type_credit }}</td>
                                            <td>{{ number_format($decision->montant, 0, ',', ' ') }} FCFA</td>
                                            <td>
                                                <span
                                                    class="badge badge-{{ $decision->statut === 'Approuvée' ? 'success' : 'danger' }}">
                                                    {{ $decision->statut }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Demandes en attente de décision -->
                <div class="col-xl-12">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Demandes en attente de décision</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Référence</th>
                                            <th>Client</th>
                                            <th>Type</th>
                                            <th>Montant</th>
                                            <th>Date analyse CAF</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($enAttente as $demande)
                                            <tr>
                                                <td>{{ $demande->reference }}</td>
                                                <td>{{ $demande->client->nom }}</td>
                                                <td>{{ $demande->type_credit }}</td>
                                                <td>{{ number_format($demande->montant, 0, ',', ' ') }} FCFA</td>
                                                <td>{{ \Carbon\Carbon::parse($demande->date_analyse_caf)->format('d/m/Y') }}
                                                </td>
                                                <td>
                                                    <a href="{{ route('cc.show', $demande->id) }}"
                                                        class="btn btn-sm btn-primary">
                                                        Voir
                                                    </a>
                                                    <!-- <a href="{{ route('cc.decision', $demande->id) }}"
                                                                class="btn btn-sm btn-success">
                                                                Décider
                                                            </a> -->
                                                </td>
                                            </tr>
                                        @endforeach
                                        @if($enAttente->isEmpty())
                                            <tr>
                                                <td colspan="6" class="text-center">Aucune demande en attente</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-end">
                                    {{ $enAttente->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    @section('scripts')
        <script src="{{ asset('admindashboard/vendor/chart.js/Chart.min.js') }}"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Graphique circulaire
                var ctx = document.getElementById("typeCreditChart");
                var typeCreditChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: {!! json_encode($byType->pluck('type_credit')) !!},
                        datasets: [{
                            data: {!! json_encode($byType->pluck('total')) !!},
                            backgroundColor: [
                                '#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b',
                                '#858796', '#5a5c69', '#2e59d9', '#17a673', '#2c9faf'
                            ],
                            hoverBackgroundColor: [
                                '#2e59d9', '#17a673', '#2c9faf', '#dda20a', '#be2617',
                                '#656776', '#3a3b45', '#1840b3', '#0e8c5a', '#1d828f'
                            ],
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
    @endsection
@endsection