@extends('admin.app') <!-- ou ton layout -->

@section('content')
<div class="container">
    <h1 class="mb-4">Tableau de bord CAF</h1>

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total demandes</h5>
                    <p class="card-text fs-4">{{ $totalDemandes }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">En attente</h5>
                    <p class="card-text fs-4">{{ $enAttente }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-info mb-3">
                <div class="card-body">
                    <h5 class="card-title">En vérification</h5>
                    <p class="card-text fs-4">{{ $enVerification }}</p>
                </div>
            </div>
        </div>
    </div>

    <form method="GET" action="{{ route('dashboard.caf') }}" class="mb-3">
        <div class="row">
            <div class="col-md-3">
                <select name="statut" class="form-control">
                    <option value="">-- Statut --</option>
                    <option value="En attente" {{ request('statut') == 'En attente' ? 'selected' : '' }}>En attente</option>
                    <option value="En vérification" {{ request('statut') == 'En vérification' ? 'selected' : '' }}>En vérification</option>
                    <option value="Documents incomplets" {{ request('statut') == 'Documents incomplets' ? 'selected' : '' }}>Documents incomplets</option>
                </select>
            </div>

            <div class="col-md-3">
                <select name="type_credit" class="form-control">
                    <option value="">-- Type de crédit --</option>
                    @foreach($typesCredits as $type)
                        <option value="{{ $type }}" {{ request('type_credit') == $type ? 'selected' : '' }}>{{ $type }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <button class="btn btn-secondary">Filtrer</button>
            </div>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Membre</th>
                    <th>Type crédit</th>
                    <th>Statut</th>
                    <th>Date de demande</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($demandes as $demande)
                    <tr>
                        <td>{{ $demande->membre->name ?? 'N/A' }} {{ $demande->membre->prenom ?? 'N/A' }}</td>
                        <td>{{ $demande->type_credit }}</td>
                        <td>{{ $demande->statut }}</td>
                        <td>{{ $demande->date_demande }}</td>
                        <td>
                            <a href="{{ route('caf.show', $demande->id) }}" class="btn btn-sm btn-primary">Voir</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">Aucune demande trouvée.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $demandes->links() }}
</div>
@endsection
