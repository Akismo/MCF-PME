

@extends('services.app')

@section('title', 'services - Mon Site')

@section('content')
    <div class="container">
        <h1>Nos Services</h1>
        <p>Voici les services que nous proposons pour répondre à vos besoins :</p>

        <section id="services">
            <div class="row">
                <div class="col-md-4">
                    <h3>Packs & Crédits Rattachés</h3>
                    <p>Description du service Packs & Crédits Rattachés...</p>
                </div>
                <div class="col-md-4">
                    <h3>Épargne</h3>
                    <p>Description du service Épargne...</p>
                </div>
                <div class="col-md-4">
                    <h3>Monétique</h3>
                    <p>Description du service Monétique...</p>
                </div>
            </div>
        </section>
    </div>
@endsection
