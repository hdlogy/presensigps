<!doctype html>
<html lang="en">
<head>

    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Admin Dashboard</title>

    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>

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
        body {
            display: none;
        }

        .navbar-vertical {
            border-right: 1px solid rgba(255,255,255,0.1);
        }

        .nav-link {
            border-radius: 10px;
            margin: 4px 8px;
            transition: 0.2s;
        }

        .nav-link:hover {
            background: rgba(255,255,255,0.1);
            transform: translateX(4px);
        }

        .nav-link.active {
            background: linear-gradient(135deg,#206bc4,#4299e1);
            color: white !important;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        }

        .sidebar-submenu .nav-link {
            font-size: 14px;
            padding-left: 20px;
            color: #ccc;
        }

        .sidebar-submenu .nav-link:hover {
            color: white;
        }

        .bullet {
            display:inline-block;
            width:6px;
            height:6px;
            background:#4299e1;
            border-radius:50%;
            margin-right:8px;
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

</body>
</html>