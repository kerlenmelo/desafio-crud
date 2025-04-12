<?php

use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return redirect(route('funcionario.index'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::resource('funcionario', FuncionarioController::class);
});

Route::get('/debug', function () {
    $manifest = file_get_contents(public_path('build/manifest.json'));
    return response()->json(json_decode($manifest, true));
});

require __DIR__ . '/auth.php';
