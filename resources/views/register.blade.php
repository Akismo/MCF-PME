<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Devenir Membre</title>
    <link rel="stylesheet" href="{{ asset('membrelogin/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('membrelogin/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('membrelogin/css/util.css') }}">
    <link rel="stylesheet" href="{{ asset('membrelogin/css/main.css') }}">
</head>
<body>

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <form class="login100-form validate-form" method="POST" action="{{ route('membre_register_submit') }}">
                @csrf
                <span class="login100-form-title p-b-26">
                    Devenir Membre
                </span>

                <!-- Nom Input -->
                <div class="wrap-input100 validate-input" data-validate="Entrez votre nom">
                    <input class="input100" type="text" name="nom" value="{{ old('nom') }}" required>
                    <span class="focus-input100" data-placeholder="Nom"></span>
                    @error('nom')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Prénom Input -->
                <div class="wrap-input100 validate-input" data-validate="Entrez votre prénom">
                    <input class="input100" type="text" name="prenom" value="{{ old('prenom') }}" required>
                    <span class="focus-input100" data-placeholder="Prénom"></span>
                    @error('prenom')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email Input -->
                <div class="wrap-input100 validate-input" data-validate="Email valide requis">
                    <input class="input100" type="email" name="email" value="{{ old('email') }}" required>
                    <span class="focus-input100" data-placeholder="Email"></span>
                    @error('email')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Mot de passe Input -->
                <div class="wrap-input100 validate-input" data-validate="Entrez votre mot de passe">
                    <span class="btn-show-pass">
                        <i class="zmdi zmdi-eye"></i>
                    </span>
                    <input class="input100" type="password" name="password" required>
                    <span class="focus-input100" data-placeholder="Mot de passe"></span>
                    @error('password')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Soumettre Button -->
                <div class="container-login100-form-btn">
                    <div class="wrap-login100-form-btn">
                        <div class="login100-form-bgbtn"></div>
                        <button class="login100-form-btn" type="submit">
                            S'inscrire
                        </button>
                    </div>
                </div>

                <!-- Lien vers connexion -->
                <div class="text-center p-t-115">
                    <span class="txt1">
                        Vous avez déjà un compte?
                    </span>
                    <a class="txt2" href="{{ route('membre_login') }}">
                        Connexion
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="{{ asset('membrelogin/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('membrelogin/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
</body>
</html>
