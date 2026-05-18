<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\GroupController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\DepartamentController;
use App\Http\Controllers\Admin\SemestrController;

Route::get('/login', [AuthController::class, 'loginView'])->name('login');
Route::post('/auth/login', [AuthController::class, 'login'])->name('login-auth');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('departaments/', [DepartamentController::class, 'index'])->name('departament.index');
    Route::post('departament/create', [DepartamentController::class, 'create'])->name('departament.create');
    Route::get('departament/filter', [DepartamentController::class, 'filter'])->name('departament.filter');
    Route::put('departament/update/{departament}', [DepartamentController::class, 'update'])->name('departament.update');
    Route::post('/departament/destroy{id}', [DepartamentController::class, 'destroy'])->name('departament.destroy');
    Route::get('/groups', [GroupController::class, 'index'])->name('group.index');
    Route::get('/add-group', [GroupController::class, 'create'])->name('groups.create');
    Route::post('/group-create', [GroupController::class, 'store'])->name('group.store');
    Route::post('/group-destroy', [GroupController::class, 'destroy'])->name('group.destroy');
    Route::put('/group-update/{group}', [GroupController::class, "updateGroup"])->name("group.update");
    Route::get('group/filter', [GroupController::class, 'filter'])->name('group.filter');
    Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
    Route::get('/course/create', [CourseController::class, 'create'])->name('course.create');
    Route::post('/course/store', [CourseController::class, 'store'])->name('course.store');
    Route::get('course/filter', [CourseController::class, 'filter'])->name('course.filter');
    Route::get('semesters/', [SemestrController::class, 'index'])->name('semester.index');
    Route::post('semester/create', [SemestrController::class, 'create'])->name('semester.create');
    Route::put('semester/update', [SemestrController::class, 'update'])->name('semester.update');
    Route::post('semester/delete/{id}', [SemestrController::class, 'destroy'])->name('semester.destroy');
    });

//StudentController Routes

Route::middleware(['auth', 'role:student'])->get('/', [StudentController::class, 'dashboard'])->name('dashboard_student');