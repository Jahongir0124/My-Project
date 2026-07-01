<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\GroupController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\DepartamentController;
use App\Http\Controllers\Admin\SemestrController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\StudentManagamentController;
use App\Http\Controllers\Admin\TeacherManagementController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\Admin\ShiftController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ExamAttempController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\TaskAnswerController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TeacherController;
use App\Models\Exam;

Route::get('/', [AuthController::class, 'loginView'])->name('login');
Route::post('/auth/login', [AuthController::class, 'login'])->name('login-auth');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// Admin Routes
Route::middleware(['auth', 'lang', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('departaments/', [DepartamentController::class, 'index'])->name('departament.index');
    Route::post('departament/create', [DepartamentController::class, 'create'])->name('departament.create');
    Route::get('departament/filter', [DepartamentController::class, 'filter'])->name('departament.filter');
    Route::put('departament/update/{departament}', [DepartamentController::class, 'update'])->name('departament.update');
    Route::post('/departament/destroy{id}', [DepartamentController::class, 'destroy'])->name('departament.destroy');
    Route::get('departament/json', [DepartamentController::class, 'json'])->name('departament.json');
    Route::get('/groups', [GroupController::class, 'index'])->name('group.index');
    Route::get('/add-group', [GroupController::class, 'create'])->name('groups.create');
    Route::post('/group-create', [GroupController::class, 'store'])->name('group.store');
    Route::post('/group-destroy', [GroupController::class, 'destroy'])->name('group.destroy');
    Route::put('/group-update', [GroupController::class, "update"])->name("group.update");
    Route::get('group/filter', [GroupController::class, 'filter'])->name('group.filter');
    Route::get('group/json', [GroupController::class, 'json'])->name('group.json');
    Route::post('group/semester/store', [GroupController::class, 'createGroupSemester'])->name('group.semester');
    Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
    Route::get('/course/create', [CourseController::class, 'create'])->name('course.create');
    Route::post('/course/store', [CourseController::class, 'store'])->name('course.store');
    Route::get('course/filter', [CourseController::class, 'filter'])->name('course.filter');
    Route::put('course/update', [CourseController::class, 'update'])->name('course.update');
    Route::post('course/delete/{id}', [CourseController::class, 'destroy'])->name('course.destroy');
    Route::get('semesters/', [SemestrController::class, 'index'])->name('semester.index');
    Route::post('semester/create', [SemestrController::class, 'create'])->name('semester.create');
    Route::put('semester/update', [SemestrController::class, 'update'])->name('semester.update');
    Route::post('semester/delete/{id}', [SemestrController::class, 'destroy'])->name('semester.destroy');
    Route::get('semester/json', [SemestrController::class, 'json'])->name('semester.json');
    Route::get('semester/usedSemester', [SemestrController::class, 'usedSemester'])->name('semester.used');
    Route::get('schedule/index', [ScheduleController::class, 'index'])->name('schedule.index');
    Route::get('schedule/group/semester/{groupSemester}', [ScheduleController::class, 'scheduleGroupSemester'])->name('schedule.group.semester');
    Route::post('schedule/store', [ScheduleController::class, 'store'])->name('schedule.store');
    Route::put('schedule/update', [ScheduleController::class, 'update'])->name('schedule.update');
    Route::get('schedule/days', [ScheduleController::class, 'jsonDay'])->name('schedule.jsonDay');
    Route::post('schedule/destroy/{id}', [ScheduleController::class, 'destroy'])->name('schedule.destroy');
    Route::get('teacher/index', [TeacherManagementController::class, 'index'])->name('teacher.index');
    Route::post('teacher/create', [TeacherManagementController::class, 'store'])->name('teacher.store');
    Route::put('teacher/update', [TeacherManagementController::class, 'update'])->name('teacher.update');
    Route::post('teacher/delete/{id}', [TeacherManagementController::class, 'destroy'])->name('teacher.destroy');
    Route::get('students/index', [StudentManagamentController::class, 'index'])->name('student.index');
    Route::post('student/import', [StudentManagamentController::class, 'import'])->name('student.import');
    Route::post('student/store', [StudentManagamentController::class, 'store'])->name('student.store');
    Route::post('student/destroy/{id}', [StudentManagamentController::class, 'destroy'])->name('student.destroy');
    Route::put('student/update', [StudentManagamentController::class, 'update'])->name('student.update');
    Route::get('shift/index', [ShiftController::class, 'index'])->name('shift.index');
    Route::post('shift/store', [ShiftController::class, 'store'])->name('shift.store');
    Route::post('shift/destroy/{shift}', [ShiftController::class, 'destroy'])->name('shift.destroy');
    Route::get('pair/json', [ShiftController::class, 'shift_pairs'])->name('pair.json');
    Route::get('profile/', [AdminController::class, 'profile'])->name('profile.settings');
    Route::put('profile/update', [AdminController::class, 'editProfile'])->name('profile.edit');
    });

