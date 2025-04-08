<!-- resources/views/admin/demande-credits/show.blade.php -->
@extends('admin.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Détails de la demande de crédit</h1>
        <a href="{{ route('demande-credits.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Retour
        </a>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Demande #{{ $demande->id }}</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Informations sur le membre</h5>
                            <p><strong>Nom:</strong> {{ $demande->membre->name }} {{ $demande->membre->prenom }}</p>
                            <p><strong>N° Adhérent:</strong> {{ $demande->membre->numAdherent }}</p>
                            <p><strong>Email:</strong> {{ $demande->membre->email }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5>Détails de la demande</h5>
                            <p><strong>Montant:</strong> {{ number_format($demande->montant, 2, ',', ' ') }} €</p>
                            <p><strong>Date demande:</strong> {{ $demande->date_demande->format('d/m/Y') }}</p>
                            <p><strong>Statut:</strong> 
                                @if($demande->statut == 'en attente')
                                    <span class="badge badge-warning">En attente</span>
                                @elseif($demande->statut == 'accepté')
                                    <span class="badge badge-success">Accepté</span>
                                @else
                                    <span class="badge badge-danger">Rejeté</span>
                                @endif
                            </p>
                        </div>
                    </div>

                    @if($demande->statut == 'en attente')
                    <div class="mt-4">
                        <form action="{{ route('demande-credits.accept', $demande->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-check"></i> Accepter la demande
                            </button>
                        </form>
                        <form action="{{ route('demande-credits.reject', $demande->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-times"></i> Rejeter la demande
                            </button>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection