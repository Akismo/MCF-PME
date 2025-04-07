@extends('acceuil.app')

@section('title', 'Accueil - Mon Site')

@section('content')

    <section id="" class="hero section accent-background">

        <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
            <div class="row gy-5 justify-content-between">
                <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
                    <h2><span>Bienvenue sur la </span><span class="accent">plateforme de MCF-PME</span></h2>
                    <p>
                        Bienvenue sur la plateforme de MCF-PME
                        La Mutuelle de Crédit et de Financement des Petites et Moyennes Entreprises (MCF-PME) est 
                        une institution de microfinance agréée par le Ministère de l’Economie et des Finances sous le 
                        N°A-1-1-6/10-1 du 01 avril 2010. Elle offre des services financiers adaptés aux PME, un 
                        accompagnement en gestion et en renforcement des capacités managériales des dirigeants des PME.
                    </p>            
                    <div class="d-flex">
                        <!-- <a href="#about" class="btn-get-started">Get Started</a> -->
                        <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="glightbox btn-watch-video d-flex align-items-center"><i class="bi bi-play-circle"></i><span>Voir la Video</span></a>
                    </div>
                </div>
                <div class="col-lg-5 order-1 order-lg-2">
                    <img src="{{ asset('acceuil/assets/img/particilier.jpg')}}" class="img-fluid" alt="">
                </div>
            </div>
        </div>

        <div class="icon-boxes position-relative" data-aos="fade-up" data-aos-delay="200">
            <div class="container position-relative">
                <div class="row gy-4 mt-5">

                <div class="col-xl-3 col-md-6">
                    <div class="icon-box">
                    <img src="{{ asset('acceuil/assets/img/about.jpg') }}" alt="Assistance aux PME" class="img-fluid">
                    <h3>Entreprises Visionnaires</h3>
                    <p>Management financier haute performance</p>
                    <ul class="service-benefits">
                        <li><i class="fas fa-check"></i> Analyse de rentabilité</li>
                        <li><i class="fas fa-check"></i> Gestion de trésorerie</li>
                        <li><i class="fas fa-check"></i> Conseil en fusion-acquisition</li>
                    </ul>
                    <a href="#contact" class="cta-button">Explorer <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div><!--End Icon Box -->

                <div class="col-xl-3 col-md-6">
                    <div class="icon-box">
                    <img src="{{ asset('acceuil/assets/img/about.jpg') }}" alt="Assistance aux PME" class="img-fluid">
                    <h3>Particuliers Exigeants</h3>
                    <p>Solutions sur mesure pour gestion de patrimoine</p>
                    <ul class="service-benefits">
                        <li><i class="fas fa-check"></i> Audit financier personnalisé</li>
                        <li><i class="fas fa-check"></i> Stratégie d'investissement</li>
                        <li><i class="fas fa-check"></i> Optimisation fiscale</li>
                    </ul>
                    <a href="#contact" class="cta-button">Découvrir <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div><!--End Icon Box -->

                </div>
            </div>
            <div class="wave"></div>
        </div>
        
    <section class="container py-5 devenir-client">
                <div class="text-center mb-4">
                    <h2>Comment devenir client </br> MCF-PME ?</h2>
                    <p>Vous souhaitez devenir client MCF-PME ? Suivez ces trois étapes :</p>
                </div>

                <div class="row justify-content-center">
                    <!-- Étape 1 -->
                    <div class="col-md-4 d-flex flex-column align-items-center text-center mb-4 mb-md-0 step">
                        <img src="{{ asset('acceuil/images/etape1.png') }}" alt="Étape 1" class="img-fluid mb-3">
                        <h5 class="mb-2">1</h5>
                        <p class="mb-0">
                            Je renseigne le formulaire de préouverture de compte
                            sur le site web de Cofina Côte d'Ivoire.
                        </p>
                    </div>

                    <!-- Étape 2 -->
                    <div class="col-md-4 d-flex flex-column align-items-center text-center mb-4 mb-md-0 step">
                        <img src="{{ asset('acceuil/images/etape2.png') }}" alt="Étape 2" class="img-fluid mb-3">
                        <h5 class="mb-2">2</h5>
                        <p class="mb-0">
                            Je suis contacté par l'équipe commerciale
                            pour confirmation de l'ouverture de mon compte.
                        </p>
                    </div>

                    <!-- Étape 3 -->
                    <div class="col-md-4 d-flex flex-column align-items-center text-center step">
                        <img src="{{ asset('acceuil/images/etape3.png') }}" alt="Étape 3" class="img-fluid mb-3">
                        <h5 class="mb-2">3</h5>
                        <p class="mb-0">
                            Je me rends en agence pour finaliser mon ouverture de compte
                            muni des documents nécessaires.
                        </p>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <a href="{{ route('membre_register') }}" class="btn btn-danger" >
                        Devenir client
                    </a>
                </div>
    </section>



    <!-- Section nos services -->
    <section id="services" class="services section">
        <div class="container section-title" data-aos="fade-up">
            <h2>Nos services</h2>
            <p>Découvrez nos solutions adaptées à vos besoins pour développer votre entreprise et simplifier votre quotidien.</p>
        </div><!-- End Section Title -->

        <div class="container">
            <div class="row justify-content-center">
                <div class="d-flex flex-wrap justify-content-center gap-4">
                    <!-- Service 1 -->
                    <div class="box service-box text-center" data-aos="fade-up" data-aos-delay="100">
                        <div class="icon">
                            <i class="bi bi-box-seam"></i>
                        </div>
                        <h3>Packs & Crédits Rattachés</h3>
                        <p>Nous savons vos besoins de trésorerie pour développer votre entreprise et accroître vos parts de marché. Voilà pourquoi des packs dédiés ont été pensés pour vous, nos héros de l’entreprenariat.</p>
                        <a href="service-details.html" class="readmore stretched-link">En savoir plus <i class="bi bi-arrow-right"></i></a>
                    </div>

                    <!-- Service 2 -->
                    <div class="box service-box text-center" data-aos="fade-up" data-aos-delay="200">
                        <div class="icon">
                            <i class="bi bi-piggy-bank"></i>
                        </div>
                        <h3>Épargne</h3>
                        <p>C’est maintenant qu’il faut penser à mettre de côté pour en profiter plus tard. Différentes solutions d’épargne vous sont proposées.</p>
                        <a href="service-details.html" class="readmore stretched-link">En savoir plus <i class="bi bi-arrow-right"></i></a>
                    </div>

                    <!-- Service 3 -->
                    <div class="box service-box text-center" data-aos="fade-up" data-aos-delay="300">
                        <div class="icon">
                            <i class="bi bi-credit-card"></i>
                        </div>
                        <h3>Monétique</h3>
                        <p>Nous savons vos besoins de trésorerie pour développer votre entreprise et accroître vos parts de marché. Voilà pourquoi des packs dédiés ont été pensés pour vous, nos héros de l’entreprenariat.</p>
                        <a href="service-details.html" class="readmore stretched-link">En savoir plus <i class="bi bi-arrow-right"></i></a>
                    </div>

                    <!-- Service 4 -->
                    <div class="box service-box text-center" data-aos="fade-up" data-aos-delay="400">
                        <div class="icon">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <h3>Assurance</h3>
                        <p>Nous comprenons vos besoins de simplicité et de liberté pour mener à bien vos différents projets et faire des économies.</p>
                        <a href="service-details.html" class="readmore stretched-link">En savoir plus <i class="bi bi-arrow-right"></i></a>
                    </div>

                    <!-- Service 5 -->
                    <div class="box service-box text-center" data-aos="fade-up" data-aos-delay="500">
                        <div class="icon">
                            <i class="bi bi-cash-coin"></i>
                        </div>
                        <h3>Transfert d'Argent</h3>
                        <p>Parce que nous comprenons vos besoins de rapidité et de flexibilité, nous avons conçu des produits pour vous faciliter le quotidien.</p>
                        <a href="service-details.html" class="readmore stretched-link">En savoir plus <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End Section Nos Services -->


    <section id="" class="team section">

        <div class="container section-title" data-aos="fade-up">
            <h2>Team MFC-PME</h2>
            <p>Notre équipe est composée de professionnels passionnés et dévoués, chacun apportant une expertise unique pour soutenir les petites et moyennes entreprises dans leur croissance et leur succès.</p>
        </div><!-- End Section Title -->

        <div class="container">

            <div class="row gy-4">

                <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100">
                    <div class="member">
                        <img src="{{asset('acceuil/assets/img/team/team-1.jpg')}}" class="img-fluid" alt="">
                        <h4>Walter White</h4>
                        <span>Web Development</span>
                        <div class="social">
                            <a href=""><i class="bi bi-twitter-x"></i></a>
                            <a href=""><i class="bi bi-facebook"></i></a>
                            <a href=""><i class="bi bi-instagram"></i></a>
                            <a href=""><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                </div><!-- End Team Member -->

                <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="200">
                    <div class="member">
                        <img src="{{asset('acceuil/assets/img/team/team-2.jpg')}}" class="img-fluid" alt="">
                        <h4>Sarah Jhinson</h4>
                        <span>Marketing</span>
                        <div class="social">
                            <a href=""><i class="bi bi-twitter-x"></i></a>
                            <a href=""><i class="bi bi-facebook"></i></a>
                            <a href=""><i class="bi bi-instagram"></i></a>
                            <a href=""><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                </div><!-- End Team Member -->

                <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="300">
                    <div class="member">
                        <img src="{{asset('acceuil/assets/img/team/team-3.jpg')}}" class="img-fluid" alt="">
                        <h4>William Anderson</h4>
                        <span>Content</span>
                        <div class="social">
                            <a href=""><i class="bi bi-twitter-x"></i></a>
                            <a href=""><i class="bi bi-facebook"></i></a>
                            <a href=""><i class="bi bi-instagram"></i></a>
                            <a href=""><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                </div><!-- End Team Member -->

                <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="400">
                    <div class="member">
                        <img src="{{ asset('acceuil/assets/img/team/team-4.jpg')}}" class="img-fluid" alt="">
                        <h4>Amanda Jepson</h4>
                        <span>Accountant</span>
                        <div class="social">
                            <a href=""><i class="bi bi-twitter-x"></i></a>
                            <a href=""><i class="bi bi-facebook"></i></a>
                            <a href=""><i class="bi bi-instagram"></i></a>
                            <a href=""><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                </div><!-- End Team Member -->

            </div>

        </div>

    </section>




    <section id="contact" class="contact section">
    <form action="{{ route('contact.submit') }}" method="post" class="php-email-form" data-aos="fade" data-aos-delay="100">
        @csrf  <!-- Protection CSRF -->

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Contact</h2>
            <p>Nous serions heureux de recevoir vos messages et questions. N'hésitez pas à nous contacter !</p>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row gx-lg-0 gy-4">
                
                <!-- Formulaire de contact -->
                <div class="col-lg-8">
                    <form action="forms/contact.php" method="post" class="php-email-form" data-aos="fade" data-aos-delay="100">
                        <div class="row gy-4">

                            <!-- Champ Nom -->
                            <div class="col-md-6">
                                <input type="text" name="name" class="form-control" placeholder="Votre nom" required>
                            </div>

                            <!-- Champ Email -->
                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" placeholder="Votre Email" required>
                            </div>

                            <!-- Champ Sujet -->
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="subject" placeholder="Sujet" required>
                            </div>

                            <!-- Champ Message -->
                            <div class="col-md-12">
                                <textarea class="form-control" name="message" rows="8" placeholder="Votre message" required></textarea>
                            </div>

                            <!-- Zone pour les messages d'état -->
                            <div class="col-md-12 text-center">
                                <div class="loading">Veuillez patienter...</div>
                                <div class="error-message"></div>
                                <div class="sent-message">Merci, votre message a bien été envoyé !</div>

                                <button type="submit">Envoyer le message</button>
                            </div>

                        </div>
                    </form>
                </div><!-- End Contact Form -->

            </div>
        </div>

        <!-- Informations de contact dans des boîtes -->
        <div class="container" data-aos="fade-up" data-aos-delay="200">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="info-item-box d-flex" data-aos="fade-up" data-aos-delay="200">
                        <i class="bi bi-geo-alt flex-shrink-0"></i>
                        <div>
                            <h3>Adresse</h3>
                            <p>A108 Adam Street, New York, NY 535022</p>
                        </div>
                    </div><!-- End Info Item Box -->
                </div>

                <div class="col-md-4">
                    <div class="info-item-box d-flex" data-aos="fade-up" data-aos-delay="300">
                        <i class="bi bi-telephone flex-shrink-0"></i>
                        <div>
                            <h3>Téléphone</h3>
                            <p>(225) 22 41 52 36</p>
                        </div>
                    </div><!-- End Info Item Box -->
                </div>

                <div class="col-md-4">
                    <div class="info-item-box d-flex" data-aos="fade-up" data-aos-delay="400">
                        <i class="bi bi-envelope flex-shrink-0"></i>
                        <div>
                            <h3>Email</h3>
                            <p>mcfpme10@gmail.com</p>
                        </div>
                    </div><!-- End Info Item Box -->
                </div>
            </div><!-- End Row -->
        </div><!-- End Container -->

    </form>
    </section><!-- /Contact Section -->


@endsection
