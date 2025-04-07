

@extends('acceuil.app')

@section('title', 'Services - Mon Site')

@section('content')


<section id="hero" class="hero section accent-background">
  <section class="services-hero">
      <div class="services-container">
          <div class="hero-content">
              <img src="{{ asset('services/assets/img/black-services.jpg') }}" 
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
<style>



  /* Conteneur principal */


/* Section titre */
.hero-title {
    font-size: 2.5rem; /* Taille du texte */
    color: #000000; /* Texte noir */
    font-weight: bold;
    line-height: 1.2;
    margin-bottom: 1rem;
    text-align: center;
}

/* Accent sur le texte */
.hero-title .accent {
    color: #ff6f61; /* Rouge vif pour l'accent */
}

/* Disposition de la section */
.row {
    display: flex;
    justify-content: center; /* Centrer le contenu horizontalement */
    align-items: center; /* Centrer le contenu verticalement */
    text-align: center;
}

.col-lg-12 {
    flex-direction: column;
    display: flex;
    justify-content: center;
    align-items: center;
}

/* Effets d'animation */
[data-aos="fade-up"] {
    opacity: 0;
    transform: translateY(20px);
    transition: opacity 0.5s ease, transform 0.5s ease;
}

[data-aos="fade-up"].aos-animate {
    opacity: 1;
    transform: translateY(0);
}

/* Espacement entre les éléments */
.gy-5 {
    gap: 1.25rem;
}


</style>

  </section>

 

  <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
      <div class="row gy-5 justify-content-between align-items-center">
          <!-- Colonne texte -->
          <div class="col-lg-12 d-flex flex-column justify-content-center text-center">
              <h1 class="hero-title">
                  <span>Découvrez les Services </span>
                  <span class="accent">MCF-PME adaptés à vos besoins</span>
              </h1>
          </div>
      </div>
  </div>
</section><!-- /Hero Section -->

<section id="services" class="services">
    <div class="container">
        <h2 class="section-title">Nos Solutions Expertes</h2>
        <p class="section-subtitle"></p>
        
        <div class="service-grid">
            <article class="service-card" id="particuliers">
                <div class="service-content">
                    <i class="fas fa-user-tie service-icon"></i>
                    <h3>Particuliers Exigeants</h3>
                    <p>Solutions sur mesure pour gestion de patrimoine</p>
                    <ul class="service-benefits">
                        <li><i class="fas fa-check"></i> Audit financier personnalisé</li>
                        <li><i class="fas fa-check"></i> Stratégie d'investissement</li>
                        <li><i class="fas fa-check"></i> Optimisation fiscale</li>
                    </ul>
                    <a href="#contact" class="cta-button">Découvrir <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </article>

            <article class="service-card" id="entreprises">
                <div class="service-content">
                    <i class="fas fa-building service-icon"></i>
                    <h3>Entreprises Visionnaires</h3>
                    <p>Management financier haute performance</p>
                    <ul class="service-benefits">
                        <li><i class="fas fa-check"></i> Analyse de rentabilité</li>
                        <li><i class="fas fa-check"></i> Gestion de trésorerie</li>
                        <li><i class="fas fa-check"></i> Conseil en fusion-acquisition</li>
                    </ul>
                    <a href="#contact" class="cta-button">Explorer <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </article>
        </div>
    </div>
    <div class="row justify-content-center" style="margin-top: 2cm;">
        <div class="d-flex flex-wrap justify-content-center gap-4">
            <div class="box interactive-box text-center" onclick="alert('Explorez nos stratégies de croissance!')">
                <i class="fas fa-chart-line feature-icon"></i>
                <h3>Croissance Intelligente</h3>
                <p>Stratégies évolutives pour développement durable</p>
            </div>
            <div class="box interactive-box text-center" onclick="alert('Découvrez nos solutions de sécurité!')">
                <i class="fas fa-shield-alt feature-icon"></i>
                <h3>Sécurité Maximale</h3>
                <p>Protection avancée de vos actifs numériques</p>
            </div>
            <div class="box interactive-box text-center" onclick="alert('Inspirez-vous de nos innovations!')">
                <i class="fas fa-lightbulb feature-icon"></i>
                <h3>Innovation Continue</h3>
                <p>Idées novatrices pour rester compétitif</p>
            </div>
        </div>
    </div>
    <style>

         /* Flexbox container to align service cards */
    .service-grid {
        display: flex;
        justify-content: space-between; /* Aligns items horizontally with space between */
        gap: 20px; /* Adds space between the service cards */
        flex-wrap: wrap; /* Makes sure that the cards wrap onto the next line if the screen is smaller */
    }

    .service-card {
        background-color: #fff;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        flex: 1 1 calc(50% - 20px); /* 50% width with space for gap */
        box-sizing: border-box;
        transition: transform 0.3s, box-shadow 0.3s;
    }

    /* Hover effect for service cards */
    .service-card:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
    }

    .service-content {
        text-align: center;
    }

    .service-icon {
        font-size: 3rem;
        color: #007bff;
    }

    .cta-button {
        display: inline-flex;
        align-items: center;
        background-color: #007bff;
        color: white;
        padding: 10px 20px;
        text-decoration: none;
        border-radius: 5px;
        margin-top: 10px;
    }

    .cta-button i {
        margin-left: 5px;
    }

    @media (max-width: 768px) {
        .service-card {
            flex: 1 1 100%; /* On smaller screens, the cards take full width */
        }
    }
        .interactive-box {
            cursor: pointer;
            transition: transform 0.3s, box-shadow 0.3s;
            border-radius: 15px;
            padding: 20px;
            background-color: #f8f9fa;
            width: 300px;
        }
        .interactive-box:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }
        .feature-icon {
            font-size: 2rem;
            margin-bottom: 10px;
            color: #007bff;
        }
    </style>
