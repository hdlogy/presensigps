<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="theme-color" content="#000000">
    <title>PPSDM MKG Smart Presence</title>
    <meta name="description" content="Mobilekit HTML Mobile UI Kit">
    <meta name="keywords" content="bootstrap 4, mobile template, cordova, phonegap, mobile, html" />
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}" sizes="32x32">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/icon/192x192.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="manifest" href="__manifest.json">
    
    <style>
/* =============================
   ANIMATED BACKGROUND
============================= */
.animated-bg {
    position: fixed;
    inset: 0;
    background: linear-gradient(
        -45deg,
        #2563eb,
        #22c55e,
        #8b5cf6,
        #0ea5e9
    );
    background-size: 700% 700%;
    animation: gradientMove 15s linear infinite;
    z-index: -2;
}

@keyframes gradientMove {
    0%   { background-position: 0% 50%; }
    50%  { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

/* =============================
   CENTER LOGIN CARD
============================= */
.login-wrapper {
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 20px;
}

/* =============================
   LOGIN CARD
============================= */
.login-form {
    max-width: 400px;
    width: 100%;
    padding: 18px 16px;
    border-radius: 26px;

    background: rgba(255,255,255,0.92);
    backdrop-filter: blur(14px);
    -webkit-backdrop-filter: blur(14px);

    box-shadow: 
        0 40px 80px rgba(0,0,0,0.28),
        inset 0 0 0 1px rgba(255,255,255,0.3);

    animation: cardIn 0.6s ease-out forwards;
}

@keyframes cardIn {
    from {
        opacity: 0;
        transform: translateY(40px) scale(0.95);
    }
    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

/* =============================
   TEXT & LOGO
============================= */
.login-form h1 {
    font-size: 22px;
    font-weight: 700;
    border: 1px solid rgba(255,255,255,0.35);
}

.login-form h4 {
    font-size: 14px;
    color: #6b7280;
}

.form-image {
    max-width: 110px;
}

/* =============================
   INPUT
============================= */
.form-control {
    height: 48px;
    border-radius: 14px;
    font-size: 14px;
}

/* =============================
   BUTTON
============================= */
.btn-success {
    height: 50px;
    border-radius: 16px;
    font-size: 15px;
    font-weight: 600;

    background: linear-gradient(
        135deg,
        #22c55e,
        #16a34a
    );
    border: none;

    box-shadow: 0 10px 24px rgba(34,197,94,0.45);
    transition: all 0.2s ease;
}

.btn-success:hover {
    transform: translateY(-1px);
}

.btn-success:active {
    transform: scale(0.97);
}

/* =============================
   MOBILE
============================= */
@media (max-width: 480px) {
    .login-form {
        max-width: 100%;
        padding: 30px 26px;
        border-radius: 22px;
    }
}

/* FIX MobileKit button bottom bug */
.form-button-group {
    position: static !important;
    width: 100% !important;
    background: transparent !important;
    padding: 0 !important;
    box-shadow: none !important;
}
.login-form {
    padding-bottom: 20px;
}
html, body {
    height: 100%;
}

/* Override MobileKit */
#appCapsule {
    min-height: 100vh !important;
    display: flex !important;
    justify-content: center !important;
    align-items: center !important;
    padding: 20px !important;
}

/* Wrapper login center */
.login-wrapper {
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
}
/* Title center & premium */
.title-main {
    text-align: center;
    font-size: 22px;
    font-weight: 800;
    margin-bottom: 3px;
}

.title-sub {
    text-align: center;
    font-size: 14px;
    font-weight: 600;
    letter-spacing: 1px;
    color: #4b5563;
    text-transform: uppercase;
    margin-bottom: 10px;
}

.login-desc {
    text-align: center;
    font-size: 13px;
    color: #6b7280;
    margin-bottom: 20px;
}
/* Footer inside login card */
.footer-text {
    text-align: center;
    font-size: 12px;
    color: #6b7280;
    margin-top: 15px;
    padding-top: 10px;
    border-top: 1px solid rgba(0,0,0,0.08);
}



</style>
</head>

<body>
<div class="animated-bg"></div>
    <!-- loader -->
    <div id="loader">
        <div class="spinner-border text-primary" role="status"></div>
    </div>
    <!-- * loader -->


    <!-- App Capsule -->
    <div id="appCapsule" class="login-wrapper">



        <div class="login-form">
            <div class="section">
                <img src="{{ asset('assets/img/login/login2.png') }}" alt="image" class="form-image">
            </div>
            <div class="section mt-1">
            <h1 class="title-main">PPSDM MKG</h1>
            <h2 class="title-sub">Smart Presence System</h4>
          

            </div>
            <div class="section mt-1 mb-5">
                @php
                    $messagewarning = Session::get('warning');
                @endphp
                @if (Session::get('warning'))
                <div class="alert alert-outline-warning">
                    {{ $messagewarning }}
                </div>
                @endif
                <form action="/proseslogin" method="POST">
                    @csrf 
                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <input type="text" name="nik" class="form-control" id="nik" placeholder="NIK">
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>

                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>

                    <div class="form-links mt-2">   
                        <div><a href="page-forgot-password.html" class="text-muted">Forgot Password?</a></div>
                    </div>

                    <div class="form-button-group">
                        <button type="submit" class="btn btn-success btn-block btn-lg">Log in</button>
                    </div>
                    <div class="footer-text">© 2026 PPSDM MKG</div>


                </form>
            </div>
        </div>


    </div>
    <!-- * App Capsule -->



    <!-- ///////////// Js Files ////////////////////  -->
    <!-- Jquery -->
    <script src="{{ asset('assets/js/lib/jquery-3.4.1.min.js') }}"></script>
    <!-- Bootstra{{ asset('') }}p-->
    <script src="{{ asset('assets/js/lib/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/bootstrap.min.js') }}"></script>
    <!-- Ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@5.0.0/dist/ionicons/ionicons.js"></script>
    <!-- Owl Carousel -->
    <script src="{{ asset('assets/js/plugins/owl-carousel/owl.carousel.min.js') }}"></script>
    <!-- jQuery Circle Progress -->
    <script src="{{ asset('assets/js/plugins/jquery-circle-progress/circle-progress.min.js') }}"></script>
    <!-- Base Js File -->
    <script src="{{ asset('assets/js/base.js') }}"></script>


</body>

</html>