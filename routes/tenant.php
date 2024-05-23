<?php

declare(strict_types=1);

use App\Http\Controllers\Tenant\AuthController;
use App\Http\Controllers\Tenant\DashboardController;
use Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/
Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class])->prefix('tenant')->group(function () {
    Route::get('/login', [AuthController::class, 'create'])
        ->middleware('guest')
        ->name('tenant.login');

    Route::post('login', [AuthController::class, 'store'])
        ->middleware('guest',HandlePrecognitiveRequests::class)
        ->name('tenant.store');

    Route::post('/logout', [AuthController::class, 'destroy'])
        ->middleware('auth')
        ->name('tenant.logout');
});

Route::middleware([
    'web',
    'tenant.auth',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->prefix('tenant')->group(function () {
    Route::get('/clients-dashboard', [DashboardController::class, 'index'])
        ->name('clients.dashboard');
});
