<?php

use Illuminate\Support\Facades\Route;
use App\Models\Pet;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\AdocaoController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdoptionController;

/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/

Route::get('/', function () {

    $query = Pet::query();

    if(request('tipo')) {
        $query->where('tipo', request('tipo'));
    }

    $pets = $query->get();

    return view('welcome', compact('pets'));
});

/*
|--------------------------------------------------------------------------
| DASHBOARD (BREEZE)
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return redirect('/');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| ROTAS LOGADO
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Adoção
    Route::get('/adotar/{id}', [AdocaoController::class, 'create'])->name('adotar.create');
    Route::post('/adotar', [AdocaoController::class, 'store'])->name('adotar.store');

    // CRUD adoption
    Route::resource('adoptions', AdoptionController::class);
});

/*
|--------------------------------------------------------------------------
| ADMIN (PROTEGIDO)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth','admin'])->group(function () {

    // Dashboard admin (COM NOME 🔥)
    Route::get('/admin', [AdminController::class, 'dashboard'])
        ->name('admin.dashboard');

    // Aprovar / Recusar
    Route::get('/admin/aprovar/{id}', [AdminController::class, 'aprovar'])
        ->name('admin.aprovar');

    Route::get('/admin/recusar/{id}', [AdminController::class, 'recusar'])
        ->name('admin.recusar');

    // CRUD de pets
    Route::resource('pets', PetController::class);
});

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';