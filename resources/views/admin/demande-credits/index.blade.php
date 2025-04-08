<!-- resources/views/admin/demande-credits/index.blade.php -->
@extends('admin.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Demandes de crédit</h1>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Liste des demandes</h6>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>N° Demande</th>
                                    <th>Membre</th>
                                    <th>Montant</th>
                                    <th>Date demande</th>
                                    <th>Statut</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($demandes as $demande)
                                <tr>
                                    <td>{{ $demande->id }}</td>
                                    <td>{{ $demande->membre->name }} {{ $demande->membre->prenom }}</td>
                                    <td>{{ number_format($demande->montant, 2, ',', ' ') }} €</td>
                                    <td>{{ $demande->date_demande->format('d/m/Y') }}</td>
                                    <td>
                                        @if($demande->statut == 'en attente')
                                            <span class="badge badge-warning">En attente</span>
                                        @elseif($demande->statut == 'accepté')
                                            <span class="badge badge-success">Accepté</span>
                                        @else
                                            <span class="badge badge-danger">Rejeté</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('demande-credits.show', $demande->id) }}" class="btn btn-info btn-circle btn-sm" title="Voir">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        @if($demande->statut == 'en attente')
                                            <form action="{{ route('demande-credits.accept', $demande->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-circle btn-sm" title="Accepter">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('demande-credits.reject', $demande->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-circle btn-sm" title="Rejeter">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection