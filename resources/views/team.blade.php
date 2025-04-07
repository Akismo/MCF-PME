@extends('acceuil.app')

@section('title', 'team - Mon Site')

@section('content')


<section class="team-section">
    <div class="team-title">
        <h2>Notre Équipe</h2>
        <p>Des professionnels dévoués à votre réussite financière</p>
    </div>

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

    <div class="team-grid">
        <!-- Membre 1 -->
        <div class="team-member">
            <div class="member-image">
                <img src="{{ asset('assets/img/team1.jpg') }}" alt="Jean Dupont">
            </div>
            <div class="member-info">
                <h3>Jean Dupont</h3>
                <p>Directeur Financier</p>
                <div class="member-social">
                    <a href="#" class="social-link"><i class="fab fa-linkedin"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="social-link"><i class="fas fa-envelope"></i></a>
                </div>
            </div>
        </div>

        <!-- Membre 2 -->
        <div class="team-member">
            <div class="member-image">
                <img src="{{ asset('assets/img/team2.jpg') }}" alt="Marie Leroy">
            </div>
            <div class="member-info">
                <h3>Marie Leroy</h3>
                <p>Responsable Crédit</p>
                <div class="member-social">
                    <a href="#" class="social-link"><i class="fab fa-linkedin"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-link"><i class="fas fa-envelope"></i></a>
                </div>
            </div>
        </div>

        <!-- Membre 3 -->
        <div class="team-member">
            <div class="member-image">
                <img src="{{ asset('assets/img/team3.jpg') }}" alt="Paul Martin">
            </div>
            <div class="member-info">
                <h3>Paul Martin</h3>
                <p>Expert en Investissements</p>
                <div class="member-social">
                    <a href="#" class="social-link"><i class="fab fa-linkedin"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-github"></i></a>
                    <a href="#" class="social-link"><i class="fas fa-envelope"></i></a>
                </div>
            </div>
        </div>

        <!-- Membre 4 -->
        <div class="team-member">
            <div class="member-image">
                <img src="{{ asset('assets/img/team4.jpg') }}" alt="Sophie Dubois">
            </div>
            <div class="member-info">
                <h3>Sophie Dubois</h3>
                <p>Conseillère Clientèle</p>
                <div class="member-social">
                    <a href="#" class="social-link"><i class="fab fa-linkedin"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="social-link"><i class="fas fa-envelope"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>










@endsection