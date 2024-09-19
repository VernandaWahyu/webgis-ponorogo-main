<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WebGIS Ponorogo</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Leaflet Routing Machine CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <!-- Leaflet Routing Machine JS -->
    <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
    <link rel="stylesheet" href="{{ asset('css/styleuser.css') }}">
    
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">WebGIS Ponorogo</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @if (Route::has('login'))
                        <nav class="nav-items-wrapper">
                            @auth
                                <a href="{{ url('/home') }}" class="nav-link-custom">
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="nav-link-custom">
                                    Log in
                                </a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="nav-link-custom">
                                        Register
                                    </a>
                                @endif
                            @endauth
                        </nav>
                    @endif           
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container my-4">
        <div class="card">
            <div class="card-header text-white text-center">
                <h3>Maps Location</h3>
            </div>
            <div class="card-body">
                <div id="mapid" class="mb-4" style="height: 500px;"></div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="bg-secondary text-white">
                            <tr>
                                <th>Nama Lokasi</th>
                                <th>Provinsi</th>
                                <th>Kabupaten/Kota</th>
                                <th>Latitude</th>
                                <th>Longitude</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($locations as $location)
                                <tr>
                                    <td>{{ $location->nama_lokasi }}</td>
                                    <td>{{ $location->provinsi }}</td>
                                    <td>{{ $location->kotaorkab }}</td>
                                    <td>{{ $location->latitude }}</td>
                                    <td>{{ $location->longitude }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div id="overlay" class="overlay"></div>

    <div id="locationDetailPopup" class="custom-popup">
        <div class="close-popup" onclick="closePopup()">&#10006;</div> <!-- Tanda silang X -->
        <div class="popup-content">
            <h5 id="locationName"></h5>
            <p><strong></strong> <span id="locationDescription"></span></p>
            <img id="locationImage" src="" alt="Gambar Lokasi"> 
            <p><strong>Provinsi:</strong> <span id="locationProvince"></span></p>
            <p><strong>Kabupaten/Kota:</strong> <span id="locationCity"></span></p>
            <p><strong>Latitude:</strong> <span id="locationLatitude"></span></p>
            <p><strong>Longitude:</strong> <span id="locationLongitude"></span></p>
        </div>
    </div>
    

    <footer class="bg-dark text-white text-center py-3">
        <div class="container">
            <p>© 2024 WebGIS Ponorogo. All rights reserved.</p>
            <p>
                <a href="#" class="text-white me-2 d-block d-md-inline-block" ><i class="fas fa-envelope"></i> Contact</a> |
                <a href="#" class="text-white me-2 d-block d-md-inline-block" ><i class="fas fa-info-circle"></i> Privacy Policy</a>
            </p>
        </div>
    </footer>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>

<script>
    // Inisialisasi peta dengan posisi Ponorogo
    var mymap = L.map('mapid').setView([-7.8653, 111.4690], 12);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: 'Map data © <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        maxZoom: 18,
    }).addTo(mymap);

    var routingControl; 
    var userLat, userLng;

    // Geolocation untuk mendapatkan lokasi pengguna
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            userLat = position.coords.latitude;
            userLng = position.coords.longitude;
            mymap.setView([userLat, userLng], 15);
            var userMarker = L.marker([userLat, userLng]).addTo(mymap);
            userMarker.bindPopup("<b>Lokasi Anda</b>").openPopup();
        }, function(error) {
            console.error("Geolocation tidak tersedia atau gagal dideteksi:", error);
        });
    } else {
        alert("Geolocation tidak didukung oleh browser ini.");
    }

    var locations = @json($locations);

    // Fungsi untuk menampilkan popup dengan tombol rute
    locations.forEach(function(location) {
        var marker = L.marker([location.latitude, location.longitude]).addTo(mymap);

        marker.bindPopup("<b>" + location.nama_lokasi + "</b><br>" +
                         "Latitude: " + location.latitude + "<br>" +
                         "Longitude: " + location.longitude + "<br><br>" +
                          "<button class='btn btn-primary btn-sm' onclick='showRoute(" + location.latitude + ", " + location.longitude + ")'>Rute</button> " +
                         "<button class='btn btn-primary btn-sm' onclick='showDetail(" + JSON.stringify(location) + ")'>Detail</button>");

        marker.on('click', function() {
            marker.openPopup();
        });
    });

    // Fungsi untuk menampilkan rute dari lokasi pengguna ke lokasi yang diklik
    function showRoute(lat, lng) {
        if (routingControl) {
            mymap.removeControl(routingControl); // Hapus rute sebelumnya
        }

        routingControl = L.Routing.control({
            waypoints: [
                L.latLng(userLat, userLng),  // Lokasi pengguna
                L.latLng(lat, lng)  // Lokasi tujuan
            ],
            routeWhileDragging: true,
            createMarker: function(i, waypoint, n) {
                var markerOptions = {
                    draggable: true,
                };
                var markerText = i === 0 ? 'Mulai' : i === n - 1 ? 'Akhir' : 'Waypoint';
                markerOptions.title = markerText;
                return L.marker(waypoint.latLng, markerOptions).bindPopup(markerText);
            },
            router: L.Routing.osrmv1({
                language: 'id'
            })
        }).addTo(mymap);
    }

    // Fungsi untuk menampilkan pop-up detail
   function showDetail(location) {
        var popup = document.getElementById('locationDetailPopup');
        var overlay = document.getElementById('overlay');

        // Set detail lokasi
        document.getElementById('locationName').innerText = location.nama_lokasi;
        document.getElementById('locationDescription').innerText = location.deskripsi;
        document.getElementById('locationProvince').innerText = location.provinsi;
        document.getElementById('locationCity').innerText = location.kotaorkab;
        document.getElementById('locationLatitude').innerText = location.latitude;
        document.getElementById('locationLongitude').innerText = location.longitude;

        var locationImage = document.getElementById('locationImage');
    if (location.gambar) {
        locationImage.src = 'images/' + location.gambar; // Path ke gambar
        locationImage.style.display = 'block'; // Tampilkan gambar
    } else {
        locationImage.style.display = 'none'; // Sembunyikan jika tidak ada gambar
    }

        // Tampilkan overlay dan pop-up dengan animasi
        overlay.classList.add('active');
        popup.classList.add('active');
    }

    // Fungsi untuk menutup pop-up dengan animasi scale down dan menghapus overlay
    function closePopup() {
        var popup = document.getElementById('locationDetailPopup');
        var overlay = document.getElementById('overlay');
        
        // Tambahkan kelas 'closing' untuk memulai animasi scale down
        popup.classList.add('closing');

        // Tunggu sampai animasi selesai (0.4s), lalu sembunyikan pop-up dan overlay
        setTimeout(function() {
            popup.classList.remove('active', 'closing');
            overlay.classList.remove('active');
        }, 400); // Sesuaikan dengan durasi animasi
    }
</script>

</body>
</html>
