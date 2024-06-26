<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\InvitationController;
use App\Http\Controllers\Pos\PosController;
use App\Http\Controllers\Admin\Category\CategoryController;
use App\Http\Controllers\Admin\Brand\BrandController;
use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Admin\Event\ConfigurationEventController;
use App\Http\Controllers\Admin\Event\EventController;
use App\Http\Controllers\Admin\Product\ProductController;
use App\Http\Controllers\Admin\Subcategory\SubcategoryController;
use App\Http\Controllers\Admin\Training\TrainingController;

use App\Http\Controllers\Admin\Event\EventCalendarController;


Route::get('', [HomeController::class, 'index'])->name('home');

Route::resource('dashboard',DashboardController::class)->names('dashboard');
Route::resource('training',TrainingController::class)->names('training');

Route::resource('users',UserController::class)->names('users');
Route::resource('invitations',InvitationController::class)->names('invitations');
// IMPORTANTE: La ruta de tipo resource, genera las 7 rutas necesarias para hacer un CRUD COMPLETO
// la SEGURIDAD DE PERMISOS se maneja desde su controlador, usando __constructor()
Route::resource('roles',RoleController::class)->names('roles');

// MASTER CLASS - NUNCA OLVIDES USAR EL COMANDO (php artisan route:list), para checar tus rutas y asi hacer tus ajustes
// Se agrego este nuevo metodo (files) a una ruta resource, se antepone a esta como se muestra aqui abajo
Route::get('sections/{invitation}/edit_sections', [SectionController::class,'edit_sections'])->name('sections.edit_sections');
Route::get('sections/{invitation}/create_sections', [SectionController::class,'create_sections'])->name('sections.create_sections');
Route::post('sections/{invitation}/store_sections', [SectionController::class,'store_sections'])->name('sections.store_sections');
Route::get('sections/{section}/edit_section/{invitation}', [SectionController::class,'edit_section'])->name('sections.edit_section');
Route::put('sections/{section}/update_section/{invitation}', [SectionController::class,'update_section'])->name('sections.update_section');
Route::get('sections/{section}/select_files', [SectionController::class,'select_files'])->name('sections.select_files');
Route::post('sections/{section}/save_files', [SectionController::class,'save_files'])->name('sections.save_files');
Route::resource('sections',SectionController::class)->names('sections');

// POS

Route::get('pos/order/{user}/index', [PosController::class,'index'])->name('pos.index');
Route::get('pos/order/prninvoice/{transaction_id}', [PosController::class,'prninvoice'])->name('pos.prninvoice');



Route::resource('brands', BrandController::class)->names('brands');
Route::resource('categories', CategoryController::class)->names('categories');
Route::resource('subcategories', SubcategoryController::class)->names('subcategories');


// Events
//Route::resource('schedules', ScheduleController::class)->names('schedules');   NO SE USA, SE CAMBIO POR EVENT
Route::resource('events', EventController::class)->names('events');
Route::get('events/{event_id}/print_report', [EventController::class,'print_report'])->name('events.print_report');
Route::get('configuration/event', [ConfigurationEventController::class,'index'])->name('configuration.event.index');
Route::get('schedule', [EventCalendarController::class,'index'])->name('schedule.index');

// Route::get('products/index/{brand?}/{category?}', [ProductController::class,'index'])->middleware('can:Product Index')->name('products.index'); ORIGINAL
Route::get('products/index/{brand?}/{category?}', [ProductController::class,'index'])->name('products.index'); //TEMPORAL

