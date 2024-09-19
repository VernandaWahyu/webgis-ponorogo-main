@extends('layouts.app')

@section('title', 'Kelola Maps')

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
          <h1>Kelola Maps</h1>
      </div>
      <div class="section-body">
  {{-- Header --}}
  <div class="w-full h-96 relative flex bg-gray-400" id="maps"></div>
  <div class=" bg-gray-300 w-full h-auto relative flex justify-center items-center">
    <div class="min-h-auto flex items-center bg-gray-300 py-2 px-4 sm:px-6 lg:px-8 rounded-xl">
      <div class="max-w-md w-full space-y-8">
        <div>
  <a href="maps/create" style="text-decoration: none;">
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
  </a>
</div>

        </form>
      </div>
    </div>
  </div>
  <div class="py-6 bg-gray-300">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <!-- This example requires Tailwind CSS v2.0+ -->
      <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
              <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                  <tr>
                    <th scope="col"
                      class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Label
                    </th>
                    <th scope="col"
                      class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Nama Lokasi
                    </th>
                    <th scope="col"
                      class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Deskripsi
                    </th>
                    <th scope="col"
                      class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Gambar
                    </th>
                    <th scope="col"
                      class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Kabupaten/Kota
                    </th>
                    <th scope="col"
                      class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Provinsi
                    </th>
                    <th scope="col"
                      class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Latitude
                    </th>
                    <th scope="col"
                      class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Longitude
                    </th>
                    <th scope="col" class="relative px-6 py-3">
                      <span class="sr-only">Edit</span>
                    </th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                  @foreach ($maps as $m)
                    <tr>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">
                          Point {{ $m->id }}
                        </div>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">
                          {{ $m->nama_lokasi }}
                        </div>
                      </td>
                      <td class="px-6 py-4 whitespace-normal break-words">
                        <div class="text-sm text-gray-900 max-h-20 overflow-auto">
                          {{ $m->deskripsi }}
                        </div>
                    </td>      
                      <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">
                            @if ($m->gambar)
                                <a href="{{ asset('images/' . $m->gambar) }}" target="_blank">
                                    <img src="{{ asset('images/' . $m->gambar) }}" alt="Gambar Lokasi" class="w-16 h-16 object-cover">
                                </a>
                            @else
                                <span>Gambar tidak tersedia</span>
                            @endif
                        </div>
                    </td>                    
                      <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">
                          {{ $m->kotaorkab }}
                        </div>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <span class="text-sm text-gray-900">
                          {{ $m->provinsi }}
                        </span>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <span class="text-sm text-gray-900">
                          {{ $m->latitude }}
                        </span>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <span class="text-sm text-gray-900">
                          {{ $m->longitude }}
                        </span>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <!-- Edit Button -->
                        <a href="maps/{{ $m->id }}/edit" style="text-decoration: none;">
                          <button
                            style="
                              background-color: #6777ef;
                              color: white;
                              padding: 8px 16px;
                              font-size: 14px;
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
                        </a>
                        <!-- Delete Form -->
                        <form action="maps/{{$m->id}}" method="post" style="display: inline;">
                          @method('delete')
                          @csrf
                          <button type="submit"
                            style="
                              background-color: #e3342f;
                              color: white;
                              padding: 8px 16px;
                              font-size: 14px;
                              font-weight: bold;
                              border: none;
                              border-radius: 8px;
                              cursor: pointer;
                              box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                              transition: background-color 0.3s ease, box-shadow 0.3s ease;
                              margin-top: 8px; /* Jarak antar tombol */
                            "
                            onmouseover="this.style.backgroundColor='#c53030'; this.style.boxShadow='0 6px 8px rgba(0, 0, 0, 0.15)';"
                            onmouseout="this.style.backgroundColor='#e3342f'; this.style.boxShadow='0 4px 6px rgba(0, 0, 0, 0.1)';"
                          >
                            Hapus Data
                          </button>
                        </form>
                      </td>
                      
                    </tr>
                    <input type="hidden"
                      value="{{$m->id}}"
                      id="lab{{$loop->index}}">
                      <input type="hidden"
                      value="{{$m->nama_lokasi}}"
                      id="lok{{$loop->index}}">
                      <input type="hidden"
                      value="{{$m->deskripsi}}"
                      id="des{{$loop->index}}">
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
                    <!-- More rows... -->
                    
                  @endforeach
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
    <script src="{{url("../js2/view.js")}}"></script>
    <!-- Page Specific JS File -->
@endpush
