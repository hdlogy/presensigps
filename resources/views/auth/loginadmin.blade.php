<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>PPSDM MKG - Administrator Login</title>

    <!-- Google Fonts (Inter) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">

    <!-- Tabler Icons / CSS (optional, but we'll include for consistency) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.30.0/tabler-icons.min.css"/>
    <link href="{{ asset('tabler/dist/css/tabler.min.css') }}" rel="stylesheet"/>

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

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: radial-gradient(circle at 10% 20%, rgba(102, 126, 234, 0.8) 0%, rgba(118, 75, 162, 0.8) 90%),
                        url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI4MCIgaGVpZ2h0PSI4MCIgdmlld0JveD0iMCAwIDgwIDgwIj48cGF0aCBkPSJNMzAsMTBhMTAsMTAgMCAwLDEgMjAsMCAxMCwxMCAwIDAsMS0yMCwwWk0xMCwzMEExMCwxMCAwIDAsMSAzMCwzMCAxMCwxMCAwIDAsMSAxMCwzMFpNNTAsMzBBMTAsMTAgMCAwLDEgNzAsMzAgMTAsMTAgMCAwLDEgNTAsMzBaTTMwLDUwQTEwLDEwIDAgMCwxIDUwLDUwIDEwLDEwIDAgMCwxIDMwLDUwWiIgZmlsbD0icmdiYSgyNTUsMjU1LDI1NSwwLjA1KSIvPjwvc3ZnPg==');
            background-size: cover, 80px 80px;
            animation: gradientShift 15s ease infinite;
            position: relative;
        }

        @keyframes gradientShift {
            0% { background-position: 0% 50%, 0 0; }
            50% { background-position: 100% 50%, 40px 40px; }
            100% { background-position: 0% 50%, 0 0; }
        }

        /* Overlay gelap agar teks lebih terbaca */
        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
            z-index: 0;
        }

        .login-container {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 460px;
            padding: 20px;
        }

        /* Card glassmorphism super mewah */
        .login-card {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 40px;
            box-shadow: 0 40px 70px rgba(0, 0, 0, 0.4), 0 0 0 1px rgba(255, 255, 255, 0.2) inset;
            padding: 40px 35px;
            animation: cardFloat 1s ease-out;
        }

        @keyframes cardFloat {
            0% {
                opacity: 0;
                transform: translateY(40px) scale(0.95);
            }
            100% {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* Logo dengan animasi lembut */
        .logo-wrapper {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo {
            width: 180px;
            height: auto;
            filter: drop-shadow(0 10px 15px rgba(0, 0, 0, 0.3));
            animation: logoFloat 4s ease-in-out infinite;
        }

        @keyframes logoFloat {
            0% { transform: translateY(0); }
            50% { transform: translateY(-8px); }
            100% { transform: translateY(0); }
        }

        /* Title */
        .login-title {
            text-align: center;
            color: white;
            font-weight: 700;
            font-size: 28px;
            letter-spacing: -0.5px;
            margin-bottom: 30px;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        /* Form group */
        .form-group {
            margin-bottom: 25px;
        }

        .form-label {
            display: block;
            color: rgba(255, 255, 255, 0.9);
            font-weight: 600;
            font-size: 14px;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
            text-shadow: 0 1px 3px rgba(0,0,0,0.2);
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.25);
            border-radius: 20px;
            transition: all 0.3s;
        }

        .input-wrapper:focus-within {
            background: rgba(255, 255, 255, 0.25);
            border-color: rgba(255, 255, 255, 0.6);
            box-shadow: 0 0 0 4px rgba(255, 255, 255, 0.1);
            transform: scale(1.02);
        }

        .input-icon {
            padding: 0 15px;
            color: rgba(255, 255, 255, 0.7);
            font-size: 20px;
        }

        .form-control {
            width: 100%;
            background: transparent;
            border: none;
            padding: 16px 20px 16px 0;
            color: white;
            font-size: 16px;
            font-weight: 500;
            outline: none;
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.5);
            font-weight: 400;
        }

        /* Forgot password link */
        .form-label-description {
            float: right;
        }

        .forgot-link {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
            transition: 0.2s;
            border-bottom: 1px dashed rgba(255,255,255,0.4);
        }

        .forgot-link:hover {
            color: white;
            border-bottom-color: white;
        }

        /* Checkbox */
        .form-check {
            display: flex;
            align-items: center;
            gap: 10px;
            color: white;
            font-weight: 500;
        }

        .form-check-input {
            width: 18px;
            height: 18px;
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.4);
            border-radius: 5px;
            appearance: none;
            cursor: pointer;
            transition: 0.2s;
        }

        .form-check-input:checked {
            background: #667eea;
            border-color: white;
            box-shadow: 0 0 0 2px rgba(255,255,255,0.3);
        }

        /* Button */
        .btn-login {
            width: 100%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 40px;
            padding: 16px;
            color: white;
            font-weight: 700;
            font-size: 18px;
            letter-spacing: 0.5px;
            cursor: pointer;
            box-shadow: 0 15px 30px -8px rgba(102, 126, 234, 0.6);
            transition: all 0.3s;
            margin-top: 20px;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .btn-login:hover {
            transform: translateY(-4px);
            box-shadow: 0 25px 40px -8px #667eea;
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
        }

        .btn-login:active {
            transform: scale(0.98);
        }

        /* Alert warning */
        .alert-warning {
            background: rgba(255, 193, 7, 0.2);
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 193, 7, 0.3);
            border-radius: 20px;
            color: #fff3cd;
            padding: 12px 20px;
            margin-bottom: 25px;
            font-weight: 500;
            text-align: center;
        }

        /* Responsive */
        @media (max-width: 480px) {
            .login-card {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <!-- Logo (ganti dengan logo Anda) -->
            <div class="logo-wrapper">
                <img src="{{ asset('tabler/dist/img/ppsdm1.png') }}" alt="PPSDM MKG" class="logo">
            </div>

            <h2 class="login-title">Welcome Back, Admin</h2>

            <!-- Pesan warning (jika ada) -->
            @if (Session::get('warning'))
                <div class="alert-warning">
                    {{ Session::get('warning') }}
                </div>
            @endif

            <!-- Form Login -->
            <form action="/prosesloginadmin" method="POST">
                @csrf

                <div class="form-group">
                    <label class="form-label">Email Address</label>
                    <div class="input-wrapper">
                        <span class="input-icon">
                            <i class="ti ti-mail"></i>
                        </span>
                        <input type="email" name="email" class="form-control" placeholder="admin@example.com" autocomplete="off">
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-label">
                        Password
                        <span class="form-label-description">
                            <a href="./forgot-password.html" class="forgot-link">forgot password?</a>
                        </span>
                    </div>
                    <div class="input-wrapper">
                        <span class="input-icon">
                            <i class="ti ti-lock"></i>
                        </span>
                        <input type="password" name="password" class="form-control" placeholder="••••••••">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-check">
                        <input type="checkbox" class="form-check-input" name="remember">
                        <span>Remember me on this device</span>
                    </label>
                </div>

                <button type="submit" class="btn-login">
                    Sign in
                </button>
            </form>
        </div>
    </div>

    <!-- Optional: sedikit javascript untuk fade in (jika diperlukan) -->
    <script>
        document.body.style.opacity = "0";
        window.addEventListener('load', function() {
            document.body.style.transition = "opacity 0.8s ease";
            document.body.style.opacity = "1";
        });
    </script>
</body>
</html>