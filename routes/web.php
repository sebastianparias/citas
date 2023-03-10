<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\AppointmentController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
  return view('index');
})->name('index');

Route::delete('clientes/{id}', [CustomerController::class, 'destroy'])->name('customers.destroy');
Route::get('clientes', [CustomerController::class, 'index'])->name('customers.index');
Route::get('clientes/{id}/editar', [CustomerController::class, 'edit'])->name('customers.edit');
Route::get('clientes/crear', [CustomerController::class, 'create'])->name('customers.create');
Route::post('clientes', [CustomerController::class, 'store'])->name('customers.store');
Route::put('clientes/{id}', [CustomerController::class, 'update'])->name('customers.update');


Route::delete('mascotas/{id}', [PetController::class, 'destroy'])->name('pets.destroy');
Route::get('mascotas', [PetController::class, 'index'])->name('pets.index');
Route::get('mascotas/{id}/editar', [PetController::class, 'edit'])->name('pets.edit');
Route::get('mascotas/crear', [PetController::class, 'create'])->name('pets.create');
Route::post('mascotas', [PetController::class, 'store'])->name('pets.store');
Route::put('mascotas/{id}', [PetController::class, 'update'])->name('pets.update');

Route::delete('citas/{id}', [AppointmentController::class, 'destroy'])->name('appointments.destroy');
Route::get('citas', [AppointmentController::class, 'index'])->name('appointments.index');
Route::get('citas/{id}/editar', [AppointmentController::class, 'edit'])->name('appointments.edit');
Route::get('citas/crear/{mascota?}', [AppointmentController::class, 'create'])->name('appointments.create');
Route::post('citas', [AppointmentController::class, 'store'])->name('appointments.store');
Route::put('citas/{id}', [AppointmentController::class, 'update'])->name('appointments.update');

Route::get('fullcalendar', [AppointmentController::class, 'getAll'])->name('appointments.getAll');