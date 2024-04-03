<?php

use App\Http\Controllers\DownloadPDFController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectDocumentController;
use App\Http\Controllers\PurchaseRequestFormPDFController;
use App\Http\Controllers\MaterialCostEstimatesController;

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

//project creation route
Route::get('/{record}/pdf', [DownloadPDFController::class, 'download'])->name('projects.pdf');

//route for downloading all pdf files as a zip
Route::get('/project-documents/{id}/download-all', [ProjectDocumentController::class, 'downloadAllPdfs'])->name('project-documents.downloadAllPdfs');

//purchase request form download route
Route::get('/purchase-request/{record}/pdf', [PurchaseRequestFormPDFController::class, 'pdf'])->name('purchase-request.pdf');

//route for downloading material cost estimates pdf
Route::get('/material-cost-estimates/{materialCostEstimate}/pdf', [MaterialCostEstimatesController::class, 'pdf'])->name('material-cost-estimates.pdf');

require __DIR__.'/auth.php';