</section>



<!-- Team Section -->
<section id="team" class="team section">
  

  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <h2>Team MFC-PME</h2>
    <p>Notre équipe est composée de professionnels passionnés et dévoués, chacun apportant une expertise unique pour soutenir les petites et moyennes entreprises dans leur croissance et leur succès.</p>
  </div><!-- End Section Title -->
  
  <div class="row gy-4">
    <div class="leader-card">
        <img src="{{ asset('services/assets/img/team/team-3.jpg') }}" alt="Directeur Général" class="img-fluid">
        <div class="content">
            <div class="leader-info">
                <h4>KO SSOBA</h4>
                <p>Directeur Général</p>
            </div>
            <h2>Mots du Directeur Général</h2>
            <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
        </div>
    </div>
</div>
  
<style>
/* Bloc Directeur Général */
.leader-card {
  display: flex;
  gap: 40px;
  align-items: flex-start;
  background: linear-gradient(to right, #f8f9fa 0%, #ffffff 30%);
  padding: 40px;
  border-radius: 15px;
  position: relative;
  overflow: hidden;
  transition: transform 0.3s ease;
}

.leader-card:hover {
  transform: translateY(-5px);
}

.leader-card img {
  flex: 0 0 40%;
  max-width: 400px;
  height: auto;
  border-radius: 10px;
  box-shadow: 0 10px 30px rgba(0,0,0,0.1);
  transform: rotate(-3deg);
}

.leader-card .content {
  flex: 1;
  position: relative;
  padding-left: 40px;
}

.leader-card .content::before {
  content: '';
  position: absolute;
  left: 0;
  top: 0;
  height: 100%;
  width: 4px;
  background: linear-gradient(to bottom, #3f78e0, #6bd6e0);
}

.leader-card h4 {
  color: #2a2a2a;
  font-size: 1.8rem;
  margin-bottom: 5px;
  position: relative;
  display: inline-block;
}

.leader-card h4::after {
  content: '';
  position: absolute;
  bottom: -5px;
  left: 0;
  width: 50%;
  height: 2px;
  background: #3f78e0;
}

.leader-card p:first-of-type {
  color: #6c757d;
  font-style: italic;
  margin-bottom: 30px;
}

.leader-card h2 {
  color: #1a1a1a;
  font-size: 2.5rem;
  margin-bottom: 20px;
  line-height: 1.2;
  text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
}

.leader-card p:last-of-type {
  color: #4a4a4a;
  font-size: 1.1rem;
  line-height: 1.6;
  max-width: 600px;
}

/* Responsive Design */
@media (max-width: 768px) {
  .leader-card {
      flex-direction: column;
      padding: 20px;
  }
  
  .leader-card img {
      flex: none;
      width: 100%;
      max-width: none;
      transform: rotate(0);
  }
  
  .leader-card .content {
      padding-left: 20px;
  }
  
  .leader-card h2 {
      font-size: 2rem;
  }
}
</style>

  <div class="container">
    <div class="row gy-4">
      <!-- Team Member 1 -->
      <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100">
        <div class="member">
          <img src="services/assets/img/team/team-1.jpg" class="img-fluid" alt="Walter White">
          <h4>Walter White</h4>
          <span>Web Development</span>
          <div class="social">
            <a href=""><i class="bi bi-twitter"></i></a>
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a>
            <a href=""><i class="bi bi-linkedin"></i></a>
          </div>
        </div>
      </div><!-- End Team Member 1 -->

      <!-- Team Member 2 -->
      <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="200">
        <div class="member">
          <img src="services/assets/img/team/team-2.jpg" class="img-fluid" alt="Sarah Jhinson">
          <h4>Sarah Jhinson</h4>
          <span>Marketing</span>
          <div class="social">
            <a href=""><i class="bi bi-twitter-x"></i></a>
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a>
            <a href=""><i class="bi bi-linkedin"></i></a>
          </div>
        </div>
      </div><!-- End Team Member 2 -->

      <!-- Team Member 3 -->
      <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="300">
        <div class="member">
          <img src="services/assets/img/team/team-3.jpg" class="img-fluid" alt="William Anderson">
          <h4>William Anderson</h4>
          <span>Consultant</span>
          <div class="social">
            <a href=""><i class="bi bi-twitter-x"></i></a>
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a>
            <a href=""><i class="bi bi-linkedin"></i></a>
          </div>
        </div>
      </div><!-- End Team Member 3 -->

      <!-- Team Member 4 -->
      <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="400">
        <div class="member">
          <img src="services/assets/img/team/team-4.jpg" class="img-fluid" alt="Amanda Jepson">
          <h4>Amanda Jepson</h4>
          <span>Comptable</span>
          <div class="social">
            <a href=""><i class="bi bi-twitter-x"></i></a>
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a>
            <a href=""><i class="bi bi-linkedin"></i></a>
          </div>
        </div>
      </div><!-- End Team Member 4 -->

    </div>
  </div>
</section><!-- /Team Section -->


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
