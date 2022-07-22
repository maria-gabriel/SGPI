<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatAccesosController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\contraresController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\DireccionController;
use App\Http\Controllers\SubdireccionController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\TareaController;
use App\Http\Controllers\SubtareaController;
use App\Http\Controllers\ProyectoController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/contrares', [contraresController::class,'index'])->name('contrares');
Route::post('contrares', [contraresController::class,'actua'])->name('actua');

Auth::routes();
Route::group(['namespace'=>'admin', 'middleware' => 'val_acceso'],function(){

    Route::post('detalles/subdireccion', [SubdireccionController::class,'details'])->name('subdirecciones.details');
    Route::post('detalles/departamento', [DepartamentoController::class,'details'])->name('departamentos.details');

    Route::post('crud/tarea', [TareaController::class,'crud'])->name('tareas.crud');
    Route::get('create/tarea/{proyecto}', [TareaController::class,'create'])->name('tareas.create');
    Route::get('tareas', [TareaController::class,'index'])->name('tareas.index');
    
    Route::post('crud/subtarea', [SubtareaController::class,'crud'])->name('subtareas.crud');
    Route::get('create/subtarea/{tarea}', [SubtareaController::class,'create'])->name('subtareas.create');
    Route::get('subtareas', [SubtareaController::class,'index'])->name('subtareas.index');

    Route::post('crud/proyecto', [ProyectoController::class,'crud'])->name('proyectos.crud');
    Route::get('grafica/proyecto/{proyecto}', [ProyectoController::class,'graphic'])->name('proyectos.graphic');
    Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('accesos',[CatAccesosController::class,'index'])->name('accesos.index');
    Route::get('create',[CatAccesosController::class,'create'])->name('accesos.create');
    Route::post('acceso', [CatAccesosController::class,'store'])->name('accesos.store');
    Route::get('acceso/{acceso}', [CatAccesosController::class,'show'])->name('accesos.show');
    Route::put('acceso/{acceso}', [CatAccesosController::class,'update'])->name('accesos.update');
    Route::get('acceso/{acceso}/inactivar', [CatAccesosController::class,'inactivar'])->name('accesos.inactivar');
    Route::get('acceso/{acceso}/activar', [CatAccesosController::class,'activar'])->name('accesos.activar');

    Route::get('direcciones',[DireccionController::class,'index'])->name('direcciones.index');
    Route::get('create/direccion',[DireccionController::class,'create'])->name('direcciones.create');
    Route::get('edit/{direccion}/direccion',[DireccionController::class,'create'])->name('direcciones.edit');
    Route::post('guardar/direccion/{direccion?}', [DireccionController::class,'store'])->name('direcciones.store');
    Route::get('direcciones/activar/{direccion}', [DireccionController::class,'activar'])->name('direcciones.activar');
    Route::get('direcciones/inactivar/{direccion}', [DireccionController::class,'inactivar'])->name('direcciones.inactivar');

    Route::get('subdirecciones',[SubdireccionController::class,'index'])->name('subdirecciones.index');
    Route::get('create/subdireccion',[SubdireccionController::class,'create'])->name('subdirecciones.create');
    Route::get('edit/{subdireccion}/subdireccion',[SubdireccionController::class,'create'])->name('subdirecciones.edit');
    Route::post('guardar/subdireccion/{subdireccion?}', [SubdireccionController::class,'store'])->name('subdirecciones.store');
    Route::get('subdirecciones/activar/{subdireccion}', [SubdireccionController::class,'activar'])->name('subdirecciones.activar');
    Route::get('subdirecciones/inactivar/{subdireccion}', [SubdireccionController::class,'inactivar'])->name('subdirecciones.inactivar');

    Route::get('departamentos',[DepartamentoController::class,'index'])->name('departamentos.index');
    Route::get('create/departamento',[DepartamentoController::class,'create'])->name('departamentos.create');
    Route::get('edit/{departamento}/departamento',[DepartamentoController::class,'create'])->name('departamentos.edit');
    Route::post('guardar/departamento/{departamento?}', [DepartamentoController::class,'store'])->name('departamentos.store');
    Route::get('departamentos/activar/{departamento}', [DepartamentoController::class,'activar'])->name('departamentos.activar');
    Route::get('departamentos/inactivar/{departamento}', [DepartamentoController::class,'inactivar'])->name('departamentos.inactivar');

    Route::get('create/admin/admin',[AdminController::class,'create'])->name('admins.create');
    Route::get('admins/activar/{admin}', [AdminController::class,'activar'])->name('admins.activar');
    Route::get('admins/activartec/{admin}', [AdminController::class,'activartec'])->name('admins.activartec');
    Route::get('admins/inactivar/{admin}', [AdminController::class,'inactivar'])->name('admins.inactivar');
    Route::get('admins/asistio/{admin}', [AdminController::class,'asistio'])->name('admins.asistio');
    Route::get('admins/noasistio/{admin}', [AdminController::class,'noasistio'])->name('admins.noasistio');
    Route::get('admins/disponible/{admin}', [AdminController::class,'disponible'])->name('admins.disponible');
    Route::get('admins/nodisponible/{admin}', [AdminController::class,'nodisponible'])->name('admins.nodisponible');
    Route::get('admins',[AdminController::class,'index'])->name('admins.index');
    Route::post('guardar/admin', [AdminController::class,'store'])->name('admins.store');
    Route::get('admins/asignar/{admin}', [AdminController::class,'asignar'])->name('admins.asignar');
    Route::post('admins/usuario/{admin}', [AdminController::class,'cuenta'])->name('admins.cuenta');

    Route::get('usuarios',[UserController::class,'index'])->name('usuarios.index');
    Route::get('usuarios/perfil',[UserController::class,'perfil'])->name('usuarios.perfil');
    Route::get('usuarios/inactivar/{usuario}', [UserController::class,'inactivar'])->name('usuarios.inactivar');
    Route::get('usuarios/{usuario}', [UserController::class,'activar'])->name('usuarios.activar');
    Route::post('usuarios/custom', [UserController::class,'custom'])->name('usuarios.custom');
    Route::post('editar/{usuario}', [UserController::class,'store'])->name('usuarios.store');
    Route::get('show/{usuario}', [UserController::class,'show'])->name('usuarios.show');
    Route::get('create/usuarios/usuario', [UserController::class,'create'])->name('usuarios.create');
    Route::get('area/usuarios/usuario', [UserController::class,'area'])->name('usuarios.area');
    Route::post('usuarios/update/{usuario}', [UserController::class,'update'])->name('usuarios.update');
    Route::post('usuarios/update2/{usuario}', [UserController::class,'update_area'])->name('usuarios.update2');

    Route::get('pdf/orden/{orden}', [PDFController::class,'generatePDF'])->name('pdf.show');

});