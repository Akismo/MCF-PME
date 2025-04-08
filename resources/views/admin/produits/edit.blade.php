@extends('admin.app')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Modifier le produit financier</h1>
        <div>
            <a href="{{ route('produits-financiers.show', $produit->id) }}" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm">
                <i class="fas fa-eye fa-sm text-white-50"></i> Voir le produit
            </a>
            <a href="{{ route('produits-financiers.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
                <i class="fas fa-arrow-left fa-sm text-white-50"></i> Retour à la liste
            </a>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Modification du produit "{{ $produit->nom }}"</h6>
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

                    <form action="{{ route('produits-financiers.update', $produit->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group">
                            <label for="nom">Nom du produit</label>
                            <input type="text" class="form-control" id="nom" name="nom" 
                                   value="{{ old('nom', $produit->nom) }}" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" 
                                      rows="3" required>{{ old('description', $produit->description) }}</textarea>
                        </div>
                        
                        <div class="form-group">
                            <label for="conditions">Conditions</label>
                            <textarea class="form-control" id="conditions" name="conditions" 
                                      rows="3" required>{{ old('conditions', $produit->conditions) }}</textarea>
                        </div>
                        
                        <div class="form-group">
                            <label for="avantages">Avantages</label>
                            <textarea class="form-control" id="avantages" name="avantages" 
                                      rows="3" required>{{ old('avantages', $produit->avantages) }}</textarea>
                        </div>
                        
                        <div class="form-group">
                            <label for="date_creation">Date de création</label>
                            <input type="date" class="form-control" id="date_creation" name="date_creation"
                                value="{{ old('date_creation', $produit->date_creation ? $produit->date_creation : '') }}" required>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Mettre à jour
                        </button>
                        
                        <a href="{{ route('produits-financiers.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Annuler
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection