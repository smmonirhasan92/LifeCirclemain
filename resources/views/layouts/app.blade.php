<!DOCTYPE html>
<html class="scroll-smooth" lang="bn">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Life Circle Regulation' }}</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link crossorigin href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;700;800&family=Work+Sans:wght@300;400;500;600&family=Hind+Siliguri:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@100..700,0..1&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "primary": "#1b4332", 
                        "on-primary": "#ffffff",
                        "primary-container": "#d8e2dc",
                        "secondary": "#2d6a4f",
                        "secondary-container": "#95d5b2",
                        "background": "#fdfaf5", 
                        "surface": "#fdfaf5",
                        "surface-container-low": "#f7f2ea",
                        "surface-container": "#f0ede5",
                        "on-surface": "#1b4332",
                        "on-surface-variant": "#405d4b",
                        "outline": "#787c75"
                    },
                    "fontFamily": {
                        "headline": ["Manrope"],
                        "body": ["Work Sans"],
                        "label": ["Work Sans"],
                        "bengali": ["Hind Siliguri", "sans-serif"]
                    }
                },
            },
        }
    </script>

    <style>
        /* Humanized Transitions & Aesthetics */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .reveal {
            opacity: 0;
            transform: translatey(40px);
            transition: all 1.2s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .reveal.active {
            opacity: 1;
            transform: translatey(0);
        }

        .whisper-shadow {
            box-shadow: 0 20px 40px rgba(27, 67, 50, 0.04);
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        body {
            font-family: 'Work Sans', sans-serif;
            background-color: #fdfaf5;
            color: #1b4332;
        }

        h1, h2, h3 {
            font-family: 'Manrope', sans-serif;
        }

        /* Specialized Bengali Typography - Solves the "Jumbled" issue */
        .font-bengali {
            font-family: 'Hind Siliguri', sans-serif;
            line-height: 1.8;
            letter-spacing: 0.01em;
        }
    </style>
    @stack('styles')
</head>
<body class="bg-surface text-on-surface selection:bg-secondary-container">

    @include('partials.nav')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

    <script>
        // Humanized Scroll Reveal
        const revealElements = document.querySelectorAll('.reveal');
        const revealOnScroll = () => {
            revealElements.forEach(el => {
                const rect = el.getBoundingClientRect();
                const windowHeight = window.innerHeight;
                if (rect.top < windowHeight * 0.9) {
                    el.classList.add('active');
                }
            });
        };

        window.addEventListener('scroll', revealOnScroll);
        window.addEventListener('load', revealOnScroll);
    </script>
    @stack('scripts')
</body>
</html>
