<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RiwayatKunjungan;

class RiwayatKunjunganController extends Controller
{
 /**
     * GET /api/kunjungan
     * Menampilkan semua riwayat kunjungan
     */
    public function index()
    {
        return response()->json(
            RiwayatKunjungan::with(['pasien', 'dokter'])->get()
        );
    }

    /**
     * POST /api/kunjungan
     * Menyimpan data kunjungan baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'pasien_id' => 'required|exists:pasien,id',
            'dokter_id' => 'required|exists:dokter,id',
            'tanggal_kunjungan' => 'required|date',
            'keluhan' => 'required|string',
            'diagnosis' => 'nullable|string',
            'tindakan' => 'nullable|string',
            'resep' => 'nullable|string'
        ]);

        $kunjungan = RiwayatKunjungan::create($request->all());

        return response()->json($kunjungan, 201);
    }

    /**
     * GET /api/kunjungan/{id}
     * Detail satu kunjungan
     */
    public function show($id)
    {
        $kunjungan = RiwayatKunjungan::with(['pasien', 'dokter'])
                        ->findOrFail($id);

        return response()->json($kunjungan);
    }

    /**
     * PUT /api/kunjungan/{id}
     * Update data kunjungan
     */
    public function update(Request $request, $id)
    {
        $kunjungan = RiwayatKunjungan::findOrFail($id);

        $request->validate([
            'pasien_id' => 'sometimes|exists:pasien,id',
            'dokter_id' => 'sometimes|exists:dokter,id',
            'tanggal_kunjungan' => 'sometimes|date',
            'keluhan' => 'sometimes|string',
            'diagnosis' => 'nullable|string',
            'tindakan' => 'nullable|string',
            'resep' => 'nullable|string'
        ]);

        $kunjungan->update($request->all());

        return response()->json($kunjungan);
    }

    /**
     * DELETE /api/kunjungan/{id}
     * Hapus data kunjungan
     */
    public function destroy($id)
    {
        RiwayatKunjungan::destroy($id);

        return response()->json([
            'message' => 'Riwayat kunjungan berhasil dihapus'
        ]);
    }
}
