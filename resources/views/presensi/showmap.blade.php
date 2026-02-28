<style>
#map {
    height: 400px;
    width: 100%;
}
</style>

<div id="map"></div>

<script>
var lokasi = "{{ $presensi->lokasi_in }}";
var lok = lokasi.split(",");

var latitude = parseFloat(lok[0]);
var longitude = parseFloat(lok[1]);

var map = L.map('map').setView([-6.26476025094071, 106.74889566958643], 17);

L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19
}).addTo(map);

L.marker([latitude, longitude]).addTo(map);

L.circle([-6.26476025094071, 106.74889566958643], {
    color: 'red',
    fillColor: '#f03',
    fillOpacity: 0.3,
    radius: 170
}).addTo(map);

L.popup()
.setLatLng([latitude, longitude])
.setContent("{{ $presensi->nama_lengkap }}")
.openOn(map);

// Fix modal render
setTimeout(function(){
    map.invalidateSize();
}, 500);
</script>