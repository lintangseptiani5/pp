<?php

use App\Http\Controllers\CropController;
use App\Models\DataCuaca;
use App\Models\DataTanaman;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/rekomendasi-panen', function () {
    return view('rekomendasi_panen');
});

Route::get('/rekomendasi-tanam', function () {
    return view('rekomendasi_tanam');
});


Route::get('/test-cuaca', function () {
    return DataCuaca::all();
});


Route::get('/test-tanaman', function () {
    return DataTanaman::all();
});


Route::post('/recommend', [CropController::class, 'recommend']);
Route::post('/predict-harvest', [CropController::class, 'predictHarvest']);