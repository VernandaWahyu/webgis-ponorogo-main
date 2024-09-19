// Set lokasi awal peta ke Kabupaten Ponorogo (Koordinat: -7.8651, 111.4697)
var mymap = L.map('maps').setView([-7.8651, 111.4697], 12);

// Menambahkan tile layer dari Mapbox
L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 18,
    id: 'mapbox/streets-v11',
    tileSize: 512,
    zoomOffset: -1,
    accessToken: 'sk.eyJ1IjoibWFyaWZmaW4iLCJhIjoiY2tqM3V3OHByMGY4ejJybnE0ZDZpN2JpdSJ9.VkZp3cjQSPoL7lpc-VWsCg'
}).addTo(mymap);

// Array untuk menyimpan data koordinat dan label marker
var longlat = [];
var label = [];
var marker = [];

// Ambil nilai index dari elemen tersembunyi
var index = document.getElementById('index').value;

// Jika tidak ada data index
if (index === '') {
    console.log("Tidak ada data untuk ditampilkan");
} else {
    // Loop untuk mengambil data latitude dan longitude
    for (var c = 0; c <= index; c++) {
        var lat = parseFloat(document.getElementById('lat' + [c]).value);
        var lon = parseFloat(document.getElementById('lon' + [c]).value);
        var arr = [lat, lon];
        longlat.push(arr);
    }

    // Loop untuk mengambil data label
    for (var d = 0; d <= index; d++) {
        var lab = document.getElementById('lab' + [d]).value;
        var kab = document.getElementById('kab' + [d]).value;
        var prov = document.getElementById('prov' + [d]).value;
        var arr = [lab, kab, prov];
        label.push(arr);
    }

    // Tambahkan marker ke peta
    for (var i = 0; i < longlat.length; i++) {
        var push = L.marker(longlat[i]).addTo(mymap);
        marker.push(push);
    }

    // Menambahkan popup untuk setiap marker
    for (var a = 0; a < label.length; a++) {
        marker[a].bindPopup("Point " + label[a][0] + "<br>" + "Kab/Kota = " + label[a][1] + "<br>" + "Provinsi = " + label[a][2]);
    }
}
