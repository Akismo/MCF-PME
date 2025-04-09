@extends('membre.app')

@section('title', 'Détails de la demande')
@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Détails de la demande #{{ $demande->id }}</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5>Informations générales</h5>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <strong>Date de demande:</strong> {{ $demande->date_demande->format('d/m/Y H:i') }}
                        </li>
                        <li class="list-group-item">
                            <strong>Montant:</strong> {{ number_format($demande->montant, 2, ',', ' ') }} FCFA
                        </li>
                        <li class="list-group-item">
                            <strong>Statut:</strong>
                            <span class="badge badge-{{ 
                                $demande->statut === 'Approuvée' ? 'success' : 
                                ($demande->statut === 'Refusée' ? 'danger' : 'warning') 
                            }}">
                                {{ ucfirst(str_replace('_', ' ', $demande->statut)) }}
                            </span>
                        </li>
                    </ul>
                </div>
                <!-- <div class="col-md-6">
                    <h5>Raison de la demande</h5>
                    <div class="card">
                        <div class="card-body">
                            {{ $demande->raison ?? 'Aucune raison spécifiée' }}
                        </div>
                    </div>
                </div> -->
            </div>
            <div class="mt-4">
                <a href="{{ route('membre_demandes') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Retour à la liste
                </a>
            </div>
        </div>
    </div>
</div>
@endsection