<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CentreController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\PaiementController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttestationController;
use App\Http\Controllers\DiplomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\UserController;
use App\Models\User;

//supprimeruser
Route::delete('/users/{user}', [RolePermissionController::class, 'destroy'])->name('users.destroy');

Route::get('/account', [UserController::class, 'index'])->name('account');

Route::get('/', function () {
    return redirect()->route('login');
});
Route::get('/profile', [UserController::class, 'index'])->name('profile.index');
Route::put('/profile/update', [UserController::class, 'update'])->name('profile.update');

Route::middleware(['auth', 'role:super-admin'])->group(function () {
    Route::get('/role-permissions', [RolePermissionController::class, 'index'])->name('role_permissions.index');
    Route::post('/role-permissions/assign-role/{user}', [RolePermissionController::class, 'assignRole'])->name('role_permissions.assign_role');
    Route::post('/role-permissions/remove-role/{user}', [RolePermissionController::class, 'removeRole'])->name('role_permissions.remove_role');
    Route::post('/role-permissions/give-permission/{user}', [RolePermissionController::class, 'givePermission'])->name('role_permissions.give_permission');
    Route::post('/role-permissions/revoke-permission/{user}', [RolePermissionController::class, 'revokePermission'])->name('role_permissions.revoke_permission');
    Route::post('/users', [RolePermissionController::class, 'store'])->name('users.store');
});

Route::middleware(['auth', 'permission:add regions'])->group(function () {
    Route::get('regions/create', [RegionController::class, 'create'])->name('regions.create');
    Route::post('regions', [RegionController::class, 'store'])->name('regions.store');
    Route::delete('regions/{region}', [RegionController::class, 'destroy'])->name('regions.destroy');
});

Route::middleware(['auth', 'permission:add centres'])->group(function () {
    Route::get('centres/create', [CentreController::class, 'create'])->name('centres.create');
    Route::post('centres', [CentreController::class, 'store'])->name('centres.store');
});

Route::middleware(['auth', 'permission:delete centres'])->group(function () {
    Route::delete('centres/{centre}', [CentreController::class, 'destroy'])->name('centres.destroy');
});


Route::get('/dashboard', [DashboardController::class, 'dashboard'])
    ->middleware(['auth'])
    ->name('dashboard');

// Authentication routes
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
});

Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

// Protected routes with permissions
Route::middleware(['auth'])->group(function () {
    // Region routes
    Route::middleware(['permission:manage regions'])->prefix('regions')->name('regions.')->group(function () {
        Route::get('listes', [RegionController::class, 'index'])->name('index');
        Route::get('data', [RegionController::class, 'data'])->name('data');
        Route::get('create', [RegionController::class, 'create'])->name('create');
        Route::post('/', [RegionController::class, 'store'])->name('store');
        Route::get('{region}/edit', [RegionController::class, 'edit'])->name('edit');
        Route::put('{region}', [RegionController::class, 'update'])->name('update');
        Route::delete('{region}', [RegionController::class, 'destroy'])->name('destroy');
        Route::get('export', [RegionController::class, 'export'])->name('export');
    });

    // Centre routes
    Route::middleware(['permission:manage centres'])->prefix('centres')->name('centres.')->group(function () {
        Route::get('listes', [CentreController::class, 'index'])->name('index');
        Route::get('data', [CentreController::class, 'data'])->name('data');
        Route::get('create', [CentreController::class, 'create'])->name('create');
        Route::post('/', [CentreController::class, 'store'])->name('store');
        Route::get('{centre}/edit', [CentreController::class, 'edit'])->name('edit');
        Route::put('{centre}', [CentreController::class, 'update'])->name('update');
        Route::delete('{centre}', [CentreController::class, 'destroy'])->name('destroy');
        Route::get('export', [CentreController::class, 'export'])->name('export');
    });

    // Participant routes
    Route::middleware(['permission:manage participants'])->prefix('participants')->name('participants.')->group(function () {
        Route::get('listes', [ParticipantController::class, 'index'])->name('index');
        Route::get('data', [ParticipantController::class, 'data'])->name('data');
        Route::get('create', [ParticipantController::class, 'create'])->name('create');
        Route::post('/', [ParticipantController::class, 'store'])->name('store');
        Route::get('{participant}/edit', [ParticipantController::class, 'edit'])->name('edit');
        Route::put('{participant}', [ParticipantController::class, 'update'])->name('update');
        Route::delete('{participant}', [ParticipantController::class, 'destroy'])->name('destroy');
        Route::post('{participant}/paiements', [ParticipantController::class, 'storePaiement'])->name('storePaiement');
        Route::get('export', [ParticipantController::class, 'export'])->name('export');
        Route::get('centre/{centreId}', [ParticipantController::class, 'filterByCentre'])->name('byCentre');
        Route::get('region/{regionId}', [ParticipantController::class, 'filterByRegion'])->name('byRegion');
        Route::get('/diplomes/{participant}/print', [ParticipantController::class, 'printDiplome'])->name('diplomes.print');
    });

    // Paiement routes
    Route::get('paiements/data', [PaiementController::class, 'data'])->name('paiements.data');
    Route::put('/paiements/{paiement}', [PaiementController::class, 'update'])->name('paiements.update');
    Route::middleware(['permission:manage payments'])->prefix('paiements')->name('paiements.')->group(function () {
        Route::get('listes', [PaiementController::class, 'index'])->name('index');
        Route::get('create', [PaiementController::class, 'create'])->name('create');
        Route::post('/', [PaiementController::class, 'store'])->name('store');
        Route::get('{id}/edit', [PaiementController::class, 'edit'])->name('edit');
        Route::put('{paiement}', [PaiementController::class, 'update'])->name('update');
        Route::delete('{paiement}', [PaiementController::class, 'destroy'])->name('destroy');
    });
    

    // Diplome routes
    Route::middleware(['permission:manage diplomas'])->prefix('diplomes')->name('diplomes.')->group(function () {
        Route::get('{participant}/print', [DiplomeController::class, 'print'])->name('print');
    });

    // Attestation routes
    Route::middleware(['permission:manage certificates'])->prefix('attestations')->name('attestations.')->group(function () {
        Route::get('{participant}/print', [AttestationController::class, 'print'])->name('print');
    });
});