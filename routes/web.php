<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\GroupController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\DepartamentController;

Route::get('/login', [AuthController::class, 'loginView'])->name('login');
Route::post('/auth/login', [AuthController::class, 'login'])->name('login-auth');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('departaments/', [DepartamentController::class, 'index'])->name('departament.index');
    Route::post('departament/create', [DepartamentController::class, 'create'])->name('departament.create');
    Route::get('departament/filter', [DepartamentController::class, 'filter'])->name('departament.filter');
    Route::get('/groups', [GroupController::class, 'index'])->name('group.index');
    Route::get('/add-group', [GroupController::class, 'create'])->name('groups.create');
    Route::post('/group-create', [GroupController::class, 'store'])->name('group.store');
    Route::post('/group-destroy', [GroupController::class, 'destroy'])->name('group.destroy');
    Route::put('/group-update/{group}', [GroupController::class, "updateGroup"])->name("group.update");
    Route::get('/courses', [CourseController::class, 'courses'])->name('courses.index');
    });







//StudentController Routes

Route::middleware(['auth', 'role:student'])->get('/', [StudentController::class, 'dashboard'])->name('dashboard_student');