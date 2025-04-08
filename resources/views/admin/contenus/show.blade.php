<!-- resources/views/admin/contenus/show.blade.php -->
@extends('admin.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ $contenu->titre }}</h1>
        <div>
            <a href="{{ route('admin.contenus.edit', $contenu->id) }}" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm">
                <i class="fas fa-pencil-alt fa-sm text-white-50"></i> Modifier
            </a>
            <a href="{{ route('admin.contenus.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
                <i class="fas fa-arrow-left fa-sm text-white-50"></i> Retour
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Détails du contenu</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h5>Informations générales</h5>
                            <p><strong>Type:</strong> {{ $contenu->type }}</p>
                            <p><strong>Auteur:</strong> {{ $contenu->administrateur->name }}</p>
                            <p><strong>Date publication:</strong> {{ $contenu->date_publication->format('d/m/Y H:i') }}</p>
                            
                            <h5 class="mt-4">Contenu</h5>
                            <div class="content-box p-3 bg-light">
                                {!! $contenu->contenu !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h5>Images associées</h5>
                            @if($contenu->images->isEmpty())
                                <p class="text-muted">Aucune image associée</p>
                            @else
                                <div class="gallery">
                                    @foreach($contenu->images as $image)
                                    <div class="mb-3 border p-2 {{ $image->is_principal ? 'border-primary' : '' }}">
                                        <img src="{{ asset('storage/' . $image->chemin) }}" alt="{{ $image->alt_text }}" class="img-fluid mb-2">
                                        <p><small>{{ $image->alt_text }}</small></p>
                                        @if($image->is_principal)
                                            <span class="badge badge-primary">Principale</span>
                                        @endif
                                        <form action="{{ route('admin.contenus.images.destroy', $image->id) }}" method="POST" class="mt-2">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer cette image?')">
                                                <i class="fas fa-trash"></i> Supprimer
                                            </button>
                                        </form>
                                    </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection