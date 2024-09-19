@extends('layouts.app')

@section('title', 'Edit Data Maps')
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
              <h1>Edit Data Maps</h1>
          </div>
          <div class="section-body">
  {{-- Header --}}
  <div class="w-full h-96 relative flex bg-gray-400" id="maps"></div>
  <div class=" bg-gray-300 w-full h-auto relative flex justify-center items-center">
    <div class="min-h-auto flex items-center bg-gray-300 py-2 px-4 sm:px-6 lg:px-8 rounded-xl">
      <div class="max-w-md w-full space-y-8">
        <form class="mt-8 space-y-6" action="/maps/{{ $map->id }}" method="post" enctype="multipart/form-data">
          @csrf
          @method('put')
          <div class="rounded-md shadow-sm -space-y-px">
            <div>
              <label for="nama_lokasi" class="sr-only">Nama Lokasi</label>
              <input id="nama_lokasi" name="nama_lokasi" type="text" required
                class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                placeholder="Nama Lokasi" value="{{ $map->nama_lokasi }}">
            </div>
            <div>
              <label for="deskripsi" class="sr-only">Deskripsi</label>
              <textarea id="deskripsi" name="deskripsi" required
                class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                placeholder="Deskripsi">{{ $map->deskripsi }}</textarea>
            </div>
            
            <div>
              <label for="gambar" class="sr-only">Gambar Lokasi</label>
              <input id="gambar" name="gambar" type="file"
                class="form-control">
              <img id="imagePreview" src="{{ asset('images/' . $map->gambar) }}" alt="Gambar Lokasi" class="rounded-md" style="max-width: 100%; height: auto;">
            </div>
            <div>
              <label for="provinsi" class="sr-only">Provinsi</label>
              <input id="provinsi" name="provinsi" type="text" required
                class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                placeholder="Provinsi" value="{{ $map->provinsi }}">
            </div>
            <div>
              <label for="kotaorkab" class="sr-only">Kota/Kab</label>
              <input id="kotaorkab" name="kotaorkab" type="text" required
                class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                placeholder="Kota/Kab" value="{{ $map->kotaorkab }}">
            </div>
            <div>
              <label for="latitude" class="sr-only">Latitude</label>
              <input id="latitude" name="latitude" type="text" required
                class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                placeholder="Latitude"  value="{{ $map->latitude }}">
            </div>
            <div>
              <label for="longitude" class="sr-only">Longitude</label>
              <input id="longitude" name="longitude" type="text" required
                class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                placeholder="Longitude"  value="{{ $map->longitude }}">
                <input type="hidden" id="label" value="{{$map->id}}">
            </div>
            <p class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-red-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">NB:Untuk Deskripsi Jangan Gunakan Symbol (' ")</p>
          </div>
          <div style="display: flex; justify-content: center; gap: 10px;">
            <button type="submit"
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
          Edit Data
            </button>
        </form>
            <a href="/maps"style="text-decoration: none;">
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
            </a>
          </div>
      </div>
    </div>
  </div>
                  @foreach ($maps as $m)
                  @php
                  $a = '';
                  $a = $loop->index;
                  @endphp
                @endforeach
                <input type="hidden" value="{{ $a ?? ''}}" id="index">
                </tbody>
              </table>
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
    <script src="{{url("../js2/edit.js")}}"></script>
    <!-- Page Specific JS File -->
@endpush
 