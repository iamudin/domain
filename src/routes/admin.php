<?php
use Illuminate\Support\Facades\Route;
use Leazycms\Domain\Controllers\AdminController;
use Leazycms\Domain\Controllers\DomainController;
use Leazycms\Domain\Controllers\PengelolaController;
use Leazycms\Domain\Controllers\InvoiceController;
$contexts = [
    [
        'domain' => parse_url(config('app.url'), PHP_URL_HOST),
        'prefix' => admin_path().'/domain',
        'name'   => 'panel.domain.',
    ],
    [
        'domain' => parse_url(config('domain.url'), PHP_URL_HOST), 
        'prefix' => null,
        'name'   => null,
    ],
];

foreach ($contexts as $ctx) {
    Route::group([
        'domain' => $ctx['domain'],
        'prefix' => $ctx['prefix'],
        'as'     => $ctx['name'],
    ], function () {
        Route::get('/', [AdminController::class, 'index']);
        Route::get('dashboard', [AdminController::class, 'index'])->name('domain.dashboard');
        Route::resource('daftar', DomainController::class);
        Route::resource('pengelola', PengelolaController::class);
        Route::resource('invoice', InvoiceController::class);
    });
}