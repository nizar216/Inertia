<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Tenant\AuthController;
use App\Http\Controllers\Tenant\DashboardController;
use App\Http\Middleware\EnsureTenantIsAuthenticated;
use App\Http\Middleware\TenantGuestMiddleware;
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
        ->middleware(TenantGuestMiddleware::class)
        ->name('tenant.login');

    Route::post('login', [AuthController::class, 'store'])
        ->middleware(HandlePrecognitiveRequests::class)
        ->name('tenant.store');

    Route::post('/logout', [AuthController::class, 'destroy'])
        ->middleware('auth')
        ->name('tenant.logout');
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('tenant.password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('tenant.password.email');
});

Route::middleware([
    'web',
    EnsureTenantIsAuthenticated::class,
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->prefix('tenant')->group(function () {
    Route::get('/clients-dashboard', [DashboardController::class, 'index'])
        ->name('clients.dashboard');
});
