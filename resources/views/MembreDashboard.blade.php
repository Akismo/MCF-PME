<x-app-layout>
    <!-- En-tête du dashboard -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Membre') }}
        </h2>
    </x-slot>

    <!-- Contenu principal du dashboard membre -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Informations personnelles -->
            <div class="bg-white shadow rounded-lg p-6 mb-8">
                <h3 class="text-lg font-bold mb-4">Mes Informations Personnelles</h3>
                <p class="mb-2"><strong>Numéro d'adhérent :</strong> {{ auth()->user()->numAdherent ?? 'N/A' }}</p>
                <p class="mb-2"><strong>Nom :</strong> {{ auth()->user()->name }}</p>
                <p class="mb-2"><strong>Email :</strong> {{ auth()->user()->email }}</p>
                <!-- Ajoutez d'autres informations personnelles si nécessaire -->
            </div>

            <!-- Mes demandes de crédit -->
            <div class="bg-white shadow rounded-lg p-6 mb-8">
                <h3 class="text-lg font-bold mb-4">Mes Demandes de Crédit</h3>
                @if($creditRequests->isNotEmpty())
                    <ul>
                        @foreach($creditRequests as $request)
                            <li class="border-b py-2">
                                Demande #{{ $request->id }} - Statut : <span class="font-semibold">{{ $request->status }}</span>
                                <span class="text-gray-500 text-sm">({{ $request->created_at->diffForHumans() }})</span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-500">Aucune demande de crédit soumise.</p>
                @endif
                <div class="mt-4">
                    <a href="{{ route('credit.request.create') }}" class="inline-block px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                        Nouvelle Demande
                    </a>
                </div>
            </div>

            <!-- Catalogue des produits financiers -->
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">Catalogue des Produits Financiers</h3>
                @if($financialProducts->isNotEmpty())
                    <ul class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        @foreach($financialProducts as $product)
                            <li class="border p-4 rounded">
                                <h4 class="font-bold mb-2">{{ $product->name }}</h4>
                                <p class="text-sm text-gray-700">{{ $product->description }}</p>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-500">Aucun produit financier disponible pour le moment.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
