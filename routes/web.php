<?php

use App\Http\Controllers\FranchisorPackageController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ValidationController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\SalesOrderController;
use App\Http\Controllers\PurchaseOrderController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SalesReportController;

Route::get('/', function () {
    return view('home', ['title' => 'home']);
});

Auth::routes();

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        $user = Auth::user();  // Get the authenticated user
        $usertype = $user->usertype;

        if ($usertype == 'user') {
            switch ($user->status) {  // Use the user's status
                case 'Registered':
                    return view('dashboard');
                case 'Paid':
                    return view('pending');
                case 'Completed':
                    return view('complete');
                default:
                    return redirect()->back();
            }
        } elseif ($usertype == 'admin') {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->back();
        }
    })->name('dashboard');

    Route::middleware(['admin'])->group(function () {
        Route::get('/adminhome', [FranchisorPackageController::class, 'index'])->name('adminhome');
        Route::post('/adminhome', [FranchisorPackageController::class, 'index'])->name('adminhome.post');
        Route::get('/adminhome/{id}/edit', [FranchisorPackageController::class, 'edit'])->name('adminhome.edit');
        Route::patch('/adminhome/{id}', [FranchisorPackageController::class, 'update'])->name('adminhome.update');
        Route::delete('/adminhome/{id}', [FranchisorPackageController::class, 'destroy'])->name('adminhome.delete');

        Route::get('/validation', [ValidationController::class, 'index'])->name('validation');
        Route::post('/validation/{id}', [ValidationController::class, 'updateStatus'])->name('validation.update');
        Route::delete('/validation/{id}', [ValidationController::class, 'destroy'])->name('validation.destroy');


        Route::resource('inventory', InventoryController::class)->except(['show']);
        Route::get('sales-orders', [SalesOrderController::class, 'index'])->name('sales-orders.index');
        Route::get('sales-orders/{order}', [SalesOrderController::class, 'show'])->name('sales-orders.show');
        Route::patch('sales-orders/{order}/ship', [SalesOrderController::class, 'ship'])->name('sales-orders.ship');
        Route::patch('sales-orders/{order}/receive', [SalesOrderController::class, 'receive'])->name('sales-orders.receive');
        Route::delete('sales-orders/{order}', [SalesOrderController::class, 'destroy'])->name('sales-orders.destroy');
        Route::get('sales-report', [SalesReportController::class, 'index'])->name('sales-report');
        Route::get('sales-history', [SalesOrderController::class, 'history'])->name('sales-history');
    });

    Route::middleware(['auth'])->group(function () {
        Route::get('/packages', [PackageController::class, 'index'])->name('packages.index');
        Route::post('/packages/select', [PackageController::class, 'select'])->name('packages.select');
        Route::get('/packages/agreement', [PackageController::class, 'agreement'])->name('packages.agreement');
        Route::post('/packages/agreement', [PackageController::class, 'submitAgreement'])->name('packages.submitAgreement');
    });
});

Route::prefix('profile')->middleware('auth')->group(function () {
    Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Franchisee Routes
Route::middleware(['auth'])->group(function () {
    Route::get('orders/create', [PurchaseOrderController::class, 'create'])->name('orders.create');
    Route::post('orders', [PurchaseOrderController::class, 'store'])->name('orders.store');
    Route::get('orders', [PurchaseOrderController::class, 'index'])->name('orders.index');
    Route::get('orders/status', [PurchaseOrderController::class, 'status'])->name('orders.status');
    Route::patch('orders/{order}/receive', [PurchaseOrderController::class, 'receive'])->name('orders.receive');
    Route::get('/history', [PurchaseOrderController::class, 'history'])->name('orders.history');
    Route::get('/orders/{order}', [PurchaseOrderController::class, 'show'])->name('orders.show');
});

Route::get('/user-dashboard', function () {
    return view('dashboard'); // Or the appropriate user dashboard view
})->name('user.dashboard')->middleware('auth');

Route::get('/admin-dashboard', function () {
    return redirect()->route('adminhome');
})->name('admin.dashboard')->middleware('auth', 'admin');

require __DIR__.'/auth.php';
