<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-alpha.7
* @link https://github.com/tabler/tabler
* Copyright 2018-2019 The Tabler Authors
* Copyright 2018-2019 codecalm.net Paweł Kuna
* Licensed under MIT (https://tabler.io/license)
-->
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>PPSDM MKG Administrator</title>
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <meta name="msapplication-TileColor" content="#206bc4"/>
    <meta name="theme-color" content="#206bc4"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="mobile-web-app-capable" content="yes"/>
    <meta name="HandheldFriendly" content="True"/>
    <meta name="MobileOptimized" content="320"/>
    <meta name="robots" content="noindex,nofollow,noarchive"/>
    <link rel="icon" href="./favicon.ico" type="image/x-icon"/>
    <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon"/>
    <!-- CSS files -->
    <link href="{{ asset('tabler/dist/css/tabler.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('tabler/dist/css/demo.min.css') }}" rel="stylesheet"/>
    <style>
     /* ===============================
   SMOOTH FADE BODY
================================ */
body {
  display: block !important;
  background: linear-gradient(-45deg, #206bc4, #16a34a, #8b5cf6, #0ea5e9);
  background-size: 400% 400%;
  animation: bgMove 15s ease infinite;
}

/* Animated gradient */
@keyframes bgMove {
  0% { background-position: 0% 50%; }
  50% { background-position: 100% 50%; }
  100% { background-position: 0% 50%; }
}

/* ===============================
   GLASS CARD LOGIN
================================ */
.card {
  border-radius: 18px !important;
  backdrop-filter: blur(12px);
  background: rgba(255,255,255,0.92) !important;
  box-shadow: 0 30px 80px rgba(0,0,0,0.25);
  animation: cardFade 0.8s ease forwards;
}

/* Card animation */
@keyframes cardFade {
  from {
    opacity: 0;
    transform: translateY(40px) scale(0.95);
  }
  to {
    opacity: 1;
    transform: translateY(0) scale(1);
  }
}

/* ===============================
   INPUT FOCUS EFFECT
================================ */
.form-control {
  border-radius: 12px !important;
  transition: 0.2s ease;
}

.form-control:focus {
  box-shadow: 0 0 0 3px rgba(32,107,196,0.2);
  transform: scale(1.02);
}

/* ===============================
   BUTTON ANIMATION
================================ */
.btn-primary {
  border-radius: 30px;
  padding: 10px 20px;
  font-weight: 600;
  box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}


.btn-primary:hover {
  transform: translateY(-2px);
  box-shadow: 0 12px 30px rgba(32,107,196,0.6);
}

.btn-primary:active {
  transform: scale(0.97);
}

/* ===============================
   LOGO FLOAT ANIMATION
================================ */
.text-center img {
  animation: floatLogo 3s ease-in-out infinite;
}

@keyframes floatLogo {
  0% { transform: translateY(0px); }
  50% { transform: translateY(-6px); }
  100% { transform: translateY(0px); }
}

/* ===============================
   SOCIAL BUTTON EFFECT
================================ */
.btn-white {
  transition: 0.2s ease;
}

.btn-white:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 18px rgba(0,0,0,0.1);
}

.card {
  background: rgba(255, 255, 255, 0.25);
  backdrop-filter: blur(12px);
  -webkit-backdrop-filter: blur(12px);
  border: 1px solid rgba(255, 255, 255, 0.2);
  box-shadow: 0 20px 40px rgba(0,0,0,0.15);
}

    </style>
  </head>
  <body class="antialiased border-top-wide border-primary d-flex flex-column">
    <div class="flex-fill d-flex flex-column justify-content-center">
      <div class="container-tight py-6">
        <div class="text-center mb-4">
          <img src="./static/logo.svg" height="36" alt="">
        </div>
        <form class="card card-md" action="/prosesloginadmin" method="post">
          @csrf
          <div class="card-body">
            <h2 class="mb-5 text-center">Login to your account</h2>
            @if (Session::get('warning'))
            <div class="alert alert-warning">
              <p>{{ Session::get('warning') }}</p>
            </div>
            @endif
            <div class="mb-3">
              <label class="form-label">Email address</label>
              <input type="email" name="email" class="form-control" placeholder="Enter email" autocomplete="off">
            </div>
            <div class="mb-2">
              <label class="form-label">
                Password
                <span class="form-label-description">
                  <a href="./forgot-password.html">forgot password?</a>
                </span>
              </label>
              <div class="input-group input-group-flat">
                <input type="password" name="password" class="form-control"  placeholder="Password" >
            
              </div>
            </div>
            <div class="mb-2">
              <label class="form-check">
                <input type="checkbox" class="form-check-input"/>
                <span class="form-check-label">Remember me on this device</span>
              </label>
            </div>
            <div class="form-footer">
              <button type="submit" class="btn btn-primary btn-block">Sign in</button>
            </div>
          </div>
          
          </div>
        </form>
      </div>
    </div>
    
    <!-- Libs JS -->
    <script>
document.body.style.opacity = "0";
window.onload = () => {
  document.body.style.transition = "0.6s ease";
  document.body.style.opacity = "1";
};
</script>

  </body>
</html>