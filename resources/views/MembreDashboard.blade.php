<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord Administrateur</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.1.2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

    <div class="flex items-center justify-between bg-blue-600 p-4 text-white">
        <h1 class="text-xl font-bold">Bienvenue, {{ Auth::guard('membre')->user()->name }}</h1>
        <form action="{{ route('membre_logout') }}" method="POST">
            @csrf
            <button type="submit" class="bg-red-500 px-4 py-2 rounded text-white hover:bg-red-600">
                Se déconnecter
            </button>
        </form>
    </div>

    <div class="p-8">
        <h2 class="text-2xl font-bold mb-4">Tableau de bord</h2>

        <p>Bienvenue sur votre tableau de bord. Vous êtes connecté en tant que Membre.</p>

        <!-- Ajoutez ici les informations supplémentaires que vous souhaitez afficher -->
        <div class="mt-6">
            <h3 class="text-xl font-semibold">Statistiques</h3>
            <ul class="list-disc ml-6">
                <li>Nombre d'utilisateurs enregistrés : 100</li>
                <li>Nombre de demandes traitées : 50</li>
                <li>Dernière connexion : {{ now()->format('d-m-Y H:i:s') }}</li>
            </ul>
        </div>
    </div>

</body>
</html>
