<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\UserController;

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('admin.index');

    
});
