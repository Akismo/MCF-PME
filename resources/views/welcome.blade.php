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
                    <h4 class="title"><a href="" class="stretched-link">Assistance aux PME</a></h4>
                    </div>
                </div><!--End Icon Box -->

                <div class="col-xl-3 col-md-6">
                    <div class="icon-box">
                    <img src="{{ asset('acceuil/assets/img/about.jpg') }}" alt="Assistance aux PME" class="img-fluid">
                    <h4 class="title"><a href="" class="stretched-link">Produits de Prêts</a></h4>
                    </div>
                </div><!--End Icon Box -->

                <div class="col-xl-3 col-md-6">
                    <div class="icon-box">
                    <img src="{{ asset('acceuil/assets/img/about.jpg') }}" alt="Assistance aux PME" class="img-fluid">
                    <h4 class="title"><a href="" class="stretched-link">Appui et d'Encadrement(SAE)</a></h4>
                    </div>
                </div><!--End Icon Box -->

                <div class="col-xl-3 col-md-6">
                    <div class="icon-box">
                    <img src="{{ asset('acceuil/assets/img/about.jpg') }}" alt="Assistance aux PME" class="img-fluid">
                    <h4 class="title"><a href="" class="stretched-link">Produits de dépot</a></h4>
                    </div>
                </div><!--End Icon Box -->

                </div>
            </div>
        </div>
    
     <section class="container py-5 devenir-client">
                <div class="text-center mb-4">
                    <h2>Comment devenir client </br> MCF-PME ?</h2>
                    <p>Vous souhaitez devenir client MCF-PME ? Suivez ces trois étapes :</p>
                </div>

                <div class="row justify-content-center">
                    <!-- Étape 1 -->
                    <div class="col-md-4 d-flex flex-column align-items-center text-center mb-4 mb-md-0 step">
                        <img src="{{ asset('images/etape1.png') }}" alt="Étape 1" class="img-fluid mb-3">
                        <h5 class="mb-2">1</h5>
                        <p class="mb-0">
                            Je renseigne le formulaire de préouverture de compte
                            sur le site web de Cofina Côte d'Ivoire.
                        </p>
                    </div>

                    <!-- Étape 2 -->
                    <div class="col-md-4 d-flex flex-column align-items-center text-center mb-4 mb-md-0 step">
                        <img src="{{ asset('images/etape2.png') }}" alt="Étape 2" class="img-fluid mb-3">
                        <h5 class="mb-2">2</h5>
                        <p class="mb-0">
                            Je suis contacté par l'équipe commerciale
                            pour confirmation de l'ouverture de mon compte.
                        </p>
                    </div>

                    <!-- Étape 3 -->
                    <div class="col-md-4 d-flex flex-column align-items-center text-center step">
                        <img src="{{ asset('images/etape3.png') }}" alt="Étape 3" class="img-fluid mb-3">
                        <h5 class="mb-2">3</h5>
                        <p class="mb-0">
                            Je me rends en agence pour finaliser mon ouverture de compte
                            muni des documents nécessaires.
                        </p>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <a href="#" class="btn btn-danger">
                        Devenir client
                    </a>
                </div>
     </section>



    <section id="" class="services section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Nos Services</h2>
            <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
        </div><!-- End Section Title -->

        <div class="container">

        <div class="row gy-4">

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="service-item  position-relative">
                <div class="icon">
                <i class="bi bi-activity"></i>
                </div>
                <h3>Nesciunt Mete</h3>
                <p>Provident nihil minus qui consequatur non omnis maiores. Eos accusantium minus dolores iure perferendis tempore et consequatur.</p>
                <a href="service-details.html" class="readmore stretched-link">Read more <i class="bi bi-arrow-right"></i></a>
            </div>
            </div><!-- End Service Item -->

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="service-item position-relative">
                <div class="icon">
                <i class="bi bi-broadcast"></i>
                </div>
                <h3>Eosle Commodi</h3>
                <p>Ut autem aut autem non a. Sint sint sit facilis nam iusto sint. Libero corrupti neque eum hic non ut nesciunt dolorem.</p>
                <a href="service-details.html" class="readmore stretched-link">Read more <i class="bi bi-arrow-right"></i></a>
            </div>
            </div><!-- End Service Item -->

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="service-item position-relative">
                <div class="icon">
                <i class="bi bi-easel"></i>
                </div>
                <h3>Ledo Markt</h3>
                <p>Ut excepturi voluptatem nisi sed. Quidem fuga consequatur. Minus ea aut. Vel qui id voluptas adipisci eos earum corrupti.</p>
                <a href="service-details.html" class="readmore stretched-link">Read more <i class="bi bi-arrow-right"></i></a>
            </div>
            </div><!-- End Service Item -->

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
            <div class="service-item position-relative">
                <div class="icon">
                <i class="bi bi-bounding-box-circles"></i>
                </div>
                <h3>Asperiores Commodit</h3>
                <p>Non et temporibus minus omnis sed dolor esse consequatur. Cupiditate sed error ea fuga sit provident adipisci neque.</p>
                <a href="service-details.html" class="readmore stretched-link">Read more <i class="bi bi-arrow-right"></i></a>
            </div>
            </div><!-- End Service Item -->

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
            <div class="service-item position-relative">
                <div class="icon">
                <i class="bi bi-calendar4-week"></i>
                </div>
                <h3>Velit Doloremque</h3>
                <p>Cumque et suscipit saepe. Est maiores autem enim facilis ut aut ipsam corporis aut. Sed animi at autem alias eius labore.</p>
                <a href="service-details.html" class="readmore stretched-link">Read more <i class="bi bi-arrow-right"></i></a>
            </div>
            </div><!-- End Service Item -->

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
            <div class="service-item position-relative">
                <div class="icon">
                <i class="bi bi-chat-square-text"></i>
                </div>
                <h3>Dolori Architecto</h3>
                <p>Hic molestias ea quibusdam eos. Fugiat enim doloremque aut neque non et debitis iure. Corrupti recusandae ducimus enim.</p>
                <a href="service-details.html" class="readmore stretched-link">Read more <i class="bi bi-arrow-right"></i></a>
            </div>
            </div><!-- End Service Item -->

        </div>

        </div>

    </section>

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

    @extends('layouts.app')

    

