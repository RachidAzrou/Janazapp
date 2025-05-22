<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\CasesController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\CaseActivityController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\TransportArrangementController;
use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\AuditLogController;
use App\Http\Controllers\Auth\RegisteredUserController;

//ROUTES USER__________________________________________________
Route::get('/users', [RegisteredUserController::class, 'list'])
    ->middleware(['auth', 'verified'])
    ->name('users');

Route::get('/users/{id}/details', [RegisteredUserController::class, 'detailsUser'])
    ->middleware(['auth', 'verified'])
    ->name('user.details');

Route::post('/users/{id}/details', [RegisteredUserController::class, 'postEditUser'])
    ->middleware(['auth', 'verified'])
    ->name('user.edit');

Route::get('/users/{id}/edit', [RegisteredUserController::class, 'getEditUser'])
    ->middleware(['auth', 'verified'])
    ->name('user.edit');
//_____________________________________________________________
//ROUTES ORGANIZATION__________________________________________
Route::get('/organizations', [OrganizationController::class, 'list'])
    ->middleware(['auth', 'verified'])
    ->name('organizations');

Route::get('/organizations/{id}/details', [OrganizationController::class, 'detailsOrganization'])
    ->middleware(['auth', 'verified'])
    ->name('organization.details');

Route::post('/organizations/{id}/details', [OrganizationController::class, 'postEditOrganization'])
    ->middleware(['auth', 'verified'])
    ->name('organization.postedit');

Route::get('/organizations/{id}/edit', [OrganizationController::class, 'getEditOrganization'])
    ->middleware(['auth', 'verified'])
    ->name('organization.getedit');

Route::get('/organizations/create', [OrganizationController::class, 'create'])
    ->middleware(['auth', 'verified'])
    ->name('organizations.create');

Route::post('/organizations', [OrganizationController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('organizations.store');

Route::delete('/organizations/{id}', [OrganizationController::class, 'delete'])
    ->middleware(['auth', 'verified'])
    ->name('organizations.delete');

Route::get('/organizations/{organization}/users', [OrganizationController::class, 'showUsers'])
    ->middleware(['auth', 'verified'])
    ->name('organizations.showUsers');
//_____________________________________________________________
//ROUTES CASES_________________________________________________
Route::get('/cases', [CasesController::class, 'list'])
    ->middleware(['auth', 'verified'])
    ->name('cases');

Route::get('/cases/{id}/details', [CasesController::class, 'detailsCase'])
    ->middleware(['auth', 'verified'])
    ->name('cases.details');

Route::post('/cases/{id}/details', [CasesController::class, 'postEditCase'])
    ->middleware(['auth', 'verified'])
    ->name('cases.postedit');

Route::get('/cases/{id}/edit', [CasesController::class, 'getEditCase'])
    ->middleware(['auth', 'verified'])
    ->name('cases.getedit');

Route::get('/cases/create', [CasesController::class, 'create'])
    ->middleware(['auth', 'verified'])
    ->name('cases.create');

Route::post('/cases', [CasesController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('cases.store');
//_____________________________________________________________

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';


//test

Route::get('dashboardic', function () {
    return Inertia::render('InsuranceCompany/Dashboard');
});

Route::get('tasksmanagementic', function () {
    return Inertia::render('InsuranceCompany/TasksManagement');
});

Route::get('filemanagementic', function () {
    return Inertia::render('InsuranceCompany/Files/FileManagement');
});

Route::get('allfilesic', function () {
    return Inertia::render('InsuranceCompany/Files/AllFiles');
});

Route::get('newdossieric', function () {
    return Inertia::render('InsuranceCompany/Files/NewDossier');
});

Route::get('searchfileic', function () {
    return Inertia::render('InsuranceCompany/Files/SearchFile');
});

Route::get('searchresultsic', function () {
    return Inertia::render('InsuranceCompany/Files/SearchResults');
});

Route::get('fileic', function () {
    return Inertia::render('InsuranceCompany/Files/File');
});

Route::get('chatic', function () {
    return Inertia::render('InsuranceCompany/Chat');
});

Route::get('reportsic', function () {
    return Inertia::render('InsuranceCompany/Reports/Reports');
});

Route::get('overviewreportic', function () {
    return Inertia::render('InsuranceCompany/Reports/OverviewReport');
});

Route::get('managementreportic', function () {
    return Inertia::render('InsuranceCompany/Reports/ManagementReport');
});

Route::get('costreportic', function () {
    return Inertia::render('InsuranceCompany/Reports/CostReport');
});

Route::get('performancereportic', function () {
    return Inertia::render('InsuranceCompany/Reports/PerformanceReport');
});