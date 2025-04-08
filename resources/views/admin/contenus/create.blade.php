<!-- resources/views/admin/contenus/create.blade.php -->
@extends('admin.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Créer un nouveau contenu</h1>
        <a href="{{ route('admin.contenus.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Retour
        </a>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informations du contenu</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.contenus.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="form-group">
                            <label for="titre">Titre *</label>
                            <input type="text" class="form-control" id="titre" name="titre" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="type">Type de contenu *</label>
                            <select class="form-control" id="type" name="type" required>
                                <option value="Article">Article</option>
                                <option value="Actualité">Actualité</option>
                                <option value="Événement">Événement</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="contenu">Contenu *</label>
                            <textarea class="form-control" id="contenu" name="contenu" rows="10" required></textarea>
                        </div>
                        
                        <div class="form-group">
                            <label for="date_publication">Date de publication *</label>
                            <input type="date" class="form-control" id="date_publication" name="date_publication" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Images</label>
                            <div id="images-container">
                                <div class="image-input-group mb-3">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="images[]" accept="image/*">
                                        <label class="custom-file-label">Choisir une image</label>
                                    </div>
                                    <input type="text" class="form-control mt-2" name="alt_text[]" placeholder="Texte alternatif">
                                    <div class="form-check mt-2">
                                        <input class="form-check-input" type="radio" name="image_principale" value="0" checked>
                                        <label class="form-check-label">Image principale</label>
                                    </div>
                                </div>
                            </div>
                            <button type="button" id="add-image" class="btn btn-sm btn-outline-secondary">
                                <i class="fas fa-plus"></i> Ajouter une image
                            </button>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </form>
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
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="radio" name="image_principale" value="${imageIndex}">
                        <label class="form-check-label">Image principale</label>
                    </div>
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