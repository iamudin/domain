<?php
use Leazycms\Domain\Controllers\WebController;
use Illuminate\Support\Facades\Route;
Route::get('registrasi', [WebController::class, 'registrasi']);
