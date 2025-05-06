<?php
use Leazycms\Domain\Controllers\WebController;
use Illuminate\Support\Facades\Route;
Route::get('/', [WebController::class, 'home']);
Route::get('termasuk', [WebController::class, 'termasuk']);
