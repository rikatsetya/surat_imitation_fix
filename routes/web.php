<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\InboxModelController;
use App\Http\Controllers\SuratModelController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::pattern('id', '[0-9]+');

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'postlogin']);
Route::get('logout', [AuthController::class, 'logout'])->middleware('auth');
Route::get('register', [AuthController::class, 'register']);
Route::post('register', [AuthController::class, 'store']);

Route::middleware(['auth'])->group(function () {
    Route::get('/', [WelcomeController::class, 'index']);

    Route::prefix('inbox')->group(function () {
        Route::post('/list', [InboxModelController::class, 'list']);
        Route::get('/{id}/export', [SuratModelController::class, 'export_pdf']);
        Route::get('/{id}/delete', [InboxModelController::class, 'confirm']);
        Route::delete('/{id}/delete', [InboxModelController::class, 'delete']);
    });

    Route::prefix('memo')->group(function () {
        Route::get('/', [SuratModelController::class, 'index']);
        Route::post('/list', [SuratModelController::class, 'list']);
        Route::get('/create', [SuratModelController::class, 'create']);
        Route::post('/store', [SuratModelController::class, 'store']);
        Route::get('/{id}', [SuratModelController::class, 'show']);
        Route::get('/{id}/export', [SuratModelController::class, 'export_pdf']);
        Route::get('/{id}/delete', [SuratModelController::class, 'confirm']);
        Route::delete('/{id}/delete', [SuratModelController::class, 'delete']);
    });

    Route::prefix('surat')->group(function () {
        Route::get('/{id}', [InboxModelController::class, 'show']);
        Route::get('/{id}/export', [SuratModelController::class, 'export_pdf']);
        Route::get('/{id}/send', [SuratModelController::class, 'send']);
        Route::post('/{id}/sent', [SuratModelController::class, 'sent']);
        Route::get('/{id}/forward', [InboxModelController::class, 'forward']);
        Route::post('/{id}/forwarding', [InboxModelController::class, 'forwarding']);
    });

    Route::prefix('outbox')->group(function () {
        Route::get('/', [InboxModelController::class, 'outbox']);
        Route::post('/list', [InboxModelController::class, 'outboxlist']);
    });
});
