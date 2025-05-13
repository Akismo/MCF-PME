@extends('membre.app')

@section('title', 'Détails de la demande')
@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Détails de la demande #{{ $demande->id }}</h6>
            <span class="badge badge-{{ 
                $demande->statut === 'Approuvée' ? 'success' : 
                ($demande->statut === 'Refusée' ? 'danger' : 'warning') 
            }}">
                {{ $demande->statut }}
            </span>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <h5>Informations générales</h5>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <strong>Type:</strong> {{ $demande->type_credit }}
                        </li>
                        <li class="list-group-item">
                            <strong>Date:</strong> {{ $demande->date_demande->format('d/m/Y H:i') }}
                        </li>
                        <li class="list-group-item">
                            <strong>Montant:</strong> {{ number_format($demande->montant, 2, ',', ' ') }} FCFA
                        </li>
                        <li class="list-group-item">
                            <strong>Durée:</strong> {{ $demande->duree }}
                        </li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <h5>Description du projet</h5>
                    <div class="card">
                        <div class="card-body">
                            {{ $demande->description_projet }}
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    <h5>Documents joints</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nom du document</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($demande->documents as $document)
                                    <tr>
                                        <td>{{ $document->nom_original }}</td>
                                        <td>
                                            <a href="{{ asset('storage/'.$document->chemin_fichier) }}" 
                                               target="_blank" class="btn btn-sm btn-primary">
                                               <i class="fas fa-eye"></i> Voir
                                            </a>
                                            <a href="{{ asset('storage/'.$document->chemin_fichier) }}" 
                                               download class="btn btn-sm btn-secondary">
                                               <i class="fas fa-download"></i> Télécharger
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2">Aucun document joint</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            @if($demande->commentaires)
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card border-left-{{ $demande->statut === 'Approuvée' ? 'success' : 'danger' }}">
                        <div class="card-header">
                            <h6>Commentaires</h6>
                        </div>
                        <div class="card-body">
                            {{ $demande->commentaires }}
                        </div>
                    </div>
                </div>
            </div>
            @endif
            
            <div class="mt-4">
                <a href="{{ route('membre_demandes') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Retour à la liste
                </a>
            </div>
        </div>
    </div>
</div>
@endsection