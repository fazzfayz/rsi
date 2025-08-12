<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AssignmentLetterController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PurchaseOrderController;
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
    Route::get('/', [LandingController::class, 'index'])->name('landing');
    Route::post('/kirim-pesan', [ContactController::class, 'send'])->name('contact.send');

Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->middleware(['auth', 'verified', 'session.timeout'])->name('dashboard');
Route::post('/dashboard/refresh-session', [\App\Http\Controllers\DashboardController::class, 'refreshSession'])->middleware(['auth', 'session.timeout'])->name('dashboard.refresh-session');

Route::middleware(['auth', 'session.timeout'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'session.timeout'])->group(function () {
    Route::resource('dashboard/services', ServiceController::class);
    Route::resource('clients', ClientController::class);
    Route::resource('employees', EmployeeController::class);
    Route::resource('assignment-letters', AssignmentLetterController::class);
    Route::resource('invoices', InvoiceController::class);
    
    // Invoice PDF routes
    Route::get('invoices/{invoice}/generate-pdf', [InvoiceController::class, 'generatePdf'])->name('invoices.generate-pdf');
    Route::get('invoices/{invoice}/download-pdf', [InvoiceController::class, 'downloadPdf'])->name('invoices.download-pdf');
    
    // Purchase Order routes
    Route::resource('purchase-orders', PurchaseOrderController::class);
    Route::get('purchase-orders/{purchaseOrder}/pdf', [PurchaseOrderController::class, 'pdf'])->name('purchase-orders.pdf');
    Route::get('purchase-orders/vendor-data', [PurchaseOrderController::class, 'getVendorData'])->name('purchase-orders.vendor-data');
    
    // Assignment Letters PDF routes
    Route::get('assignment-letters/{id}/generate-pdf', [AssignmentLetterController::class, 'generatePdf'])->name('assignment-letters.generate-pdf');
    Route::get('assignment-letters/{id}/download-pdf', [AssignmentLetterController::class, 'downloadPdf'])->name('assignment-letters.download-pdf');
    Route::get('dashboard/about', [AboutController::class, 'editSingle'])->name('dashboard.about.edit');
    Route::post('dashboard/about', [AboutController::class, 'updateSingle'])->name('dashboard.about.update');
});

require __DIR__.'/auth.php';
