@extends('admin.app')

@section('title', 'Demandes de crédit - CAF')
@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Demandes de crédit à vérifier</h6>
            
            <div class="d-flex">
                <form method="GET" action="{{ route('caf.filter') }}" class="form-inline mr-3">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Rechercher..." 
                               value="{{ request('search') }}">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
                
                <div class="dropdown mr-3">
                    <button class="btn btn-secondary dropdown-toggle" type="button" 
                            id="filterStatus" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-filter"></i> Statut
                    </button>
                    <div class="dropdown-menu" aria-labelledby="filterStatus">
                        <a class="dropdown-item" href="{{ route('caf.filter', ['statut' => 'En attente']) }}">En attente</a>
                        <a class="dropdown-item" href="{{ route('caf.filter', ['statut' => 'En vérification']) }}">En vérification</a>
                        <a class="dropdown-item" href="{{ route('caf.index') }}">Tous</a>
                    </div>
                </div>
                
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" 
                            id="filterType" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-filter"></i> Type
                    </button>
                    <div class="dropdown-menu" aria-labelledby="filterType">
                        @foreach(['Ligne de crédit', 'Avance sur facture', 'Bon de commande', 'Fonds de roulement', 'AGR'] as $type)
                            <a class="dropdown-item" href="{{ route('caf.filter', ['type_credit' => $type]) }}">
                                {{ $type }}
                            </a>
                        @endforeach
                        <a class="dropdown-item" href="{{ route('caf.index') }}">Tous</a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Membre</th>
                            <th>Type</th>
                            <th>Montant</th>
                            <th>Date</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($demandes as $demande)
                            <tr>
                                <td>{{ $demande->id }}</td>
                                <td>{{ $demande->membre->name }} {{ $demande->membre->prenom }}</td>
                                <td>{{ $demande->type_credit }}</td>
                                <td>{{ number_format($demande->montant, 0, ',', ' ') }} FCFA</td>
                                <td>{{ $demande->date_demande->format('d/m/Y') }}</td>
                                <td>
                                    <span class="badge badge-{{ 
                                        $demande->statut === 'En attente' ? 'warning' : 
                                        ($demande->statut === 'En vérification' ? 'info' : 'secondary') 
                                    }}">
                                        {{ $demande->statut }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('caf.show', $demande->id) }}" 
                                       class="btn btn-info btn-sm" title="Vérifier">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Aucune demande à vérifier</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                
                <div class="d-flex justify-content-center">
                    {{ $demandes->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection