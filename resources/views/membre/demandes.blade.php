@extends('membre.app')

@section('title', 'Mes demandes de crédit')
@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Mes demandes de crédit</h6>
            <a href="{{ route('membre_nouvelle_demande') }}" class="btn btn-success btn-sm">
                <i class="fas fa-plus"></i> Nouvelle demande
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Montant</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($demandes as $demande)
                            <tr>
                                <td>{{ $demande->date_demande->format('d/m/Y') }}</td>
                                <td>{{ number_format($demande->montant, 2, ',', ' ') }} FCFA</td>
                                <td>
                                    <span class="badge badge-{{ 
                                        $demande->statut === 'Approuvée' ? 'success' : 
                                        ($demande->statut === 'Refusée' ? 'danger' : 'warning') 
                                    }}">
                                        {{ ucfirst(str_replace('_', ' ', $demande->statut)) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('membre_demande_details', $demande->id) }}" class="btn btn-info btn-circle btn-sm" title="Voir les détails">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Aucune demande de crédit enregistrée</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection