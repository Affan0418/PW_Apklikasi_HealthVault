<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\RiwayatkunjunganController;

Route::apiResource('pasien', PasienController::class);
Route::apiResource('dokter', DokterController::class);
Route::apiResource('obat', ObatController::class);
Route::apiResource('kunjungan', RiwayatkunjunganController::class);