<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;

class PasienController extends Controller
{
    public function index()
    {
        return response()->json(\App\Models\Pasien::all());
    }

    public function store(Request $request)
    {
        return Pasien::create($request->all());
    }

    public function show($id)
    {
        return Pasien::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $pasien = Pasien::findOrFail($id);
        $pasien->update($request->all());
        return $pasien;
    }

    public function destroy($id)
    {
        Pasien::destroy($id);
        return response()->json(['message' => 'Data dihapus']);
    }
}
