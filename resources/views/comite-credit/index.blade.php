@extends('admin.app')

@section('title', 'Demandes à analyser - Comité de Crédit')
@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Demandes à analyser</h6>
                <a href="{{ route('comite-credit.dashboard') }}" class="btn btn-info btn-sm">
                    <i class="fas fa-chart-line"></i> Tableau de bord
                </a>
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
                                <th>Score risque</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($demandes as $demande)
                                <tr>
                                    <td>{{ $demande->id }}</td>
                                    <td>{{ $demande->membre->name }}</td>
                                    <td>{{ $demande->type_credit }}</td>
                                    <td>{{ number_format($demande->montant, 0, ',', ' ') }} FCFA</td>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar bg-{{ $demande->risk_color }}" role="progressbar"
                                                style="width: {{ $demande->risk_score * 10 }}%"
                                                aria-valuenow="{{ $demande->risk_score }}" aria-valuemin="1" aria-valuemax="10">
                                                {{ $demande->risk_score }}/10
                                            </div>
                                        </div>

                                    </td>
                                    <td>{{ $demande->date_demande->format('d/m/Y') }}</td>
                                    <td>
                                        <a href="{{ route('comite-credit.show', $demande->id) }}"
                                            class="btn btn-primary btn-sm">
                                            <i class="fas fa-search"></i> Analyser
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Aucune demande à analyser</td>
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