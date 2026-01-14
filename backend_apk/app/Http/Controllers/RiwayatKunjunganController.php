<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RiwayatKunjungan;

class RiwayatKunjunganController extends Controller
{
    /**
     * GET /api/kunjungan
     */
    public function index()
    {
        // Mengambil semua data kunjungan
       $data = RiwayatKunjungan::with(['pasien', 'dokter'])->latest()->get();
        
        return response()->json($data);
    }

    /**
     * POST /api/kunjungan
     */
    public function store(Request $request)
    {
        // Simpan data sesuai kolom di tabel HTML Anda
        return RiwayatKunjungan::create($request->all());
    }

    /**
     * GET /api/kunjungan/{id}
     */
    public function show($id)
    {
        $kunjungan = RiwayatKunjungan::with(['pasien', 'dokter'])->findOrFail($id);
        return response()->json($kunjungan);
    }

    /**
     * PUT /api/kunjungan/{id}
     * Diperbarui agar sesuai dengan kolom di tabel gambar Anda
     */
    public function update(Request $request, $id)
    {
        $kunjungan = RiwayatKunjungan::findOrFail($id);

        $request->validate([
            'tanggal_kunjungan' => 'sometimes|date',
            'keluhan_pasien'    => 'sometimes|string',
            'diagnosis'         => 'sometimes|string',
            'tindakan_medis'    => 'sometimes|string',
            'obat_diberikan'    => 'nullable|string'
        ]);

        $kunjungan->update($request->all());

        return response()->json($kunjungan);
    }

    /**
     * DELETE /api/kunjungan/{id}
     */
    public function destroy($id)
    {
        RiwayatKunjungan::destroy($id);

        return response()->json([
            'message' => 'Riwayat kunjungan berhasil dihapus'
        ]);
    }
}