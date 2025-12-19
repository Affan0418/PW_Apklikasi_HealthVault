<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use Illuminate\Http\Request;

class DokterController extends Controller
{
    // GET /api/dokter
    public function index()
    {
        return response()->json(\App\Models\Dokter::all());
    }

    // POST /api/dokter
    public function store(Request $request)
    {
        return Dokter::create($request->all());
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
