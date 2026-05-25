<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\DuenoController;
use App\Http\Controllers\MascotaController;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\TratamientoController;
use Illuminate\Support\Facades\Route;

Route::redirect('/login', '/');

Route::middleware("guest")->group(function () {
    Route::get('/', [AuthController::class, 'index'])->name('login');
    Route::post('/logear', [AuthController::class, 'logear'])->name('logear');
});

Route::middleware("auth")->group(function () {
    Route::get('/home', [AuthController::class, 'home'])->name('home');
    Route::get('/expedientes', [AuthController::class, 'expedientes'])->name('expedientes');
    
    // Rutas para Dueños, Mascotas y Consultas (Diagnósticos)
    Route::resource('/duenos', DuenoController::class)->names('duenos');
    Route::resource('/mascotas', MascotaController::class)->names('mascotas');
    Route::resource('/consultas', ConsultaController::class)->except(['show'])->names('consultas');

    // Rutas para sub-recursos de Mascota (Alergias, Lesiones, Patologías, Alimentación)
    Route::post('/mascotas/{mascota}/alergias', [MascotaController::class, 'storeAlergia'])->name('mascotas.alergias.store');
    Route::delete('/alergias/{alergia}', [MascotaController::class, 'destroyAlergia'])->name('alergias.destroy');

    Route::post('/mascotas/{mascota}/lesiones', [MascotaController::class, 'storeLesion'])->name('mascotas.lesiones.store');
    Route::delete('/lesiones/{lesion}', [MascotaController::class, 'destroyLesion'])->name('lesiones.destroy');

    Route::post('/mascotas/{mascota}/patologias', [MascotaController::class, 'storePatologia'])->name('mascotas.patologias.store');
    Route::delete('/patologias/{patologia}', [MascotaController::class, 'destroyPatologia'])->name('patologias.destroy');

    Route::post('/mascotas/{mascota}/alimentacion', [MascotaController::class, 'storeAlimentacion'])->name('mascotas.alimentacion.store');
    Route::delete('/alimentacion/{alimentacion}', [MascotaController::class, 'destroyAlimentacion'])->name('alimentacion.destroy');

    // Ruta para detalle de consulta: /consultas/{consulta}/detalle?mascota={id}
    Route::get('/consultas/{consulta}/detalle', [ConsultaController::class, 'detalle'])->name('consultas.detalle');
    Route::get('/consultas/{consulta}/pdf', [ConsultaController::class, 'pdf'])->name('consultas.pdf');

    // Rutas para Tratamientos (Independientes)
    Route::get('/tratamientos/{tratamiento}/pdf', [TratamientoController::class, 'pdf'])->name('tratamientos.pdf');
    Route::resource('/tratamientos', TratamientoController::class)->names('tratamientos');

    // Rutas protegidas solo para Administradores
    Route::group(['middleware' => [
        function ($request, $next) {
            if (auth()->user()->rol !== 'administrador') {
                return redirect()->route('home')->with('error', 'No tienes permisos de administrador para acceder a esta sección.');
            }
            return $next($request);
        }
    ]], function () {
        Route::get('/admin/home', [AuthController::class, 'adminHome'])->name('admin.home');
        Route::get('/admin/menu', [MenuController::class, 'index'])->name('admin.menu.index');
        Route::resource('/admin/usuarios', UserController::class)->names('admin.usuarios');
    });

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
