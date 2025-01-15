<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminEventController;
use App\Http\Controllers\Admin\TalkController;
use App\Http\Controllers\Admin\AttendanceController;


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
/**
 * Rutas públicas
 */
Route::get('/', WelcomeController::class);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/events/{event}/program', [EventController::class, 'showProgram'])
     ->name('event.program');

/**
 * fin rutas públicas
 */

 /**
  * Middlewares
  */
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/**
 * fin Middlewares
 */

/**
 * rutas para administración
 */
Route::middleware(['auth'])->prefix('admin')->group(function () {
    // Dashboard de administración
    Route::get('/', [HomeController::class, 'index'])->name('admin.index');

    // ususarios
    Route::resource('users', UserController::class)
    ->names('admin.users');

    // CRUD de eventos
    Route::resource('/events', AdminEventController::class)
    ->names('admin.events');

    // CRUD de charlas (Talks)
    Route::resource('/talks', TalkController::class)
    ->names('admin.talks');
    Route::get('/talks/create/{event?}', [TalkController::class, 'create'])
    ->name('admin.talks.create');

    Route::get('talks/{talk}/qr', [TalkController::class, 'showQr'])
    ->name('admin.talks.qr');

});

// Ruta pública para marcar asistencia
Route::get('/attendance/{code}', [AttendanceController::class, 'markAttendance'])
    ->name('attendance.mark')
    ->middleware('auth');


Route::get('/clear', function() {
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('event:clear');
    Artisan::call('clear-compiled');
    return "Cache is cleared";
});

Route::get('/symlink', function () {
    Artisan::call('storage:link');
    return 'The storage link has been created!';
});

require __DIR__.'/auth.php';
