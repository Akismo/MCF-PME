<!-- resources/views/administrateur/membres/show.blade.php -->
@extends('admin.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Détails du membre</h1>
        <div>
            <a href="{{ route('membres.edit', $membre->id) }}" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm">
                <i class="fas fa-pencil-alt fa-sm text-white-50"></i> Modifier
            </a>
            <a href="{{ route('membres.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
                <i class="fas fa-arrow-left fa-sm text-white-50"></i> Retour
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $membre->name }} {{ $membre->prenom }}</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Informations personnelles</h5>
                            <p><strong>N° Adhérent:</strong> {{ $membre->numAdherent }}</p>
                            <p><strong>Nom:</strong> {{ $membre->name }}</p>
                            <p><strong>Prénom:</strong> {{ $membre->prenom }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5>Coordonnées</h5>
                            <p><strong>Email:</strong> {{ $membre->email }}</p>
                            <p><strong>Date d'inscription:</strong> {{ $membre->date_inscription->format('Y-m-d') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection