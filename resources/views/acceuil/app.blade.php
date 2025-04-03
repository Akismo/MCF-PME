<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>@yield('title', 'Impact Bootstrap Template')</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="{{ asset('acceuil/assets/img/favicon.ico') }}" rel="icon">
  <link href="{{ asset('acceuil/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&family=Montserrat:wght@100;200;300;400;500;600;700;800;900&family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('acceuil/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('acceuil/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('acceuil/assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('acceuil/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('acceuil/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{ asset('acceuil/assets/css/main.css') }}" rel="stylesheet">
</head>
<body>

  <!-- Inclusion du header -->
  @include('acceuil.header')

  <!-- Contenu de la page -->
  <main>
    @yield('content')
  </main>

  @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif


  <!-- Inclusion du footer -->
  @include('acceuil.footer')



    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('acceuil/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('acceuil/assets/vendor/php-email-form/validate.js')}}"></script>
    <script src="{{ asset('acceuil/assets/vendor/aos/aos.js')}}"></script>
    <script src="{{ asset('acceuil/assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
    <script src="{{ asset('acceuil/assets/vendor/swiper/swiper-bundle.min.js')}}"></script>
    <script src="{{ asset('acceuil/assets/vendor/purecounter/purecounter_vanilla.js')}}"></script>
    <script src="{{ asset('acceuil/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js')}}"></script>
    <script src="{{ asset('acceuil/assets/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>

    <!-- Main JS File -->
    <script src="{{ asset('acceuil/assets/js/main.js')}}"></script>

</body>
</html>
