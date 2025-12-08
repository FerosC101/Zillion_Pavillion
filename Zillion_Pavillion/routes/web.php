<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ClientController as AdminClientController;
use App\Http\Controllers\Admin\StaffController as AdminStaffController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Staff\AuthController as StaffAuthController;
use App\Http\Controllers\Staff\DashboardController as StaffDashboardController;
use App\Http\Controllers\Staff\BookingController as StaffBookingController;
use App\Http\Controllers\ClientAuthController;
use App\Http\Controllers\ClientDashboardController;
use App\Http\Controllers\ClientServiceRequestController;
use App\Http\Controllers\QuickBookingController;

// Public routes
Route::get('/', function () {
    return view('home');
})->name('home');

// Quick booking from main website
Route::post('/quick-booking', [QuickBookingController::class, 'store'])->name('quick.booking.store');

// Unified Staff/Admin Login
Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');

// Admin routes with named login (for redirects)
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');

// Staff routes with named login (for redirects)
Route::get('/staff/login', [AdminAuthController::class, 'showLoginForm'])->name('staff.login');

// Client routes
Route::get('/client/login', [ClientAuthController::class, 'showLoginForm'])->name('client.login');
Route::post('/client/login', [ClientAuthController::class, 'login'])->name('client.login.submit');
Route::get('/register', [ClientAuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [ClientAuthController::class, 'register'])->name('register.submit');

Route::middleware(['client'])->prefix('client')->name('client.')->group(function () {
    Route::get('/dashboard', [ClientDashboardController::class, 'index'])->name('dashboard');
    
    // Bookings
    Route::get('/bookings', [ClientDashboardController::class, 'bookings'])->name('bookings.index');
    Route::get('/booking/new', [ClientDashboardController::class, 'createBooking'])->name('booking.create');
    Route::post('/booking', [ClientDashboardController::class, 'storeBooking'])->name('booking.store');
    Route::get('/booking/{booking}', [ClientDashboardController::class, 'showBooking'])->name('booking.show');
    Route::patch('/booking/{booking}/cancel', [ClientDashboardController::class, 'cancelBooking'])->name('booking.cancel');
    
    // Service Requests
    Route::get('/service-requests', [ClientServiceRequestController::class, 'index'])->name('service-requests.index');
    Route::get('/service-requests/create', [ClientServiceRequestController::class, 'create'])->name('service-requests.create');
    Route::post('/service-requests', [ClientServiceRequestController::class, 'store'])->name('service-requests.store');
    Route::get('/service-requests/{serviceRequest}', [ClientServiceRequestController::class, 'show'])->name('service-requests.show');
    Route::patch('/service-requests/{serviceRequest}/cancel', [ClientServiceRequestController::class, 'cancel'])->name('service-requests.cancel');
    
    // Profile
    Route::get('/profile', [ClientDashboardController::class, 'profile'])->name('profile');
    Route::patch('/profile', [ClientDashboardController::class, 'updateProfile'])->name('profile.update');
    
    // Logout
    Route::post('/logout', [ClientAuthController::class, 'logout'])->name('logout');
});

// Admin routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware(['admin'])->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
        
        // Client management
        Route::resource('clients', AdminClientController::class);
        
        // Staff management (admin manages staff accounts)
        Route::resource('staff', AdminStaffController::class);
        
        // Booking management
        Route::resource('bookings', AdminBookingController::class);
        
        // Service management
        Route::resource('services', AdminServiceController::class);
        
        // Room management
        Route::resource('rooms', App\Http\Controllers\Admin\RoomController::class);
        
        // Service Request management
        Route::resource('service-requests', App\Http\Controllers\Admin\ServiceRequestController::class);
    });
});

// Staff routes
Route::prefix('staff')->name('staff.')->group(function () {
    Route::middleware(['staff'])->group(function () {
        Route::get('/dashboard', [StaffDashboardController::class, 'index'])->name('dashboard');
        Route::post('/logout', [StaffAuthController::class, 'logout'])->name('logout');
        
        // Booking management (view only)
        Route::get('/bookings', [StaffBookingController::class, 'index'])->name('bookings.index');
        Route::get('/bookings/{booking}', [StaffBookingController::class, 'show'])->name('bookings.show');
        Route::post('/bookings/{booking}/status', [StaffBookingController::class, 'updateStatus'])->name('bookings.updateStatus');
    });
});

