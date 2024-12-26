<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('storage/images/clinic-64.png') }}" type="image/x-icon">
    <style>
        .hero-section {
            background: url('{{ asset('background/seo-2126-bs-health-concept-medical-healt-340085269-1200x675.jpg') }}') center center no-repeat;
            background-size: cover;
            color: white;
            padding: 120px 0;
        }

        .feature-icon {
            font-size: 3rem;
            color: #0066cc;
        }

        .text-border {
            color: black;
            font-size: 3.5rem;
            font-weight: bold;
            text-shadow: 2px 2px 5px white, -2px -2px 5px white, 2px -2px 5px white, -2px 2px 5px white;
        }

        .lead-text {
            color: black;
            font-size: 1.5rem;
            font-weight: bold;
            text-shadow: 2px 2px 5px white, -2px -2px 5px white, 2px -2px 5px white, -2px 2px 5px white;
        }

        .section-title {
            margin-bottom: 50px;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container-fluid min-vh-100 d-flex flex-column">
        <!-- Navigation Bar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="#"> Advance Health Management System</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        @if (Route::has('login'))
                            @auth
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/home') }}">Home</a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">Log in</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                                    </li>
                                @endif
                            @endauth
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <section class="hero-section text-center text-white">
            <div class="container">
                <h1 class="display-4 mb-4 text-border">
                    <strong>Welcome to Your Advanced Health Management System</strong>
                </h1>
                <p class="lead mb-4 lead-text">
                    Empowering you to take charge of your health with ease and confidence.
                </p>
                <div class="d-flex gap-3 justify-content-center">
                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Log In</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg"
                            style="border: 2px solid black; color:black;">Register</a>
                    @endif
                </div>
            </div>
        </section>

        <!-- Key Features -->
        <section class="container py-5">
            <h2 class="text-center section-title">Key Features</h2>
            <div class="row text-center">
                <div class="col-md-4">
                    <div class="feature-icon mb-3">
                        <i class="bi bi-heart"></i>
                    </div>
                    <h4>Health Monitoring</h4>
                    <p>Track your health metrics like blood pressure, heart rate, and more in real time.</p>
                </div>
                <div class="col-md-4">
                    <div class="feature-icon mb-3">
                        <i class="bi bi-calendar-check"></i>
                    </div>
                    <h4>Appointments</h4>
                    <p>Book and manage your appointments with health professionals at your convenience.</p>
                </div>
                <div class="col-md-4">
                    <div class="feature-icon mb-3">
                        <i class="bi bi-shield-lock"></i>
                    </div>
                    <h4>Secure Data</h4>
                    <p>Your personal health data is kept safe with advanced encryption methods.</p>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-white text-center py-3 mt-auto border-top">
            <div class="container">
                <span class="text-muted">Powered by {{ config('app.name', 'Health Management System') }} | Laravel
                    v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})</span>
            </div>
        </footer>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstraps-icons/1.8.1/font/bootstrap-icons.min.js"></script>
</body>

</html>