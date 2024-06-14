<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\TeachingScheduleController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    
    // Route::get('/', 'HomeController@index')->name('home');

    //Dashboard Routes
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::post('/notification/store', [HomeController::class, 'storeNotification'])->name('store.notification');
    Route::delete('/notification/{id}', [HomeController::class, 'deleteNotification'])->name('delete.notification');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');
    Route::get('/events', [EventController::class, 'fetchEvents'])->name('events.fetch');
    Route::delete('/events/delete-all', [EventController::class, 'deleteAllEvents'])->name('events.delete.all');


    // Student Routes
    Route::get('/students', [StudentController::class, 'index'])->name('listStudents');
    Route::get('/students/create', [StudentController::class, 'create'])->name('createStudents');
    Route::post('/students', [StudentController::class, 'store'])->name('storeStudents');
    Route::get('/students/{student}', [StudentController::class, 'show'])->name('showStudents');
    Route::get('/students/{student}/edit', [StudentController::class, 'edit'])->name('editStudents');
    Route::put('/students/{student}', [StudentController::class, 'update'])->name('updateStudents');
    Route::delete('/students/{student}/delete', [StudentController::class, 'destroy'])->name('deleteStudents');
    Route::post('/students/importStudents', [StudentController::class, 'importStudents'])->name('importStudents');

    // Teacher Routes
    Route::get('/teachers', [TeacherController::class, 'index'])->name('listTeachers');
    Route::get('/teachers/create', [TeacherController::class, 'create'])->name('createTeachers');
    Route::post('/teachers', [TeacherController::class, 'store'])->name('storeTeachers');
    Route::get('/teachers/{teacher}', [TeacherController::class, 'show'])->name('showTeachers');
    Route::get('/teachers/{teacher}/edit', [TeacherController::class, 'edit'])->name('editTeachers');
    Route::put('/teachers/{teacher}', [TeacherController::class, 'update'])->name('updateTeachers');
    Route::delete('/teachers/{teacher}/delete', [TeacherController::class, 'destroy'])->name('deleteTeachers');
    Route::post('/teachers/importTeachers', [TeacherController::class, 'importTeachers'])->name('importTeachers');

    // Attendance Routes
    Route::get('/attendances', [AttendanceController::class, 'index'])->name('listAttendances');
    Route::get('/attendances/create', [AttendanceController::class, 'create'])->name('createAttendances');
    Route::post('/attendances', [AttendanceController::class, 'store'])->name('storeAttendances');
    Route::get('/attendances/{attendance}', [AttendanceController::class, 'show'])->name('showAttendances');
    Route::get('/attendances/{attendance}/edit', [AttendanceController::class, 'edit'])->name('editAttendances');
    Route::put('/attendances/{attendance}', [AttendanceController::class, 'update'])->name('updateAttendances');
    Route::delete('/attendances/{attendance}/delete', [AttendanceController::class, 'destroy'])->name('deleteAttendances');

    // Grade Routes
    Route::get('/grades', [GradeController::class, 'index'])->name('listGrades');
    Route::get('/grades/create', [GradeController::class, 'create'])->name('createGrades');
    Route::post('/grades', [GradeController::class, 'store'])->name('storeGrades');
    Route::get('/grades/{grade}', [GradeController::class, 'show'])->name('showGrades');
    Route::get('/grades/{grade}/edit', [GradeController::class, 'edit'])->name('editGrades');
    Route::put('/grades/{grade}', [GradeController::class, 'update'])->name('updateGrades');
    Route::delete('/grades/{grade}/delete', [GradeController::class, 'destroy'])->name('deleteGrades');

    // Teaching Schedule Routes
    Route::get('/teaching_schedules', [TeachingScheduleController::class, 'index'])->name('listTeachingschedules');
    Route::get('/teaching_schedules/create', [TeachingScheduleController::class, 'create'])->name('createTeachingschedules');
    Route::post('/teaching_schedules', [TeachingScheduleController::class, 'store'])->name('storeTeachingschedules');
    Route::get('/teaching_schedules/{teaching_schedule}', [TeachingScheduleController::class, 'show'])->name('showTeachingschedules');
    Route::get('/teaching_schedules/{teaching_schedule}/edit', [TeachingScheduleController::class, 'edit'])->name('editTeachingschedules');
    Route::put('/teaching_schedules/{teaching_schedule}', [TeachingScheduleController::class, 'update'])->name('updateTeachingschedules');
    Route::delete('/teaching_schedules/{teaching_schedule}/delete', [TeachingScheduleController::class, 'destroy'])->name('deleteTeachingschedules');

    // Payment Routes
    Route::get('/payments', [PaymentController::class, 'index'])->name('listPayments');
    Route::get('/payments/create', [PaymentController::class, 'create'])->name('createPayments');
    Route::post('/payments', [PaymentController::class, 'store'])->name('storePayments');
    Route::get('/payments/{payment}', [PaymentController::class, 'show'])->name('showPayments');
    Route::get('/payments/{payment}/edit', [PaymentController::class, 'edit'])->name('editPayments');
    Route::put('/payments/{payment}', [PaymentController::class, 'update'])->name('updatePayments');
    Route::delete('/payments/{payment}/delete', [PaymentController::class, 'destroy'])->name('deletePayments');
    // Route::get('payments/trashed', [PaymentController::class, 'trashed'])->name('payments.trashed');
    // Route::get('/payments/search', 'PaymentController@search')->name('payments.search');

    // Route::post('payments/{id}/restore', [PaymentController::class, 'restore'])->name('payments.restore');
    // Route::delete('payments/{id}/force-delete', [PaymentController::class, 'forceDelete'])->name('payments.forceDelete');
    // Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
    // Route::get('/payments/create', [PaymentController::class, 'create'])->name('payments.create');
    // Route::post('/payments', [PaymentController::class, 'store'])->name('payments.store');
    // Route::get('/payments/{id}', [PaymentController::class, 'show'])->name('payments.show');
    // Route::get('/payments/print/{id}', [PaymentController::class, 'print'])->name('payments.print');
    // Route::delete('/payments/{id}', [PaymentController::class, 'destroy'])->name('payments.destroy');
    // Route::get('/payments/{id}/edit', [PaymentController::class, 'edit'])->name('payments.edit');
    // Route::put('/payments/{id}', [PaymentController::class, 'update'])->name('payments.update');



});

require __DIR__.'/auth.php';
