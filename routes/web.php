<?php

use App\Http\Controllers\AngpaoController;
use Inertia\Inertia;

// Halaman utama untuk ambil angpao
Route::get('/angpao/{poolId}', function ($poolId) {
    return Inertia::render('Angpao/Index', [
        'poolId' => $poolId
    ]);
});

// Endpoint untuk proses claim (Gunakan POST)
Route::post('/angpao/claim/{poolId}', [AngpaoController::class, 'claim'])->name('angpao.claim');