<?php
use App\Http\Controllers\UserListController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TutorController;
use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'postLogin'])->name('login.post');
Route::get('registration', [AuthController::class, 'register'])->name('register');
Route::post('registration', [AuthController::class, 'postRegistration'])->name('register.post');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('userlist', [UserListController::class, 'userlist'])->name('userlist');
Route::post('saveuser', [UserListController::class, 'saveUser'])->name('saveuser');
Route::delete('deleteUser/{id}', [UserListController::class, 'markDelete'])->name('user.delete');
Route::post('updateUser/{id}', [UserListController::class, 'markUpdate'])->name('user.update');

Route::get('tutorlist', [TutorController::class, 'tutorlist'])->name('tutorlist');
Route::post('/saveTutor', [TutorController::class, 'saveTutor'])->name('saveTutor');
Route::delete('deleteTutor/{id}', [TutorController::class, 'markDelete'])->name('tutor.delete');
Route::post('updateTutor/{id}', [TutorController::class, 'markUpdate'])->name('tutor.update');



Route::get('courselist', [CourseController::class, 'courselist'])->name('courselist');
Route::post('savecourse', [CourseController::class, 'saveCourse'])->name('savecourse');
Route::delete('deleteCourse/{id}', [CourseController::class, 'markDelete'])->name('markDelete'); // Update this route
Route::post('updateCourse/{id}', [CourseController::class, 'markUpdate'])->name('markUpdate');


