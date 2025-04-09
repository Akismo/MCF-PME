@extends('membre.app')

@section('title', 'Tableau de bord')
@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tableau de bord</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Statut dernière demande -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Statut dernière demande</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                @if($derniereDemande)
                                    {{ ucfirst(str_replace('_', ' ', $derniereDemande->statut)) }}
                                @else
                                    Aucune demande
                                @endif
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Nouvelle demande -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Nouvelle demande</div>
                            <a href="{{ route('membre_nouvelle_demande') }}" class="btn btn-success btn-sm">
                                <i class="fas fa-plus"></i> Soumettre une demande
                            </a>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-plus-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Profil -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Mon profil</div>
                            <div class="h6 mb-0 font-weight-bold text-gray-800">
                                {{ Auth::guard('membre')->user()->name }} {{ Auth::guard('membre')->user()->prenom }}
                            </div>
                            <div class="mt-2">
                                <a href="{{ route('membre_profile') }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-user-edit"></i> Mettre à jour
                                </a>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Dernières demandes -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Mes dernières demandes</h6>
                </div>
                <div class="card-body">
                    @if($derniereDemande)
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Montant</th>
                                        <th>Statut</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $derniereDemande->date_demande->format('d/m/Y') }}</td>
                                        <td>{{ number_format($derniereDemande->montant, 2, ',' , ' ') }} FCFA</td>
                                        <td>
                                            <span class="badge badge-{{ 
                                                $derniereDemande->statut === 'acceptee' ? 'success' : 
                                                ($derniereDemande->statut === 'rejetee' ? 'danger' : 'warning') 
                                            }}">
                                                {{ ucfirst(str_replace('_', ' ', $derniereDemande->statut)) }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-primary">Détails</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p>Aucune demande de crédit enregistrée.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection