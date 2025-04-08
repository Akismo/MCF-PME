<!-- resources/views/admin/contenus/index.blade.php -->
@extends('admin.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Gestion des contenus</h1>
        <a href="{{ route('admin.contenus.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Nouveau contenu
        </a>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Liste des contenus</h6>
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
                                    <th>Titre</th>
                                    <th>Type</th>
                                    <th>Auteur</th>
                                    <th>Date publication</th>
                                    <th>Image principale</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($contenus as $contenu)
                                <tr>
                                    <td>{{ $contenu->titre }}</td>
                                    <td>{{ $contenu->type }}</td>
                                    <td>{{ $contenu->administrateur->name }}</td>
                                    <td>{{ $contenu->date_publication->format('d/m/Y') }}</td>
                                    <td>
                                        @if($contenu->image_principale)
                                            <img src="{{ asset('storage/' . $contenu->image_principale->chemin) }}" alt="{{ $contenu->image_principale->alt_text }}" width="50">
                                        @else
                                            <span class="text-muted">Aucune image</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.contenus.show', $contenu->id) }}" class="btn btn-info btn-circle btn-sm" title="Voir">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.contenus.edit', $contenu->id) }}" class="btn btn-warning btn-circle btn-sm" title="Modifier">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <form action="{{ route('admin.contenus.destroy', $contenu->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-circle btn-sm" title="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce contenu?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
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