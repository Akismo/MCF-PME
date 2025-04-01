<x-app-layout>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --secondary-gradient: linear-gradient(45deg, #ff6b6b, #ff9f43);
            --glass-bg: rgba(255, 255, 255, 0.1);
            --neon-blue: #4bc0c0;
        }

        /* Effet de particules animées en arrière-plan */
        .dashboard-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: var(--primary-gradient);
            z-index: -1;
            overflow: hidden;
        }

        .dashboard-bg::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 10%, transparent 20%);
            background-size: 50px 50px;
            animation: particleFlow 20s linear infinite;
        }

        @keyframes particleFlow {
            100% { transform: translate(50%, 50%); }
        }

        /* Carte en verre avec effet 3D */
        .glass-card {
            background: var(--glass-bg);
            backdrop-filter: blur(12px);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            transform-style: preserve-3d;
            transition: all 0.5s ease;
            position: relative;
            overflow: hidden;
        }

        .glass-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(
                90deg,
                transparent,
                rgba(255, 255, 255, 0.2),
                transparent
            );
            transition: 0.5s;
        }

        .glass-card:hover {
            transform: translateY(-10px) rotateX(5deg) rotateY(5deg);
            box-shadow: 0 15px 35px rgba(0,0,0,0.3);
        }

        .glass-card:hover::before {
            left: 100%;
        }

        /* Effet néon sur les icônes */
        .neon-icon {
            filter: drop-shadow(0 0 5px var(--neon-blue));
            transition: 0.3s;
        }

        .neon-icon:hover {
            filter: drop-shadow(0 0 15px var(--neon-blue));
            transform: scale(1.1);
        }

        /* Graphique personnalisé */
        .chart-container {
            background: var(--glass-bg);
            border-radius: 20px;
            padding: 2rem;
            position: relative;
            overflow: hidden;
        }

        .chart-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: var(--secondary-gradient);
            opacity: 0.1;
            z-index: -1;
        }

        /* Animation de texte flottant */
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }

        .floating-text {
            animation: float 3s ease-in-out infinite;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        }

        /* Bouton holographique */
        .holographic-btn {
            background: var(--glass-bg);
            position: relative;
            overflow: hidden;
            transition: 0.5s;
        }

        .holographic-btn::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, #4bc0c0, transparent);
            transform: rotate(45deg);
            animation: hologram 3s linear infinite;
        }

        @keyframes hologram {
            0% { transform: rotate(45deg) translateX(-50%); }
            100% { transform: rotate(45deg) translateX(50%); }
        }

        /* Liste d'activités avec effet de vague */
        .activity-wave li {
            position: relative;
            padding: 1rem;
            margin-bottom: 1rem;
        }

        .activity-wave li::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255,255,255,0.05);
            clip-path: polygon(0 0, 100% 0, 95% 100%, 0 100%);
            transform: scaleX(0);
            transform-origin: left;
            transition: 0.5s;
        }

        .activity-wave li:hover::before {
            transform: scaleX(1);
        }

        /* Curseur personnalisé */
        body {
            cursor: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><circle cx="12" cy="12" r="8" fill="%234bc0c0" opacity="0.5"/></svg>'), auto;
        }
    </style>

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-3xl text-white floating-text">
                {{ __('Dashboard Administrateur') }}
            </h2>
            <button id="themeToggle" class="holographic-btn px-6 py-2 rounded-full text-white">
                <i class="fas fa-magic neon-icon"></i>
            </button>
        </div>
    </x-slot>

    <div class="dashboard-bg"></div>

    <div class="py-12 min-h-screen relative z-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Grille de statistiques -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Carte Membres -->
                <div class="glass-card p-6 transform perspective-1000">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-300 text-sm mb-2">Membres</p>
                            <p class="text-4xl font-bold text-white">{{ $membersCount ?? '0' }}</p>
                        </div>
                        <i class="fas fa-users text-3xl neon-icon"></i>
                    </div>
                    <div class="h-1 bg-gradient-to-r from-blue-400 to-purple-400 mt-4 rounded-full"></div>
                </div>

                <!-- Les autres cartes similaires avec des couleurs différentes -->
            </div>

            <!-- Section Graphique + Activités -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div class="chart-container">
                    <h3 class="text-xl font-bold text-white mb-4">Statistiques des demandes</h3>
                    <canvas id="requestsChart" class="w-full h-64"></canvas>
                </div>

                <div class="glass-card p-6">
                    <h3 class="text-xl font-bold text-white mb-4">Activités récentes</h3>
                    <ul class="activity-wave">
                        @forelse($recentActivities ?? [] as $activity)
                            <li class="text-white relative z-10">
                                <div class="flex items-center">
                                    <i class="fas fa-bolt text-yellow-400 mr-3 neon-icon"></i>
                                    <span>{{ $activity->description }}</span>
                                </div>
                                <span class="text-xs text-gray-300 block mt-1">{{ $activity->created_at->diffForHumans() }}</span>
                            </li>
                        @empty
                            <li class="text-gray-300">Aucune activité récente</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Initialisation du graphique avec animation personnalisée
        const ctx = document.getElementById('requestsChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: { ... },
            options: {
                responsive: true,
                animation: {
                    duration: 2000,
                    easing: 'easeOutQuart'
                },
                elements: {
                    line: {
                        tension: 0.4
                    },
                    point: {
                        radius: 0,
                        hoverRadius: 6
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            font: {
                                size: 14,
                                family: 'Inter'
                            },
                            color: '#fff'
                        }
                    }
                },
                scales: {
                    x: {
                        grid: { color: 'rgba(255,255,255,0.1)' },
                        ticks: { color: '#fff' }
                    },
                    y: {
                        grid: { color: 'rgba(255,255,255,0.1)' },
                        ticks: { color: '#fff' }
                    }
                }
            }
        });
    </script>
</x-app-layout>