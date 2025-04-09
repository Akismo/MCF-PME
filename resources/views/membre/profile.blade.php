@extends('membre.app')

@section('title', 'Mon profil')
@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Mon profil</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('membre_profile_update') }}">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Nom</label>
                            <input type="text" class="form-control" id="name" name="name" 
                                   value="{{ old('name', $membre->name) }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="prenom">Prénom</label>
                            <input type="text" class="form-control" id="prenom" name="prenom" 
                                   value="{{ old('prenom', $membre->prenom) }}" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" 
                                   value="{{ old('email', $membre->email) }}" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="numAdherent">Numéro adhérent</label>
                            <input type="text" class="form-control" id="numAdherent" 
                                   value="{{ $membre->numAdherent }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="date_inscription">Date d'inscription</label>
                            <input type="text" class="form-control" id="date_inscription" 
                                   value="{{ $membre->date_inscription->format('d/m/Y') }}" readonly>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Mettre à jour</button>
            </form>
        </div>
    </div>
</div>
@endsection