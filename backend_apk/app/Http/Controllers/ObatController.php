<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Obat;

class ObatController extends Controller
{
    // GET /api/obat
    public function index()
    {
        return response()->json(Obat::all());
    }

    // POST /api/obat
    public function store(Request $request)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:150',
            'jenis_obat' => 'nullable|string|max:100',
            'harga' => 'required|integer|min:0',
            'stok' => 'required|integer|min:0',
            'keterangan' => 'nullable|string'
        ]);

        $obat = Obat::create($request->all());

        return response()->json($obat, 201);
    }

    // GET /api/obat/{id}
    public function show($id)
    {
        $obat = Obat::findOrFail($id);
        return response()->json($obat);
    }

    // PUT /api/obat/{id}
    public function update(Request $request, $id)
    {
        $obat = Obat::findOrFail($id);

        $obat->update($request->all());

        return response()->json($obat);
    }

    // DELETE /api/obat/{id}
    public function destroy($id)
    {
        Obat::destroy($id);

        return response()->json([
            'message' => 'Data obat berhasil dihapus'
        ]);
    }
}
