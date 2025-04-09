@extends('membre.app')

@section('title', 'Nouvelle demande de crédit')
@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Nouvelle demande de crédit</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('membre_soumettre_demande') }}">
                @csrf
                <div class="form-group">
                    <label for="montant">Montant demandé (FCFA)</label>
                    <input type="number" class="form-control" id="montant" name="montant" 
                           min="100" step="100" required>
                </div>
                <button type="submit" class="btn btn-primary">Soumettre la demande</button>
            </form>
        </div>
    </div>
</div>
@endsection