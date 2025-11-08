<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\DashboardBookingController;
use App\Http\Controllers\DashboardCalendarController;
use App\Http\Controllers\DashboardDetailsPackageController;
use App\Http\Controllers\DashboardHonorController;
use App\Http\Controllers\DashboardOrderController;
use App\Http\Controllers\DashboardPackageController;
use App\Http\Controllers\DashboardPenugasanController;
use App\Http\Controllers\DashboardPMuaProfileController;
use App\Http\Controllers\DashboardPortfolioController;
use App\Http\Controllers\DashboardRegisterController;
use App\Http\Controllers\DetailsMakeUpController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MuaProfileController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PackageMakeUpController;
use App\Http\Controllers\PortofolioController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserProfileController;
use App\Models\Booking;
use Database\Factories\BookingFactory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('homepage');
});

Route::get('/dashboard', function(){
    return view('admin.layouts.home');
})-> middleware('auth');

Route::get('/makeupbyrani', function () {
    return view('homepage');
})-> middleware('auth');

Route::fallback(function(){
    return view('notfound');
});

Route::get('/register', [RegisterController::class, 'index']);
Route::resource('/register', RegisterController::class);
Route::resource('/dashboard-register', DashboardRegisterController::class)-> middleware('auth');


Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);

Route::resource('/ourprofile', MuaProfileController::class);
Route::resource('/dashboard-profile', DashboardPMuaProfileController::class)-> middleware('auth');

Route::get('/details', function () {
    return view('layouts.detail_profile');
});

Route::get('/package', [PackageMakeUpController::class, 'index']);
Route::resource('/package', PackageMakeUpController::class);
Route::resource('/dashboard-package', DashboardPackageController::class)-> middleware('auth');

Route::resource('/details_package', DetailsMakeUpController::class);
Route::resource('/dashboard-details_package', DashboardDetailsPackageController::class)-> middleware('auth');
Route::get('/dashboard-details_package/create/{packageId}', [DashboardDetailsPackageController::class, 'create'])
     ->name('dashboard-details_package.create')-> middleware('auth');

Route::resource('/account', UserProfileController::class)-> middleware('auth');

Route::resource('/portfolio', PortofolioController::class);
Route::resource('/dashboard-portfolio', DashboardPortfolioController::class)-> middleware('auth');

Route::middleware('auth')->group(function () {
    Route::resource('booking', BookingController::class)-> middleware('auth');
});
Route::get('/booking/details/{paketId}', [BookingController::class, 'showDetails']);

Route::resource('/calendar', CalendarController::class)-> middleware('auth');
Route::resource('/dashboard-calendar', DashboardCalendarController::class)-> middleware('auth');
Route::get('/calendar/showAll', [CalendarController::class, 'showAll']);

Route::post('/booking/{bookingId}/payment', [BookingController::class, 'payment'])->name('booking.payment');

Route::get('/booking/price/{jenis_paketId}', [BookingController::class, 'getPrice']);

// Route untuk halaman order
Route::get('/order', [OrderController::class, 'index'])->name('order.index');
Route::resource('/dashboard-order', DashboardOrderController::class)-> middleware('auth');
Route::get('/dashboard/orders/{id}', [DashboardOrderController::class, 'show'])->name('dashboard-order.show');
Route::delete('/dashboard-order/{id}', [DashboardOrderController::class, 'destroy'])->name('dashboard-order.destroy');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::prefix('dashboard-order')->group(function () {
    Route::patch('{id}/confirm-payment', [DashboardOrderController::class, 'confirmPayment'])->name('dashboard-order.confirmPayment');
    Route::patch('{id}/reject-payment', [DashboardOrderController::class, 'rejectPayment'])->name('dashboard-order.rejectPayment');
});


Route::get('/notifications', [BookingController::class, 'getNotifications'])->name('notifications');
Route::resource('/dashboard-booking', DashboardBookingController::class)-> middleware('auth');
Route::get('/dashboard-booking/{id}', [DashboardBookingController::class, 'show'])->name('dashboard-booking.show');

Route::get('/penugasan/{id}', [DashboardPenugasanController::class, 'index'])->name('penugasan.index');
Route::post('/penugasan/store/{id}', [DashboardPenugasanController::class, 'store'])->name('penugasan.store');

Route::get('/dashboard-assign', [DashboardPenugasanController::class, 'show'])->name('dashboard-assign.show');
Route::delete('/dashboard-assign/{id}', [DashboardPenugasanController::class, 'destroy'])->name('dashboard-assign.destroy');

Route::resource('/dashboard-honor', DashboardHonorController::class)-> middleware('auth');
Route::resource('/order-history', HistoryController::class)-> middleware('auth');

Route::post('/dashboard-assign/{id}/mark-completed', [DashboardPenugasanController::class, 'markAsCompleted'])
    ->name('dashboard-assign.mark-completed');
Route::get('/admin/honor/filter', [DashboardHonorController::class, 'filter'])->name('admin.honor.filter');
Route::get('/cetak-pdf/honor', [DashboardHonorController::class, 'cetakHonorPdf'])->name('cetak.honor.pdf');
Route::get('/cetak-pdf/order', [DashboardHonorController::class, 'cetakOrderPdf'])->name('cetak.order.pdf');
Route::post('/dashboard-honor/{id}/upload-payment', [DashboardHonorController::class, 'uploadPayment'])->name('dashboard-honor.upload-payment');

Route::get('/dashboard-assign/{id}/edit', [DashboardPenugasanController::class, 'edit'])->name('dashboard-assign.edit');
Route::put('/dashboard-assign/{id}', [DashboardPenugasanController::class, 'update'])->name('dashboard-assign.update');

Route::get('/dashboard', [HomeController::class, 'index'])
    ->middleware('auth')
    ->name('admin.layouts.home');
// Route untuk mengakses halaman pembayaran
// Route::post('/payment', [PaymentController::class, 'store'])->name('payment.store');
// Route::get('/payment/{id}', [PaymentController::class, 'create'])->name('payment.create');

// Route::get('/payment/{bookingId}', [BookingController::class, 'showPaymentForm']);












