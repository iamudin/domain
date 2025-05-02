<?php
use Illuminate\Support\Facades\Route;
use Leazycms\Domain\Controllers\AdminController;
use Leazycms\Domain\Controllers\DomainController;
use Leazycms\Domain\Controllers\PengelolaController;
use Leazycms\Domain\Controllers\InvoiceController;
use Leazycms\Domain\Models\Invoice;

$path = 'domain';
Route::prefix($path)->group(function()use($path){
    Route::get('/', [AdminController::class, 'index']);
    Route::get('dashboard', [AdminController::class, 'index'])->name($path.'.dashboard');
    Route::resource('daftar', DomainController::class);
    Route::resource('pengelola', PengelolaController::class);
    Route::resource('invoice', InvoiceController::class);
});

