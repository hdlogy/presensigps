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
.webcam-capture,
.webcam-capture video{
    display: inline-block;
    width: 100% !important;
    margin: auto;
    height: auto !important;
    border-radius:15px;
}
#map { height: 200px; }
</style>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
@endsection

@section('content')
<div class="row" style="margin-top: 70px">
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

    L.marker([position.coords.latitude, position.coords.longitude]).addTo(map);

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
