<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Notification\NotificationController;
use App\Http\Controllers\Profile\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\appointment\AppointmentController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Doctors\DoctorsController;
use App\Http\Controllers\Setting\SettingsController;
use App\Http\Controllers\User\UsersController;

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
Route::get('/', function () {
    $title = config('app.name', 'Advance Health Management System');
    return view('welcome', ['title' => $title]);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/maintenance', function () {
    return view('maintenance.maintenance');
})->name('maintenance');

Route::get('/settings', [SettingsController::class, 'settings'])->name('settings');

// Admin Routes
Route::group(['middleware' => ['auth', 'admin']], function () {
    // Admin Dashboard Route
    Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/settings', [SettingsController::class, 'settings'])->name('settings');

    // Admin Appointments Routes
    Route::prefix('admin/appointments')->name('admin.appointments.')->group(function () {
        Route::get('/create', [AppointmentController::class, 'create'])->name('create');
        Route::get('/view', [AppointmentController::class, 'viewAppointments'])->name('view');
        Route::post('/{id}/update-status/{status}', [AppointmentController::class, 'updateStatus'])->name('updateStatus');
    });

    // Admin Doctors Routes
    Route::prefix('admin/doctors')->name('admin.doctors.')->group(function () {
        Route::get('/', [DoctorsController::class, 'index'])->name('index');
        Route::get('/create', [DoctorsController::class, 'create'])->name('create');
        Route::get('/view', [DoctorsController::class, 'view'])->name('view');
        Route::post('/store', [DoctorsController::class, 'store'])->name('store');
        Route::delete('/destroy/{doctor}', [DoctorsController::class, 'destroy'])->name('destroy');
        Route::put('/update/{doctor}', [DoctorsController::class, 'update'])->name('update');
        Route::get('/edit/{doctor}', [DoctorsController::class, 'edit'])->name('edit');
    });

    // Admin Account Routes
    Route::prefix('admin/accounts')->name('admin.accounts.')->group(function () {
        Route::get('/profile', [AdminController::class, 'showProfile'])->name('profile');
    });
});

// User Routes
Route::group(['middleware' => ['auth']], function () {
    Route::get('/user/home', function () {
        return view('user.dashboard');
    })->name('user.dashboard');

    Route::get('/settings', [SettingsController::class, 'settings'])->name('settings');

    // User Appointments Routes
    Route::prefix('user/appointments')->name('user.appointments.')->group(function () {
        Route::get('/create', [UsersController::class, 'create'])->name('create');
        Route::post('/store', [UsersController::class, 'store'])->name('store');
        Route::get('/view', [AppointmentController::class, 'showDashboard'])->name('view');
        Route::get('/calendar', [AppointmentController::class, 'calendar'])->name('calendar');
        Route::get('/doctor/{id}', [DoctorsController::class, 'show'])->name('show');
    });

    // User Account Routes
    Route::prefix('user/account')->name('user.account.')->group(function () {
        Route::get('/profile', [UsersController::class, 'showProfile'])->name('profile');
        Route::get('/appointments/{userId}/{appointmentIndex?}', [AppointmentController::class, 'showAppointments'])->name('appointments');
        Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
        Route::post('/update-avatar', [ProfileController::class, 'updateAvatar'])->name('user.avatar.update');
        Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    });
});

