<!-- Hero Section -->
<section id="hero" class="hero section accent-background">
    <!-- Hero Content Section -->
    <section class="services-hero">
        <div class="services-container">
            <div class="hero-content">
                <img src="{{ asset('assets/img/black-services.jpg') }}" 
                     alt="Services MCF-PME" 
                     class="service-image"
                     style="border-radius: 15px 30px;
                            max-height: 300px;
                            width: auto;
                            object-fit: cover;
                            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
                            display: block;
                            margin: 0 auto;">
            </div>
        </div>
    </section>

    <!-- Style Inline pour ajustements rapides -->
    <style>
        .services-hero {
            padding: 2rem 1rem; /* Réduction du padding */
        }

        .service-image {
            transition: all 0.3s ease;
        }

        /* Version responsive */
        @media (max-width: 768px) {
            .service-image {
                max-height: 200px;
                border-radius: 10px 20px;
            }
        }
    </style>

    <!-- Main Hero Text -->
    <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
        <div class="row gy-5 justify-content-between align-items-center">
            <!-- Colonne texte -->
            <div class="col-lg-12 d-flex flex-column justify-content-center text-center">
                <h1 class="hero-title"><span>Découvrez les Services </span><span class="accent">MCF-PME adaptés à vos besoins</span></h1>
            </div>
        </div>
    </div>
</section><!-- /Hero Section -->
