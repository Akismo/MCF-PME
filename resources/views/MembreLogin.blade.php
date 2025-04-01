<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V2</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="membrelogin/images/icons/favicon.ico"/>
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('membrelogin/vendor/bootstrap/css/bootstrap.min.css') }}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('membrelogin/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('membrelogin/fonts/iconic/css/material-design-iconic-font.min.css') }}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('membrelogin/vendor/animate/animate.css') }}">
	<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{ asset('membrelogin/vendor/css-hamburgers/hamburgers.min.css') }}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('membrelogin/vendor/animsition/css/animsition.min.css') }}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('membrelogin/vendor/select2/select2.min.css') }}">
	<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{ asset('membrelogin/vendor/daterangepicker/daterangepicker.css') }}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('membrelogin/css/util.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('membrelogin/css/main.css') }}">
	<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" method="POST" action="{{ route('membre_login_submit') }}">
					@csrf
					<span class="login100-form-title p-b-26">
						Welcome
					</span>
					<span class="login100-form-title p-b-48">
						<i class="zmdi zmdi-font"></i>
					</span>

					<!-- Email Input -->
					<div class="wrap-input100 validate-input" data-validate = "Valid email is: a@b.c">
						<input class="input100" type="email" name="email" value="{{ old('email') }}" required>
						<span class="focus-input100" data-placeholder="Email"></span>
						@error('email')
						<span class="text-danger">{{ $message }}</span>
						@enderror
					</div>

					<!-- Password Input -->
					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" name="password" required>
						<span class="focus-input100" data-placeholder="Password"></span>
						@error('password')
						<span class="text-danger">{{ $message }}</span>
						@enderror
					</div>

					<!-- Login Button -->
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn" type="submit">
								Login
							</button>
						</div>
					</div>

					<!-- Sign Up Link -->
					<div class="text-center p-t-115">
						<span class="txt1">
							Don’t have an account?
						</span>
						<a class="txt2" href="{{ route('membre_register') }}">
							Sign Up
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<div id="dropDownSelect1"></div>

	<!-- Scripts -->
	<script src="{{ asset('membrelogin/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
	<script src="{{ asset('membrelogin/vendor/animsition/js/animsition.min.js') }}"></script>
	<script src="{{ asset('membrelogin/vendor/bootstrap/js/popper.js') }}"></script>
	<script src="{{ asset('membrelogin/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('membrelogin/vendor/select2/select2.min.js') }}"></script>
	<script src="{{ asset('membrelogin/vendor/daterangepicker/moment.min.js') }}"></script>
	<script src="{{ asset('membrelogin/vendor/daterangepicker/daterangepicker.js') }}"></script>
	<script src="{{ asset('membrelogin/vendor/countdowntime/countdowntime.js') }}"></script>
	<script src="{{ asset('js/main.js') }}"></script>

</body>
</html>
