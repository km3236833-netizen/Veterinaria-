<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\DuenoController;
use App\Http\Controllers\MascotaController;
use Illuminate\Support\Facades\Route;

Route::redirect('/login', '/');

Route::middleware("guest")->group(function () {
    Route::get('/', [AuthController::class, 'index'])->name('login');
    Route::post('/logear', [AuthController::class, 'logear'])->name('logear');
});

Route::middleware("auth")->group(function () {
    Route::get('/home', [AuthController::class, 'home'])->name('home');
    Route::get('/expedientes', [AuthController::class, 'expedientes'])->name('expedientes');
    
    // Rutas para Dueños y Mascotas
    Route::resource('/duenos', DuenoController::class)->names('duenos');
    Route::resource('/mascotas', MascotaController::class)->names('mascotas');
    
    Route::get('/admin/home', [AuthController::class, 'adminHome'])->name('admin.home');
    Route::get('/admin/menu', [MenuController::class, 'index'])->name('admin.menu.index');
    Route::resource('/admin/usuarios', UserController::class)->names('admin.usuarios');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
