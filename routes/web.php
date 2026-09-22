<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AssignmentLetterController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\DeliveryOrderController;
use App\Http\Controllers\PembukuanController;
use Illuminate\Filesystem\Filesystem;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::get('/demo-wms', [\App\Http\Controllers\WmsDemoController::class, 'index'])->name('wms.demo');
Route::post('/kirim-pesan', [ContactController::class, 'send'])->name('contact.send');
Route::post('/kirim-inquiry-managed', [ContactController::class, 'sendServiceInquiry'])->name('contact.managed-inquiry');
Route::post('/kirim-inquiry-layanan', [ContactController::class, 'sendServiceInquiry'])->name('contact.service-inquiry');
Route::get('/layanan/{service:slug}', [ServiceController::class, 'publicShow'])->name('services.public.show');

Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->middleware(['auth', 'verified', 'session.timeout'])->name('dashboard');
Route::post('/dashboard/refresh-session', [\App\Http\Controllers\DashboardController::class, 'refreshSession'])->middleware(['auth', 'session.timeout'])->name('dashboard.refresh-session');

Route::middleware(['auth', 'session.timeout'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // User management routes
    Route::resource('users', \App\Http\Controllers\UserController::class);
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
    
    // Surat Jalan (Delivery Order) Routes
    Route::get('delivery-orders/preview-do-number', [DeliveryOrderController::class, 'previewDoNumber'])->name('delivery-orders.preview-do-number');
    Route::resource('delivery-orders', DeliveryOrderController::class);
    Route::get('delivery-orders/{id}/generate-pdf', [DeliveryOrderController::class, 'generatePdf'])->name('delivery-orders.generate-pdf');
    Route::get('delivery-orders/{id}/download-pdf', [DeliveryOrderController::class, 'downloadPdf'])->name('delivery-orders.download-pdf');

    // Pembukuan
    Route::resource('pembukuan', PembukuanController::class);
    Route::get('pembukuan/{pembukuan}/pdf', [PembukuanController::class, 'pdf'])->name('pembukuan.pdf');

    // Assignment Letters PDF routes
    Route::get('assignment-letters/{id}/generate-pdf', [AssignmentLetterController::class, 'generatePdf'])->name('assignment-letters.generate-pdf');
    Route::get('assignment-letters/{id}/download-pdf', [AssignmentLetterController::class, 'downloadPdf'])->name('assignment-letters.download-pdf');
    
    Route::get('dashboard/about', [AboutController::class, 'editSingle'])->name('dashboard.about.edit');
    Route::post('dashboard/about', [AboutController::class, 'updateSingle'])->name('dashboard.about.update');

    // Inquiries (Pesan Masuk Konsultasi Website)
    Route::resource('dashboard/inquiries', \App\Http\Controllers\InquiryController::class)->names('inquiries');
    Route::post('dashboard/inquiries/{inquiry}/toggle-read', [\App\Http\Controllers\InquiryController::class, 'toggleRead'])->name('inquiries.toggle-read');

    // Pengaturan Website (Site Settings & WMS Demo URL)
    Route::get('dashboard/settings', [\App\Http\Controllers\SiteSettingController::class, 'index'])->name('dashboard.settings.index');
    Route::post('dashboard/settings', [\App\Http\Controllers\SiteSettingController::class, 'update'])->name('dashboard.settings.update');
});

Route::get('/perbaiki-sistem', function() {
    // 1. Bersihkan Cache
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    Artisan::call('cache:clear');
    
    // 2. Buat Link Storage (Biar gambar sumberloka muncul)
    $storagePath = public_path('storage');
    if (file_exists($storagePath) && !is_link($storagePath)) {
        $backup = public_path('storage_old_' . time());
        @rename($storagePath, $backup);

        // Kalau rename gagal (mis. file sedang dipakai), hapus directory agar bisa dibuat link.
        if (file_exists($storagePath) && !is_link($storagePath)) {
            (new Filesystem())->deleteDirectory($storagePath);
        }
    }

    Artisan::call('storage:link', ['--force' => true]);

    return "Sistem Ruang Solusi berhasil diperbarui!";
});

require __DIR__.'/auth.php';