<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CentreController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\PaiementController;
use Illuminate\Support\Facades\Route;
use App\Exports\RegionsExport;
use Maatwebsite\Excel\Facades\Excel;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/dashboard', [DashboardController::class, 'dashboard'])
    ->middleware(['auth'])
    ->name('dashboard');

// Routes d'authentification générées par Breeze
Route::get('/register', [RegisteredUserController::class, 'create'])
    ->middleware('guest')
    ->name('register');

Route::post('/register', [RegisteredUserController::class, 'store'])
    ->middleware('guest');

Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->middleware('guest')
    ->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->middleware('guest');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

// Region Crud
Route::middleware(['auth'])->prefix('regions')->name('regions.')->group(function () {
    Route::get('listes', [RegionController::class, 'index'])->name('index');
    Route::get('data', [RegionController::class, 'data'])->name('data');
    Route::get('create', [RegionController::class, 'create'])->name('create');
    Route::post('/', [RegionController::class, 'store'])->name('store');
    Route::get('{region}/edit', [RegionController::class, 'edit'])->name('edit');
    Route::put('{region}', [RegionController::class, 'update'])->name('update');
    Route::delete('{region}', [RegionController::class, 'destroy'])->name('destroy');
});
Route::get('regions/export', [RegionController::class, 'export'])->name('regions.export');

// Centres Crud
Route::middleware(['auth'])->prefix('centres')->name('centres.')->group(function () {
    Route::get('listes', [CentreController::class, 'index'])->name('index');
    Route::get('data', [CentreController::class, 'data'])->name('data');
    Route::get('create', [CentreController::class, 'create'])->name('create');
    Route::post('/', [CentreController::class, 'store'])->name('store');
    Route::get('{centre}/edit', [CentreController::class, 'edit'])->name('edit');
    Route::put('{centre}', [CentreController::class, 'update'])->name('update');
    Route::delete('{centre}', [CentreController::class, 'destroy'])->name('destroy');
});

// Participants Crud
Route::middleware(['auth'])->prefix('participants')->name('participants.')->group(function () {
    Route::get('listes', [ParticipantController::class, 'index'])->name('index');
    Route::get('data', [ParticipantController::class, 'data'])->name('data');
    Route::get('create', [ParticipantController::class, 'create'])->name('create');
    Route::post('/', [ParticipantController::class, 'store'])->name('store');
    Route::get('{participant}/edit', [ParticipantController::class, 'edit'])->name('edit');
    Route::put('{participant}', [ParticipantController::class, 'update'])->name('update');
    Route::delete('{participant}', [ParticipantController::class, 'destroy'])->name('destroy');

    // Paiements liés à un participant
    Route::post('{participant}/paiements', [ParticipantController::class, 'storePaiement'])->name('storePaiement');
});

// Paiements Crud

Route::middleware(['auth'])->prefix('paiements')->name('paiements.')->group(function () {
    Route::get('listes', [PaiementController::class, 'index'])->name('index');
    Route::get('data', [PaiementController::class, 'data'])->name('data');
    Route::get('create', [PaiementController::class, 'create'])->name('create');
    Route::post('/', [PaiementController::class, 'store'])->name('store');
    Route::get('{paiement}/edit', [PaiementController::class, 'edit'])->name('edit');
    Route::put('{paiement}', [PaiementController::class, 'update'])->name('update');
    Route::delete('{paiement}', [PaiementController::class, 'destroy'])->name('destroy');
});
