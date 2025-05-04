<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Notification\NotificationController;
use App\Http\Controllers\Profile\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\appointment\AppointmentController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Doctors\DoctorsController;
use App\Http\Controllers\events\EventController;
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

// Route::get('/settings', [SettingsController::class, 'settings'])->name('settings');

Route::get('/appointments/data', [App\Http\Controllers\appointment\AppointmentControllers::class, 'getAppointmentData']);

Route::get('/appointments/count', [AppointmentController::class, 'getAppointmentCount']);



// Admin Routes
Route::group(['middleware' => 'admin', 'prefix' =>'admin'], function () {
    // Admin Dashboard Route
    Route::get('/dashboard', [App\Http\Controllers\Admin\AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/settings', [SettingsController::class, 'settings'])->name('settings');

    // Admin Appointments Routes
    Route::prefix('appointments')->name('admin.appointments.')->group(function () {
        Route::get('/create', [AppointmentController::class, 'create'])->name('create');
        Route::get('/view', [AppointmentController::class, 'viewAppointments'])->name('view');
        Route::post('/{id}/update-status/{status}', [AppointmentController::class, 'updateStatus'])->name('updateStatus');

        //DELETE route
        Route::delete('/{appointment}', [AppointmentController::class, 'destroy'])->name('destroy');
    });


    // Admin Doctors Routes
    Route::prefix('/doctors')->name('admin.doctors.')->group(function () {
        Route::get('/', [DoctorsController::class, 'index'])->name('index');
        Route::get('/create', [DoctorsController::class, 'create'])->name('create');
        Route::get('/view', [DoctorsController::class, 'view'])->name('view');
        Route::post('/store', [DoctorsController::class, 'store'])->name('store');
        Route::delete('/destroy/{doctor}', [DoctorsController::class, 'destroy'])->name('destroy');
        Route::put('/update/{doctor}', [DoctorsController::class, 'update'])->name('update');
        Route::get('/edit/{doctor}', [DoctorsController::class, 'edit'])->name('edit');
        Route::get('/list', [DoctorsController::class, 'list'])->name('list');
    });

    // Admin Account Routes
    Route::prefix('/accounts')->name('admin.accounts.')->group(function () {
        Route::get('/profile', [AdminController::class, 'showProfile'])->name('profile');
        Route::get('/profile/edit', [AdminController::class, 'editProfile'])->name('profile.edit');
        Route::put('/profile/edit', [AdminController::class, 'updateProfile'])->name('profile.update'); // Add PUT route for updating profile
    });

    // Log Route
    Route::prefix('/misc')->name('admin.misc.')->group(function () {
        Route::get('/showlogs', [AdminController::class, 'showLogs'])->name('logs'); // Corrected route name
    });

    //Creating Events
    Route::prefix('/events')->name('admin.events.')->group(function () {
        Route::get('/create', [EventController::class, 'createEvent'])->name('create');
        Route::post('/store', [EventController::class, 'store'])->name('store'); // Ensure only POST is allowed
        Route::get('/view', [EventController::class, 'viewEvents'])->name('view');
        Route::post('/{id}', [EventController::class, 'destroy'])->name('destroy');
        Route::delete('/{id}', [EventController::class, 'destroy'])->name('destroy');
    });
});

// User Routes
Route::group(['middleware' => ['auth']], function () {
    Route::get('/user/home', function () {
        return view('user.dashboard');
    })->name('user.dashboard');

    Route::get('/user/settings', [SettingsController::class, 'userSettings'])->name('user.settings');

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
    });

    // Show logs User Route
    Route::prefix('user/misc')->name('user.misc.')->group(function () {
        Route::get('/showlogs', [UsersController::class, 'showLogs'])->name('logs');
    });

    // User Events Routes
    Route::prefix('user/events')->name('user.events.')->group(function () {
        Route::get('/view/{notificationId?}', [EventController::class, 'view'])->name('view');
    });


    // Routes for notifications
    Route::prefix('user/notifications')->name('user.notifications.')->group(function () {
        Route::get('/mark-read/{id}', [NotificationController::class, 'markRead'])->name('markRead');
        Route::get('/mark-all-read', [NotificationController::class, 'markAllRead'])->name('markAllRead');
    });
});
