@extends('admin.app')

@section('title', 'Analyse demande - Comité de Crédit')
@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">
                    Analyse demande #{{ $demande->id }} - Score de risque:
                    <span class="badge badge-{{ $riskColor }}">
                        {{ $riskScore }}/10
                    </span>
                </h6>
                <div>
                    <span class="badge badge-info">
                        {{ $demande->type_credit }}
                    </span>
                </div>
            </div>

            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h5>Informations générales</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Membre</th>
                                    <td>{{ $demande->membre->name }} (Adhérent depuis
                                        {{ $demande->membre->date_inscription->diffForHumans() }})
                                    </td>
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

                        <h5 class="mt-4">Facteurs de risque</h5>
                        <div class="card">
                            <div class="card-body">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Montant du crédit
                                        <span class="badge badge-secondary">{{ $montantRisk }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Ancienneté du membre
                                        <span class="badge badge-secondary">{{ $ancienneteRisk }}</span>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Documents manquants
                                        <span class="badge badge-secondary">{{ $documentsRisk }}</span>

                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <h5>Documents joints</h5>
                        <div class="alert alert-{{ empty($missingDocuments) ? 'success' : 'warning' }}">
                            @if(empty($missingDocuments))
                                <i class="fas fa-check-circle"></i> Tous les documents requis sont fournis
                            @else
                                <i class="fas fa-exclamation-triangle"></i> Documents manquants:
                                {{ count($missingDocuments) }}/{{ count($requiredDocuments) }}
                            @endif
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Document</th>
                                        <th>Statut</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($requiredDocuments as $doc)
                                        <tr>
                                            <td>{{ $doc }}</td>
                                            <td>
                                                @if(in_array($doc, $missingDocuments))
                                                    <span class="badge badge-danger">Manquant</span>
                                                @else
                                                    <span class="badge badge-success">Fourni</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if(!in_array($doc, $missingDocuments))
                                                    @php
                                                        $type = mapDocumentLabelToType($doc);
                                                        $document = $type ? $demande->documents->where('type_document', $type)->first() : null;
                                                    @endphp
                                                    <a href="{{ asset('storage/' . $document->chemin_fichier) }}" target="_blank"
                                                        class="btn btn-sm btn-primary">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <h5>Annotations</h5>
                        <div class="card mb-4">
                            <div class="card-body">
                                <form method="POST" action="{{ route('comite-credit.annotate', $demande->id) }}">
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
                                        <textarea class="form-control" name="contenu" rows="3"
                                            placeholder="Ajouter une note ou un commentaire..." required></textarea>
                                    </div>
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="is_important"
                                            name="is_important">
                                        <label class="form-check-label" for="is_important">Marquer comme important</label>
                                    </div>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-comment"></i> Ajouter
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div class="list-group">
                            @forelse($demande->annotations as $annotation)
                                <div class="list-group-item flex-column align-items-start 
                                                {{ $annotation->is_important ? 'list-group-item-warning' : '' }}">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-1">
                                            @if($annotation->is_important)
                                                <i class="fas fa-exclamation-circle text-danger"></i>
                                            @endif
                                            {{ $annotation->user->name }} -
                                            <small>{{ $annotation->created_at->diffForHumans() }}</small>
                                        </h6>
                                    </div>
                                    <p class="mb-1">{{ $annotation->contenu }}</p>
                                </div>
                            @empty
                                <div class="alert alert-info">Aucune annotation pour cette demande</div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-12">
                        <form method="POST" action="{{ route('comite-credit.decide', $demande->id) }}">
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
                                <label for="decision">Décision finale</label>
                                <select class="form-control" id="decision" name="decision" required>
                                    <option value="">Sélectionner une décision</option>
                                    <option value="Approuvée">Approuver la demande</option>
                                    <option value="Refusée">Refuser la demande</option>
                                </select>
                            </div>

                            <div class="form-group" id="commentaire-group" style="display: none;">
                                <label for="commentaire">Motif du refus</label>
                                <textarea class="form-control" id="commentaire" name="commentaire" rows="3"
                                    placeholder="Précisez les raisons du refus..."></textarea>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-check-double"></i> Valider la décision
                                </button>
                                <a href="{{ route('comite-credit.index') }}" class="btn btn-secondary">
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
            const decisionSelect = document.getElementById('decision');
            const commentaireGroup = document.getElementById('commentaire-group');

            decisionSelect.addEventListener('change', function () {
                if (this.value === 'Refusée') {
                    commentaireGroup.style.display = 'block';
                } else {
                    commentaireGroup.style.display = 'none';
                }
            });
        });
    </script>
@endsection