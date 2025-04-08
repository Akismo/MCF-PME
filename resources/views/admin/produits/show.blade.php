@extends('admin.app')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Détails du produit financier</h1>
        <div>
            <a href="{{ route('produits-financiers.edit', $produit->id) }}" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm">
                <i class="fas fa-pencil-alt fa-sm text-white-50"></i> Modifier
            </a>
            <a href="{{ route('produits-financiers.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
                <i class="fas fa-arrow-left fa-sm text-white-50"></i> Retour
            </a>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $produit->nom }}</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Description</h5>
                            <p>{{ $produit->description }}</p>
                            
                            <h5>Conditions</h5>
                            <p>{{ $produit->conditions }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5>Avantages</h5>
                            <p>{{ $produit->avantages }}</p>
                            
                            <h5>Date de création</h5>
                            <p>{{ $produit->date_creation}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection