<!-- resources/views/AdministrateurLogin.blade.php -->

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Administrateur</title>
</head>
<body>
    <h2>Connexion Administrateur</h2>
    <form method="POST" action="{{ route('administrateur_login_submit') }}">
        @csrf <!-- Token CSRF pour la sécurité -->
        
        <!-- Affichage des erreurs -->
        @if(session('error'))
            <p style="color: red;">{{ session('error') }}</p>
        @endif

        <!-- Email -->
        <label for="email">Email</label>
        <input type="email" name="email" id="email" required value="{{ old('email') }}">
        @error('email')
            <p style="color: red;">{{ $message }}</p>
        @enderror

        <br><br>

        <!-- Mot de passe -->
        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password" required>
        @error('password')
            <p style="color: red;">{{ $message }}</p>
        @enderror

        <br><br>

        <!-- Bouton de soumission -->
        <button type="submit">Se connecter</button>
    </form>
</body>
</html>
