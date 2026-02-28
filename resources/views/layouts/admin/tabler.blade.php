<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Admin Dashboard</title>

    <!-- Google Fonts (Inter) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">

    <!-- Font Awesome (untuk ikon tambahan, optional) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <meta name="msapplication-TileColor" content="#206bc4"/>
    <meta name="theme-color" content="#206bc4"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="mobile-web-app-capable" content="yes"/>
    <meta name="HandheldFriendly" content="True"/>
    <meta name="MobileOptimized" content="320"/>
    <meta name="robots" content="noindex,nofollow,noarchive"/>

    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon"/>
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon"/>

    <!-- CSS -->
    <link href="{{ asset('tabler/dist/libs/jqvmap/dist/jqvmap.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('tabler/dist/css/tabler.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('tabler/dist/css/demo.min.css') }}" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
          integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
          crossorigin=""/>

    <style>
        /* ========== GLOBAL VARIABLES & RESET ========== */
        :root {
            --primary: #6366f1;
            --primary-light: #818cf8;
            --primary-dark: #4f46e5;
            --secondary: #8b5cf6;
            --bg-light: #f9fafc;
            --dark: #1e293b;
            --gray: #64748b;
            --sidebar-bg: rgba(15, 23, 42, 0.95);
            --header-bg: rgba(255, 255, 255, 0.8);
            --glass-border: rgba(255, 255, 255, 0.1);
            --shadow-sm: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --shadow-md: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            --gradient-primary: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(145deg, #f1f5f9 0%, #eef2f6 100%);
            color: var(--dark);
            line-height: 1.6;
            display: none; /* asli */
        }

        /* ========== SIDEBAR ELEGAN ========== */
        .navbar-vertical {
            background: var(--sidebar-bg) !important;
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border-right: 1px solid var(--glass-border);
            box-shadow: 10px 0 30px -10px rgba(0, 0, 0, 0.3);
        }

        .navbar-vertical .navbar-brand {
            padding: 1.5rem 1rem !important;
            border-bottom: 1px solid var(--glass-border);
            margin-bottom: 0.5rem;
        }

        .navbar-vertical .navbar-brand img {
            filter: drop-shadow(0 4px 6px rgba(0, 0, 0, 0.2));
            transition: transform 0.2s;
        }

        .navbar-vertical .navbar-brand img:hover {
            transform: scale(1.02);
        }

        .navbar-vertical .nav-link {
            border-radius: 0.75rem;
            margin: 0.25rem 0.75rem;
            padding: 0.75rem 1rem;
            color: rgba(255, 255, 255, 0.75) !important;
            font-weight: 500;
            transition: all 0.2s;
            position: relative;
            overflow: hidden;
        }

        .navbar-vertical .nav-link::before {
            content: "";
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transition: left 0.5s;
        }

        .navbar-vertical .nav-link:hover::before {
            left: 100%;
        }

        .navbar-vertical .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateX(5px);
            color: #fff !important;
            box-shadow: var(--shadow-sm);
        }

        .navbar-vertical .nav-link.active {
            background: var(--gradient-primary) !important;
            color: white !important;
            box-shadow: 0 10px 20px -5px rgba(102, 126, 234, 0.5);
        }

        .navbar-vertical .nav-link .nav-link-icon {
            color: inherit !important;
            opacity: 0.9;
            transition: transform 0.2s;
        }

        .navbar-vertical .nav-link:hover .nav-link-icon {
            transform: scale(1.1);
        }

        /* Submenu */
        .sidebar-submenu {
            background: rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(10px);
            border-radius: 0.75rem;
            margin: 0.25rem 1rem 0.5rem 1rem;
            padding: 0.5rem 0;
            border: 1px solid var(--glass-border);
        }

        .sidebar-submenu .nav-link {
            padding: 0.5rem 1rem 0.5rem 2rem !important;
            font-size: 0.9rem;
            margin: 0.125rem 0.5rem;
            border-radius: 0.5rem;
        }

        .sidebar-submenu .nav-link.active {
            background: rgba(99, 102, 241, 0.3) !important;
            border-left: 3px solid var(--primary-light);
        }

        .bullet {
            display: inline-block;
            width: 6px;
            height: 6px;
            background: var(--primary-light);
            border-radius: 50%;
            margin-right: 0.75rem;
            box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.3);
            transition: transform 0.2s;
        }

        .sidebar-submenu .nav-link:hover .bullet {
            transform: scale(1.2);
            background: white;
        }

        /* ========== HEADER MODERN ========== */
        .navbar-horizontal {
            background: var(--header-bg) !important;
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            box-shadow: var(--shadow-sm);
            padding: 0.5rem 2rem;
        }

        .navbar-horizontal .nav-link {
            color: var(--dark) !important;
            font-weight: 500;
            border-radius: 2rem;
            padding: 0.5rem 1rem;
            transition: all 0.2s;
        }

        .navbar-horizontal .nav-link:hover {
            background: var(--gradient-primary);
            color: white !important;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px -5px var(--primary);
        }

        /* ========== KONTEN UTAMA ========== */
        .page {
            background: transparent;
        }

        /* Card global */
        .card {
            border: none;
            border-radius: 1.5rem;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            box-shadow: var(--shadow-sm);
            transition: all 0.2s;
        }

        .card:hover {
            box-shadow: var(--shadow-md);
            transform: translateY(-4px);
        }

        .card-header {
            background: transparent;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            font-weight: 600;
            padding: 1.25rem 1.5rem;
        }

        /* ========== FOOTER MINIMALIS ========== */
        .footer {
            background: transparent;
            border-top: 1px solid rgba(0, 0, 0, 0.05);
            color: var(--gray);
            padding: 1.5rem 2rem;
            font-size: 0.9rem;
            backdrop-filter: blur(5px);
        }

        /* ========== TOMBOL ========== */
        .btn-primary {
            background: var(--gradient-primary);
            border: none;
            box-shadow: 0 5px 15px -5px var(--primary);
            transition: all 0.2s;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px var(--primary-dark);
        }

        /* Scrollbar kustom */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--gradient-primary);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, var(--primary-dark), var(--secondary));
        }

        /* Responsive */
        @media (max-width: 768px) {
            .navbar-horizontal {
                padding: 0.5rem 1rem;
            }
        }

        /* Tetap sembunyikan body sampai JS menjalankannya */
        body {
            display: none;
        }
    </style>

</head>

<body class="antialiased">

    @include('layouts.admin.sidebar')

    <div class="page">
        @include('layouts.admin.header')

        @yield('content')

        @include('layouts.admin.footer')
    </div>

    <!-- jQuery FIRST -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
            crossorigin="anonymous"></script>

    <!-- Bootstrap -->
    <script src="{{ asset('tabler/dist/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Plugins that need jQuery -->
    <script src="{{ asset('tabler/dist/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset('tabler/dist/libs/jqvmap/dist/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('tabler/dist/libs/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('tabler/dist/libs/peity/jquery.peity.min.js') }}"></script>

    <!-- Tabler Core -->
    <script src="{{ asset('tabler/dist/js/tabler.min.js') }}"></script>

    <!-- Extra Plugins -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
            crossorigin=""></script>

    @stack('myscript')

    <script>
        document.body.style.display = "block";
    </script>

    <!-- Optional: smooth sidebar dropdown -->
    <script>
        document.querySelectorAll('.dropdown-toggle').forEach(toggle => {
            toggle.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.classList.toggle('show');
                    this.setAttribute('aria-expanded', target.classList.contains('show'));
                }
            });
        });
    </script>

</body>
</html>