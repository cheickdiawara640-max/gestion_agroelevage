<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    DashboardController, AnimalController, ParcelleController, CultureController,
    RecolteController, AlimentationController, SanteController, BudgetController,
    PersonnelController, BesoinController, AuthController, TraitementController,
    VenteController, UserController
};
use App\Http\Controllers\SettingController;

// I. AUTHENTIFICATION
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// II. ESPACE CONNECTÉ
Route::middleware(['auth'])->group(function(){
    
    // --- DASHBOARD ---
    Route::get('/', [DashboardController::class, 'index'])->name('accueil');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/pdf', [DashboardController::class, 'exportPdf'])->name('dashboard.pdf');

    // --- TOUTES LES ROUTES D'EXPORTS (Placées AVANT les ressources) ---
    
    // Élevage & Santé
    Route::get('/animaux/export/pdf', [AnimalController::class, 'exportPdf'])->name('animaux.export.pdf');
    Route::get('/animaux/export/excel', [AnimalController::class, 'exportExcel'])->name('animaux.export.excel');
    Route::get('/traitements/export/pdf', [TraitementController::class, 'exportPdfListe'])->name('traitements.export.pdf');
    Route::get('/traitements/export/excel', [TraitementController::class, 'exportExcel'])->name('traitements.export.excel');
    Route::get('/santes/export/pdf', [SanteController::class, 'exportPdf'])->name('santes.export.pdf');
    Route::get('/santes/export/excel', [SanteController::class, 'exportExcel'])->name('santes.export.excel');
    Route::get('/alimentations/export/pdf', [AlimentationController::class, 'exportPdf'])->name('alimentations.export.pdf');
    Route::get('/alimentations/export/excel', [AlimentationController::class, 'exportExcel'])->name('alimentations.export.excel');

    // Agriculture
    Route::get('/parcelles/export/pdf', [ParcelleController::class, 'exportPdf'])->name('parcelles.export.pdf');
    Route::get('/parcelles/export/excel', [ParcelleController::class, 'exportExcel'])->name('parcelles.export.excel');
    Route::get('/cultures/export/pdf', [CultureController::class, 'exportPdf'])->name('cultures.export.pdf');
    Route::get('/cultures/export/excel', [CultureController::class, 'exportExcel'])->name('cultures.export.excel');
    Route::get('/recoltes/export/pdf', [RecolteController::class, 'exportPdf'])->name('recoltes.export.pdf');
    Route::get('/recoltes/export/excel', [RecolteController::class, 'exportExcel'])->name('recoltes.export.excel');

    // Finance & Logistique
    Route::get('/ventes/export/pdf', [VenteController::class, 'exportPdfListe'])->name('ventes.export.pdf');
    Route::get('/ventes/export/excel', [VenteController::class, 'exportExcel'])->name('ventes.export.excel');
    Route::get('/budgets/export/pdf', [BudgetController::class, 'exportPdf'])->name('budgets.export.pdf');
    Route::get('/budgets/export/excel', [BudgetController::class, 'exportExcel'])->name('budgets.export.excel');
    Route::get('/besoins/export/pdf', [BesoinController::class, 'exportPdf'])->name('besoins.export.pdf');
    Route::get('/besoins/export/excel', [BesoinController::class, 'exportExcel'])->name('besoins.export.excel');
    Route::get('/personnels/export/pdf', [PersonnelController::class, 'exportPdf'])->name('personnels.export.pdf');
    Route::get('/personnels/export/excel', [PersonnelController::class, 'exportExcel'])->name('personnels.export.excel');
Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');
    // --- TOUTES LES RESOURCES ---
    Route::resource('animaux', AnimalController::class);
    Route::resource('traitements', TraitementController::class);
    Route::resource('ventes', VenteController::class);
    Route::resource('santes', SanteController::class);
    Route::resource('budgets', BudgetController::class);
    Route::resource('parcelles', ParcelleController::class);
    Route::resource('cultures', CultureController::class);
    Route::resource('recoltes', RecolteController::class);
    Route::resource('alimentations', AlimentationController::class);
    Route::resource('personnels', PersonnelController::class);
    Route::resource('besoins', BesoinController::class);
Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
Route::post('/tasks/store', [App\Http\Controllers\TaskController::class, 'store'])->name('tasks.store');
Route::patch('/tasks/{task}/complete', [App\Http\Controllers\TaskController::class, 'complete'])->name('tasks.complete');

});

// III. ADMINISTRATION
Route::middleware(['auth', 'admin'])->group(function() {
    Route::resource('users', UserController::class);
});