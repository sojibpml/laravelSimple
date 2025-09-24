<?php

use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

// Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
// Route::post('/login', [AuthController::class, 'login']);
// Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
// Route::post('/register', [AuthController::class, 'register']);
// Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route::middleware(['auth'])->group(function () {

//     Route::middleware(['role:admin'])->group(function () {
//         Route::get('/users', [UserController::class, 'index'])->name('users.index');
//         Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
//         Route::post('users', [UserController::class, 'store'])->name('users.store');
//         Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
//     });
//     Route::middleware(['role:admin|editor'])->group(function () {
//         Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
//         Route::put('users/{user}', [UserController::class, 'update'])->name('users.update');
//     });
// });




Route::get('/assign-admin', [AuthController::class, 'assignAdminRole']);
Route::get('/assign-roles/{id}', [AuthController::class, 'index'])->name('show.assign.roles');
Route::get("/show", [AuthController::class, "showAdmin"]);

