<?php

use Illuminate\Support\Facades\Route;
use App\Models\Pet;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\AdocaoController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| HOME (LISTA DE PETS)
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
| DASHBOARD PADRÃO DO BREEZE
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return redirect('/');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| PERFIL (BREEZE)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 🐶 ADOÇÃO (SÓ LOGADO)
    Route::get('/adotar/{id}', [AdocaoController::class, 'create']);
    Route::post('/adotar', [AdocaoController::class, 'store']);
});

/*
|--------------------------------------------------------------------------
| ADMIN (SÓ ADMIN)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth','admin'])->group(function () {

    // CRUD PETS
    Route::resource('pets', PetController::class);

    // DASHBOARD ADMIN
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);

    // APROVAR / RECUSAR
    Route::get('/admin/aprovar/{id}', [AdminController::class, 'aprovar']);
    Route::get('/admin/recusar/{id}', [AdminController::class, 'recusar']);
});

/*
|--------------------------------------------------------------------------
| AUTH (LOGIN / REGISTER)
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';