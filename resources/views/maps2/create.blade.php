@extends('layouts.app')

@section('title', 'Tambah Data Maps')

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="{{ url('../css/app.css') }}">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
    crossorigin="" />
  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
    crossorigin=""></script>

    @section('content')
    <div class="main-content">
      <section class="section">
          <div class="section-header">
              <h1>Tambah Data Maps</h1>
          </div>
          <div class="section-body">
  {{-- Header --}}
  <div class="w-full h-96 relative flex bg-gray-400" id="maps"></div>
  <div class=" bg-gray-300 w-full h-auto relative flex justify-center items-center">
    <div class="min-h-auto flex items-center bg-gray-300 py-2 px-4 sm:px-6 lg:px-8 rounded-xl">
      <div class="max-w-md w-full space-y-8">
        <form class="mt-8 space-y-6" action="{{ route('maps.store') }}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="rounded-md shadow-sm -space-y-px">
            <div>
              <label for="nama_lokasi" class="sr-only">Nama Lokasi</label>
              <input id="nama_lokasi" name="nama_lokasi" type="text" required
                class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                placeholder="Nama Lokasi">
            </div>
            <div>
              <label for="Deskripsi" class="sr-only">Deskripsi</label>
              <textarea id="deskripsi" name="deskripsi" type="text" required
                class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                placeholder="Deskripsi Notes Jangan Gunakan Symbol ('')"></textarea>
            </div>
            <div class="form-group">
              <input type="file" class="form-control" name="gambar" id="gambar">
          </div>
            <div>
              <label for="provinsi" class="sr-only">Provinsi</label>
              <input id="provinsi" name="provinsi" type="text" required
                class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                placeholder="Provinsi">
            </div>
            <div>
              <label for="kotaorkab" class="sr-only">Kota/Kab</label>
              <input id="kotaorkab" name="kotaorkab" type="text" required
                class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                placeholder="Kota/Kab">
            </div>
            <div>
              <label for="latitude" class="sr-only">Latitude</label>
              <input id="latitude" name="latitude" type="text" required
                class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                placeholder="Latitude">
            </div>
            <div>
              <label for="longitude" class="sr-only">Longtitude</label>
              <input id="longitude" name="longitude" type="text" required
                class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                placeholder="Longitude">
            </div>
            <p class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-red-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">NB:Untuk Deskripsi Jangan Gunakan Symbol (' ")</p>
          </div>
          <div style="display: flex; justify-content: center; gap: 10px;">
            <!-- Tambah Data Button -->
            <button
              style="
                background-color: #6777ef;
                color: white;
                padding: 12px 15px;
                font-size: 16px;
                font-weight: bold;
                border: none;
                border-radius: 8px;
                cursor: pointer;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                transition: background-color 0.3s ease, box-shadow 0.3s ease;
              "
              onmouseover="this.style.backgroundColor='#5766d9'; this.style.boxShadow='0 6px 8px rgba(0, 0, 0, 0.15)';"
              onmouseout="this.style.backgroundColor='#6777ef'; this.style.boxShadow='0 4px 6px rgba(0, 0, 0, 0.1)';"
            >
              Tambah Data
            </button>
        </form>
        {{-- <a href="/maps"style="text-decoration: none;">
            <button
            style="
            background-color: #6777ef;
            color: white;
            padding: 12px 15px;
            font-size: 16px;
            font-weight: bold;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
          "
          onmouseover="this.style.backgroundColor='#5766d9'; this.style.boxShadow='0 6px 8px rgba(0, 0, 0, 0.15)';"
          onmouseout="this.style.backgroundColor='#6777ef'; this.style.boxShadow='0 4px 6px rgba(0, 0, 0, 0.1)';"
        >
          Kembali
            </button>
            </a> --}}
      </div>
      </div>
    </div>
  </div>
                  @foreach ($maps as $m)
                    
                    <input type="hidden"
                    value="{{$m->id}}"
                    id="lab{{$loop->index}}">
                  <input type="hidden"
                    value="{{$m->kotaorkab}}"
                    id="kab{{$loop->index}}">
                  <input type="hidden"
                    value="{{$m->provinsi}}"
                    id="prov{{$loop->index}}">
                  <input type="hidden"
                    value="{{$m->latitude}}"
                    id="lat{{$loop->index}}">
                  <input type="hidden"
                    value="{{$m->longitude}}"
                    id="lon{{$loop->index}}">
                  @endforeach
                  @foreach ($maps as $m)
                    @php
                    $a = '';
                    $a = $loop->index;
                    @endphp
                  @endforeach
                  <input type="hidden" value="{{$a ?? ''}}" id="index">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</div>
@endsection
@push('scripts')
    <!-- JS Libraies -->
    <script src="{{url("../js2/create.js")}}"></script>
    <!-- Page Specific JS File -->
@endpush
