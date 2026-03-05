@extends('layouts.presensi')
@section('header')
<!-- App Header -->
<div class="appHeader bg-primary text-light">
    <div class="left">
        <a href="javascript:;" class="headerButton goBack">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTitle">Smart Presence</div>
    <div class="right"></div>
</div>
<!-- * App Header -->

<style>
    /* ===== VARIABEL WARNA ===== */
    :root {
        --primary: #4361ee;
        --primary-light: #4895ef;
        --primary-dark: #3f37c9;
        --success: #4cc9f0;
        --warning: #f8961e;
        --danger: #f94144;
        --gradient-primary: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --gradient-danger: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
        --shadow-sm: 0 5px 15px rgba(0,0,0,0.05);
        --shadow-md: 0 10px 25px -5px rgba(0,0,0,0.1);
        --shadow-lg: 0 20px 40px -10px rgba(0,0,0,0.2);
    }

    /* Header lebih elegan */
    .appHeader {
        background: var(--gradient-primary) !important;
        box-shadow: 0 10px 25px -5px rgba(102,126,234,0.5);
    }
    .appHeader .pageTitle {
        font-weight: 700;
        letter-spacing: 0.5px;
    }

    /* Container utama dengan jarak dari header */
    .presence-container {
        padding: 20px 16px;
        margin-top: 60px;
    }

    /* Webcam capture - hanya styling minimal, ukuran tetap asli */
    .webcam-capture,
    .webcam-capture video {
        width: 100% !important;
        height: auto !important;
        border-radius: 20px;
        box-shadow: var(--shadow-md);
    }

    /* Tombol absen premium */
    #takeabsen {
        border: none;
        border-radius: 40px;
        height: 60px;
        font-size: 1.3rem;
        font-weight: 700;
        letter-spacing: 0.5px;
        box-shadow: var(--shadow-lg);
        transition: all 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        width: 100%;
        border: 1px solid rgba(255,255,255,0.3);
        margin-top: 15px;
    }
    #takeabsen.btn-primary {
        background: var(--gradient-primary);
    }
    #takeabsen.btn-danger {
        background: var(--gradient-danger);
    }
    #takeabsen:hover {
        transform: translateY(-4px);
        box-shadow: 0 25px 40px -8px #667eea;
    }
    #takeabsen:active {
        transform: scale(0.97);
    }
    #takeabsen:disabled {
        opacity: 0.6;
        transform: none;
    }
    #takeabsen ion-icon {
        font-size: 1.8rem;
    }

    /* Map container */
    #map {
        height: 220px;
        border-radius: 25px;
        box-shadow: var(--shadow-md);
        border: 2px solid white;
        margin-top: 15px;
    }

    /* Responsive */
    @media (max-width: 576px) {
        .presence-container {
            padding: 16px 12px;
        }
        #takeabsen {
            height: 56px;
            font-size: 1.2rem;
        }
        #map {
            height: 200px;
        }
    }

    /* Audio disembunyikan */
    audio {
        display: none;
    }
</style>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
@endsection

@section('content')
<div class="presence-container">
    <div class="row">
        <div class="col">
            <input type="hidden" id="lokasi">
            <div class="webcam-capture"></div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            @if ($cek > 0)
            <button id="takeabsen" class="btn btn-danger btn-block">
                <ion-icon name="camera-outline"></ion-icon>
                Check Out
            </button>
            @else
            <button id="takeabsen" class="btn btn-primary btn-block">
                <ion-icon name="camera-outline"></ion-icon>
                Check In
            </button>
            @endif
        </div>
    </div>

    <div class="row mt-2">
        <div class="col">
            <div id="map"></div>
        </div>
    </div>
</div>

<audio id="notifikasi_in">
    <source src="{{ asset('assets/sound/notifikasi_in.mp3') }}" type="audio/mpeg">
</audio>
<audio id="notifikasi_out">
    <source src="{{ asset('assets/sound/notifikasi_out.mp3') }}" type="audio/mpeg">
</audio>
<audio id="notifikasi_radius">
    <source src="{{ asset('assets/sound/radius.mp3') }}" type="audio/mpeg">
</audio>
@endsection

@push('myscript')
<script>
var notifikasi_in = document.getElementById('notifikasi_in');
var notifikasi_out = document.getElementById('notifikasi_out');
var notifikasi_radius = document.getElementById('notifikasi_radius');

Webcam.set({
    height: 480,
    width: 640,
    image_format: 'jpeg',
    jpeg_quality: 80,
});
Webcam.attach('.webcam-capture');

// GPS
var lokasi = document.getElementById('lokasi');
if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
}

function successCallback(position){
    lokasi.value = position.coords.latitude + "," + position.coords.longitude;

    var map = L.map('map').setView([position.coords.latitude, position.coords.longitude], 17);
    var lokasi_kantor = "{{ $lok_kantor->lokasi_kantor }}";
    var lok = lokasi_kantor.split(",");
    var lat_kantor = lok[0];
    var long_kantor = lok[1];
    var radius = "{{ $lok_kantor->radius }}";

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
    }).addTo(map);

    L.marker([position.coords.latitude, position.coords.longitude]).addTo(map)
        .bindPopup('Anda di sini')
        .openPopup();

    L.circle([lat_kantor, long_kantor], {
        color: 'red',
        fillColor: '#f03',
        fillOpacity: 0.5,
        radius: radius
    }).addTo(map);
}

function errorCallback(){
    alert("GPS tidak diizinkan!");
}

// BUTTON ABSEN
let clicked = false;

$("#takeabsen").click(function(){
    if(clicked) return;
    clicked = true;
    $("#takeabsen").prop("disabled", true);

    Webcam.snap(function(uri){
        $.ajax({
            type: 'POST',
            url: '/presensi/store',
            data: {
                _token: "{{ csrf_token() }}",
                image: uri,
                lokasi: $("#lokasi").val()
            },
            success: function(respon){
                var data = respon.split("|");
                var status = data[0];
                var message = data[1];
                var tipe = data[2];

                if(status == "success"){
                    Swal.fire("SUCCESS", message, "success");

                    if(tipe == "in") notifikasi_in.play();
                    if(tipe == "out") notifikasi_out.play();

                    setTimeout(function(){
                        window.location.href = "/dashboard";
                    }, 3000);
                } else {
                    Swal.fire("ERROR", message, "error");

                    // 🔊 SOUND KHUSUS JIKA DI LUAR RADIUS
                    if(message.includes("Sorry, you are outside the permitted office radius!")){
                        notifikasi_radius.play();
                    }

                    clicked = false;
                    $("#takeabsen").prop("disabled", false);
                }
            },
            error: function(){
                alert("AJAX ERROR");
                clicked = false;
                $("#takeabsen").prop("disabled", false);
            }
        });
    });
});
</script>
@endpush