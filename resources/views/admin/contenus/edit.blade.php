@extends('admin.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Modifier le contenu</h1>
        <div>
            <a href="{{ route('admin.contenus.show', $contenu->id) }}" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm">
                <i class="fas fa-eye fa-sm text-white-50"></i> Voir
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
                    <h6 class="m-0 font-weight-bold text-primary">Modification de "{{ $contenu->titre }}"</h6>
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

                    <form action="{{ route('admin.contenus.update', $contenu->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group">
                            <label for="titre">Titre *</label>
                            <input type="text" class="form-control" id="titre" name="titre" 
                                   value="{{ old('titre', $contenu->titre) }}" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="type">Type de contenu *</label>
                            <select class="form-control" id="type" name="type" required>
                                <option value="Article" {{ $contenu->type == 'Article' ? 'selected' : '' }}>Article</option>
                                <option value="Actualité" {{ $contenu->type == 'Actualité' ? 'selected' : '' }}>Actualité</option>
                                <option value="Événement" {{ $contenu->type == 'Événement' ? 'selected' : '' }}>Événement</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="contenu">Contenu *</label>
                            <textarea class="form-control" id="contenu" name="contenu" rows="10" required>{{ old('contenu', $contenu->contenu) }}</textarea>
                        </div>
                        
                        <div class="form-group">
                            <label for="date_publication">Date de publication *</label>
                            <input type="date" class="form-control" id="date_publication" name="date_publication" 
                                   value="{{ old('date_publication', $contenu->date_publication->format('Y-m-d')) }}" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Images existantes</label>
                            @if($contenu->images->isEmpty())
                                <p class="text-muted">Aucune image associée</p>
                            @else
                                <div class="row">
                                    @foreach($contenu->images as $image)
                                    <div class="col-md-4 mb-3">
                                        <div class="card {{ $image->is_principal ? 'border-primary' : '' }}">
                                            <img src="{{ asset('storage/' . $image->chemin) }}" class="card-img-top" alt="{{ $image->alt_text }}">
                                            <div class="card-body">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="image_principale" 
                                                           id="img_principal_{{ $image->id }}" value="{{ $image->id }}"
                                                           {{ $image->is_principal ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="img_principal_{{ $image->id }}">
                                                        Définir comme image principale
                                                    </label>
                                                </div>
                                                <div class="mt-2">
                                                    <input type="text" class="form-control form-control-sm" 
                                                           name="alt_text_existants[{{ $image->id }}]" 
                                                           value="{{ old('alt_text_existants.'.$image->id, $image->alt_text) }}" 
                                                           placeholder="Texte alternatif">
                                                </div>
                                                <button type="button" class="btn btn-sm btn-danger mt-2" 
                                                        onclick="if(confirm('Supprimer cette image?')) { 
                                                            document.getElementById('delete-image-{{ $image->id }}').submit(); 
                                                        }">
                                                    <i class="fas fa-trash"></i> Supprimer
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        
                        <div class="form-group">
                            <label>Ajouter de nouvelles images</label>
                            <div id="images-container">
                                <div class="image-input-group mb-3">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="images[]" accept="image/*">
                                        <label class="custom-file-label">Choisir une image</label>
                                    </div>
                                    <input type="text" class="form-control mt-2" name="alt_text[]" placeholder="Texte alternatif">
                                </div>
                            </div>
                            <button type="button" id="add-image" class="btn btn-sm btn-outline-secondary">
                                <i class="fas fa-plus"></i> Ajouter une image
                            </button>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Enregistrer les modifications
                        </button>
                    </form>
                    
                    <!-- Formulaires de suppression cachés pour les images existantes -->
                    @foreach($contenu->images as $image)
                    <form id="delete-image-{{ $image->id }}" 
                          action="{{ route('admin.contenus.images.destroy', $image->id) }}" 
                          method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let imageIndex = 1;
    const container = document.getElementById('images-container');
    const addButton = document.getElementById('add-image');
    
    addButton.addEventListener('click', function() {
        const newGroup = document.createElement('div');
        newGroup.className = 'image-input-group mb-3';
        newGroup.innerHTML = `
            <div class="custom-file">
                <input type="file" class="custom-file-input" name="images[]" accept="image/*">
                <label class="custom-file-label">Choisir une image</label>
            </div>
            <input type="text" class="form-control mt-2" name="alt_text[]" placeholder="Texte alternatif">
            <button type="button" class="btn btn-sm btn-outline-danger mt-2 remove-image">Supprimer</button>
        `;
        
        container.appendChild(newGroup);
        imageIndex++;
        
        newGroup.querySelector('.remove-image').addEventListener('click', function() {
            container.removeChild(newGroup);
        });
    });
    
    container.addEventListener('change', function(e) {
        if (e.target.classList.contains('custom-file-input')) {
            const label = e.target.nextElementSibling;
            const fileName = e.target.files[0]?.name || 'Choisir une image';
            label.textContent = fileName;
        }
    });
});
</script>
@endsection