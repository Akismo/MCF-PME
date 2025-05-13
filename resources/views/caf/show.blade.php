@extends('admin.app')

@section('title', 'Vérification demande - CAF')
@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">
                    Vérification demande #{{ $demande->id }}
                </h6>
                <span class="badge badge-{{ 
                    $demande->statut === 'En attente' ? 'warning' : 'info' 
                }}">
                    {{ $demande->statut }}
                </span>
            </div>

            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h5>Informations générales</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Membre</th>
                                    <td>{{ $demande->membre->name }} {{ $demande->membre->prenom }}</td>
                                </tr>
                                <tr>
                                    <th>Type de crédit</th>
                                    <td>{{ $demande->type_credit }}</td>
                                </tr>
                                <tr>
                                    <th>Montant</th>
                                    <td>{{ number_format($demande->montant, 0, ',', ' ') }} FCFA</td>
                                </tr>
                                <tr>
                                    <th>Durée</th>
                                    <td>{{ $demande->duree }}</td>
                                </tr>
                                <tr>
                                    <th>Description</th>
                                    <td>{{ $demande->description_projet }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <h5>Documents fournis</h5>
                        <div class="alert alert-{{ empty($missingDocuments) ? 'success' : 'warning' }}">
                            @if(empty($missingDocuments))
                                <i class="fas fa-check-circle"></i> Tous les documents requis sont fournis
                            @else
                                <i class="fas fa-exclamation-triangle"></i> Documents manquants:
                                {{ count($missingDocuments) }}/{{ count($requiredDocuments) }}
                            @endif
                        </div>

                        <div class="list-group">
                            @foreach($requiredDocuments as $doc)
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $doc }}
                                    @if(in_array($doc, $missingDocuments))
                                        <span class="badge badge-danger">Manquant</span>
                                    @else
                                        <span class="badge badge-success">Fourni</span>
                                    @endif
                                </div>
                            @endforeach
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
                                        <th>Type</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($demande->documents as $document)
                                        <tr>
                                            <td>{{ $document->nom_original }}</td>
                                            <td>{{ $document->type_document }}</td>
                                            <td>
                                                <a href="{{ asset('storage/' . $document->chemin_fichier) }}" target="_blank"
                                                    class="btn btn-sm btn-primary">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ asset('storage/' . $document->chemin_fichier) }}" download
                                                    class="btn btn-sm btn-secondary">
                                                    <i class="fas fa-download"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3">Aucun document joint</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-12">
                        <form method="POST" action="{{ route('caf.verify', $demande->id) }}">
                            @csrf

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="form-group">
                                <label for="statut">Action</label>
                                <select class="form-control" id="statut" name="statut" required>
                                    <option value="">Sélectionner une action</option>
                                    <option value="En vérification">Valider la demande</option>
                                    <option value="Documents incomplets">Demander des documents complémentaires</option>
                                </select>
                            </div>

                            <div class="form-group" id="commentaires-group" style="display: none;">
                                <label for="commentaires">Commentaires</label>
                                <textarea class="form-control" id="commentaires" name="commentaires" rows="3"
                                    placeholder="Précisez les documents manquants..."></textarea>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-check"></i> Enregistrer
                                </button>
                                <a href="{{ route('caf.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Retour
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const statutSelect = document.getElementById('statut');
            const commentairesGroup = document.getElementById('commentaires-group');

            statutSelect.addEventListener('change', function () {
                if (this.value === 'Documents incomplets') {
                    commentairesGroup.style.display = 'block';
                } else {
                    commentairesGroup.style.display = 'none';
                }
            });
        });
    </script>
@endsection