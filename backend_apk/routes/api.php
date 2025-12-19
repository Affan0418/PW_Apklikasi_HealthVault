<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\RiwayatKunjunganController;

Route::get('/users', function() {
    return \App\Models\User::all();
});

Route::get('/users/{id}', function ($id) {
    return User::findOrFail($id);
});

Route::put('/users/{id}', function (Request $request, $id) {
    $user = User::findOrFail($id);
    $user->update($request->all());
    return response()->json(['message' => 'Profil berhasil diperbarui']);
});

Route::apiResource('pasien', PasienController::class);
Route::apiResource('dokter', DokterController::class);
Route::apiResource('obat', ObatController::class);
Route::apiResource('kunjungan', RiwayatKunjunganController::class);