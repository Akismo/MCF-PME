<!-- resources/views/administrateur/membres/index.blade.php -->
@extends('admin.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Gestion des membres</h1>
        <a href="{{ route('membres.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Nouveau membre
        </a>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Liste des membres</h6>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>N° Adhérent</th>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Email</th>
                                    <th>Date inscription</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($membres as $membre)
                                <tr>
                                    <td>{{ $membre->numAdherent }}</td>
                                    <td>{{ $membre->name }}</td>
                                    <td>{{ $membre->prenom }}</td>
                                    <td>{{ $membre->email }}</td>
                                    <td>{{ $membre->date_inscription->format('Y-m-d') }}</td>
                                    <td>
                                        <a href="{{ route('membres.show', $membre->id) }}" class="btn btn-info btn-circle btn-sm" title="Voir">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('membres.edit', $membre->id) }}" class="btn btn-warning btn-circle btn-sm" title="Modifier">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <form action="{{ route('membres.destroy', $membre->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-circle btn-sm" title="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce membre?')">
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