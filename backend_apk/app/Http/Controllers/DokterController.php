<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use Illuminate\Http\Request;

class DokterController extends Controller
{
    // GET /api/dokter
    public function index()
    {
        return response()->json(Dokter::all());
    }

    // POST /api/dokter
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'spesialis' => 'required|string|max:100',
            'email' => 'nullable|email',
            'no_telepon' => 'nullable|string|max:20',
            'alamat' => 'nullable|string'
        ]);

        $dokter = Dokter::create($request->all());

        return response()->json($dokter, 201);
    }

    // GET /api/dokter/{id}
    public function show($id)
    {
        $dokter = Dokter::findOrFail($id);
        return response()->json($dokter);
    }

    // PUT /api/dokter/{id}
    public function update(Request $request, $id)
    {
        $dokter = Dokter::findOrFail($id);

        $dokter->update($request->all());

        return response()->json($dokter);
    }

    // DELETE /api/dokter/{id}
    public function destroy($id)
    {
        Dokter::destroy($id);

        return response()->json([
            'message' => 'Data dokter berhasil dihapus'
        ]);
    }
}