<section id="contact" class="contact section">
<form action="{{ route('contact.submit') }}" method="post" class="php-email-form" data-aos="fade" data-aos-delay="100">
    @csrf  <!-- Protection CSRF -->

    <div class="row gy-4">
        <div class="col-md-6">
            <input type="text" name="name" class="form-control" placeholder="Votre nom" required>
        </div>

        <div class="col-md-6">
            <input type="email" class="form-control" name="email" placeholder="Votre e-mail" required>
        </div>

        <div class="col-md-12">
            <input type="text" class="form-control" name="subject" placeholder="Objet" required>
        </div>

        <div class="col-md-12">
            <textarea class="form-control" name="message" rows="8" placeholder="Message" required></textarea>
        </div>

        <div class="col-md-12 text-center">
            <div class="loading">Veuillez patienter...</div>
            <div class="error-message"></div>
            <div class="sent-message">Merci, votre message a été envoyé avec succès !</div>

            <button type="submit">Envoyer le message</button>
        </div>
    </div>
    @extends('layouts.app')
</form>

</section><!-- /Contact Section -->



{{-- Section Content --}}
    <section id="" class="centre-ressources">
    <div class="container section-title" data-aos="fade-up">
        <h2>Centre de Ressources</h2>
        <p>Téléchargez nos documents d'information et guides pratiques pour une meilleure utilisation de vos services mutuels.</p>
    </div><!-- End Section Title -->

    <div class="download-grid">
        <!-- Carte 1 -->
        <article class="download-card">
            <span class="badge">Nouveau</span>
            <div class="card-header">
                <i class="fas fa-file-pdf file-icon"></i>
                <div>
                    <h3>Guide Adhérent 2024</h3>
                    <p>Guide complet pour les adhérents de notre service mutuel</p>
                    <a href="#" class="download-link">Télécharger <i class="fas fa-download"></i></a>
                </div>
            </div>
        </article>
        <!-- Carte 2 -->
        <article class="download-card">
            <span class="badge">Nouveau</span>
            <div class="card-header">
                <i class="fas fa-file-pdf file-icon"></i>
                <div>
                    <h3>Guide Adhérent 2023</h3>
                    <p>Guide complet pour les adhérents de notre service mutuel</p>
                    <a href="#" class="download-link">Télécharger <i class="fas fa-download"></i></a>
                </div>
            </div>
        </article>
        <!-- Carte 3 -->
        <article class="download-card">
            <span class="badge">Nouveau</span>
            <div class="card-header">
                <i class="fas fa-file-pdf file-icon"></i>
                <div>
                    <h3>Guide Adhérent 2022</h3>
                    <p>Guide complet pour les adhérents de notre service mutuel</p>
                    <a href="#" class="download-link">Télécharger <i class="fas fa-download"></i></a>
                </div>
            </div>
        </article>
    </div>
    </section>
    

    <div>{{ optional(Auth::user())->name ?? 'Invité' }}</div>


@endsection
