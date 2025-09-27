<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\OwnerController as AdminOwnerController;
use App\Http\Controllers\Admin\TenantController as AdminTenantController;
use App\Http\Controllers\Admin\AssignmentController as AdminAssignmentController;
use App\Http\Controllers\Owner\FlatController;
use App\Http\Controllers\Owner\BillCategoryController;
use App\Http\Controllers\Owner\BillController;
use App\Http\Controllers\Owner\OwnerController;
use App\Http\Controllers\Owner\PaymentController;

Route::get('/', function () {
    return to_route('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



Route::middleware(['auth'])->group(function () {
    // Admin routes
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function() {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::resource('owners', AdminOwnerController::class);
        Route::resource('tenants', AdminTenantController::class);
    });

    // Owner routes
    Route::middleware('role:owner')->prefix('owner')->name('owner.')->group(function() {
        Route::get('/dashboard', [OwnerController::class, 'dashboard'])->name('dashboard');
        Route::resource('flats', FlatController::class);
        Route::resource('categories', BillCategoryController::class)->only(['index','store','destroy']);
        Route::resource('bills', BillController::class)->only(['index','create','store','show']);
        Route::post('bills/{bill}/pay', [PaymentController::class, 'store'])->name('bills.pay');
    });
});