//StudentController Routes

Route::middleware(['auth', 'role:student'])->prefix('student')->name('student.')->group(function() {


    Route::get('/', [StudentController::class, 'index'])->name('dashboard');
    Route::get('subjects/{semester_id?}', [StudentController::class, 'subjects'])->name('subjects');
    Route::get('subject/select', [StudentController::class, 'subjectSelect'])->name('subject.select');
    Route::get('subject/detail/{course}', [StudentController::class, 'subjectDetail'])->name('subject.detail');
    Route::post('task/answer/create', [TaskAnswerController::class, 'store'])->name('taskAnswer.store');
    Route::put('task/answer/update', [TaskAnswerController::class, 'update'])->name('taskAnswer.update');
    Route::get('schedule/', [StudentController::class, 'schedule'])->name('schedule.index');
    Route::get('schedule/detail/{group_semester_id}', [StudentController::class, 'scheduleDetail'])->name('schedule.detail');
    Route::get('exams/', [StudentController::class, 'exams'])->name('exams');
    Route::get('exam/begin/{exam}', [ExamController::class, 'beginExam'])->name('exam.begin');
    Route::post('exam/check', [ExamController::class, 'checkExam'])->name('exam.check');
    Route::get('exam/result/{attemp_id}', [ExamAttempController::class, 'resultExam'])->name('exam.result');
});

//TeacherController Routes

Route::middleware(['auth', 'role:teacher'])->prefix('teacher')->name('teacher.')->group(function() {
    
    Route::get('/', [TeacherController::class, 'index'])->name('index');
    Route::get('subjects/', [TeacherController::class, 'subjects'])->name('subjects');
    Route::post('task/create', [TaskController::class, 'store'])->name('task.store');
    Route::get('subject/tasks/{course}', [TaskController::class, 'tasksBySubject'])->name('subject.tasks');
    Route::put('task/edit', [TaskController::class, 'update'])->name('task.edit');
    Route::post('task/delete/{task}', [TaskController::class, 'destroy'])->name('task.destroy');
    Route::get('task/rating/{task}', [RatingController::class, 'ratingTask'])->name('task.rating');
    Route::post('task/rating/create', [RatingController::class, 'store'])->name('rating.store');
    Route::put('task/update', [RatingController::class, 'update'])->name('rating.edit');
    Route::get('attendance/index', [AttendanceController::class, 'index'])->name('attendance.index');
    Route::get('attendance/create/{course}', [AttendanceController::class, 'create'])->name('attendance.create');
    Route::post('attendance/store', [AttendanceController::class, 'store'])->name('attendance.store');
    Route::get('subject/lesson/{course}', [AttendanceController::class, 'getAttendanceByCourse'])->name('subject.lessons');
    Route::get('exams/', [ExamController::class, 'examByTeacher'])->name('exams');
    Route::post('exam/store/', [ExamController::class, 'store'])->name('exam.store');
    Route::put('exam/update/', [ExamController::class, 'edit'])->name('exam.edit');
    Route::post('exam/destroy/{exam}', [ExamController::class, 'destroy'])->name('exam.destroy');
    Route::get('exam/add-question/{exam}', [ExamController::class, 'addQuestion'])->name('exam.addQuestion');
    Route::post('question/store', [QuestionController::class, 'store'])->name('question.store');
    Route::get('questions/{exam}', [ExamController::class, 'getQuestions'])->name('questions');
    Route::post('question/destroy/{question}', [QuestionController::class, 'destroy'])->name('question.destroy');
    Route::post('question/import', [QuestionController::class, 'import'])->name('question.import');
    
});