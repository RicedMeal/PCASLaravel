<?php

use App\Http\Controllers\DownloadPDFController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AbstractofCanvassFormPDFController;
use App\Http\Controllers\PurchaseRequestFormPDFController;

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

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/{record}/pdf', [DownloadPDFController::class, 'download'])->name('projects.pdf');
Route::get('/download-abstract-pdf/{id}', [AbstractofCanvassFormPDFController::class, 'download'])->name('download.abstract.pdf');
Route::get('/download-purchase-request-pdf/{id}', [PurchaseRequestFormPDFController::class, 'download'])->name('download.purchase.request.pdf');

require __DIR__.'/auth.php';
