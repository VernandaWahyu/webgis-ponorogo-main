<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Map;

class MapController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Filter data untuk hanya menampilkan lokasi di Ponorogo
        $maps = Map::where('kotaorkab', 'Ponorogo')->get();
        return view('maps2.index', compact('maps'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $maps = Map::all();
        return view('maps2.create', compact('maps'));
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'nama_lokasi' => 'required',
        'deskripsi' => 'required',
        'provinsi' => 'required',
        'kotaorkab' => 'required',
        'latitude' => 'required',
        'longitude' => 'required',
        'gambar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi gambar
    ]);

    $imageName = null;
    if ($request->hasFile('gambar')) {
        $imageName = time().'.'.$request->gambar->extension();  
        $request->gambar->move(public_path('images'), $imageName);
    }

    Map::create([
        'nama_lokasi' => $request->nama_lokasi,
        'deskripsi' => $request->deskripsi,
        'provinsi' => $request->provinsi,
        'kotaorkab' => $request->kotaorkab,
        'latitude' => $request->latitude,
        'longitude' => $request->longitude,
        'gambar' => $imageName, // Simpan path gambar
    ]);

    return redirect('/maps')->with('status', 'Data berhasil ditambahkan!');
}


    /**
     * @param  \App\Models\Map  $map
     * @return \Illuminate\Http\Response
     * Display the specified resource.
     */
    public function show(Map $map)
    {
        //
    }

    /**
     * @param  \App\Models\Map  $map
     * @return \Illuminate\Http\Response
     * Show the form for editing the specified resource.
     */
    public function edit(Map $map)
    {
        $maps = Map::all();
        return view('maps2.edit', compact('map'), compact('maps'));
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Map  $map
     * @return \Illuminate\Http\Response
     * Update the specified resource in storage.
     */
    public function update(Request $request, Map $map)
{
    $request->validate([
        'nama_lokasi' => 'required',
        'deskripsi' => 'required',
        'provinsi' => 'required',
        'kotaorkab' => 'required',
        'latitude' => 'required',
        'longitude' => 'required',
        'gambar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi gambar
    ]);

    $imageName = $map->gambar; // Default gambar lama

    // Proses penggantian gambar jika ada gambar baru
    if ($request->hasFile('gambar')) {
        // Hapus gambar lama
        if ($map->gambar) {
            $oldImagePath = public_path('images') . '/' . $map->gambar;
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath); // Menghapus gambar lama
            }
        }

        // Simpan gambar baru
        $imageName = time() . '.' . $request->gambar->extension();
        $request->gambar->move(public_path('images'), $imageName); // Pindahkan gambar baru
    }

    // Update data map
    $map->update([
        'nama_lokasi' => $request->nama_lokasi,
        'deskripsi' => $request->deskripsi,
        'provinsi' => $request->provinsi,
        'kotaorkab' => $request->kotaorkab,
        'latitude' => $request->latitude,
        'longitude' => $request->longitude,
        'gambar' => $imageName, // Simpan nama gambar baru
    ]);

    return redirect('/maps')->with('status', 'Data berhasil diubah!');
}



    /**
     * @param  \App\Models\Map  $map
     * @return \Illuminate\Http\Response
     */
    public function destroy(Map $map)
    {
        Map::destroy($map->id);
        return redirect('/maps')->with('status', 'Data berhasil di delete!');
    }
}
