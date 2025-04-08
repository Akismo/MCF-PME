<!-- resources/views/administrateur/membres/edit.blade.php -->
@extends('admin.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Modifier le membre</h1>
        <div>
            <a href="{{ route('membres.show', $membre->id) }}" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm">
                <i class="fas fa-eye fa-sm text-white-50"></i> Voir
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
                    <h6 class="m-0 font-weight-bold text-primary">Modification de {{ $membre->name }} {{ $membre->prenom }}</h6>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('membres.update', $membre->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group">
                            <label for="numAdherent">N° Adhérent</label>
                            <input type="text" class="form-control" id="numAdherent" 
                                   value="{{ $membre->numAdherent }}" readonly>
                            <small class="form-text text-muted">Ce numéro est généré automatiquement et ne peut pas être modifié.</small>
                        </div>
                        
                        <div class="form-group">
                            <label for="name">Nom</label>
                            <input type="text" class="form-control" id="name" name="name" 
                                   value="{{ old('name', $membre->name) }}" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="prenom">Prénom</label>
                            <input type="text" class="form-control" id="prenom" name="prenom" 
                                   value="{{ old('prenom', $membre->prenom) }}" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" 
                                   value="{{ old('email', $membre->email) }}" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="password">Nouveau mot de passe (laisser vide si inchangé)</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        
                        <div class="form-group">
                            <label for="date_inscription">Date d'inscription</label>
                            <input type="date" class="form-control" id="date_inscription" name="date_inscription" 
                                   value="{{ old('date_inscription', $membre->date_inscription->format('Y-m-d')) }}" required>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Enregistrer
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection