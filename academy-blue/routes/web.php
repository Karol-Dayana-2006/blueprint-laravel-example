<?php

use Illuminate\Support\Facades\Route;

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
    return view('category.index');
});


Route::resource('categories', App\Http\Controllers\CategoryController::class);

Route::resource('courses', App\Http\Controllers\CourseController::class)->except('show');

Route::resource('lessons', App\Http\Controllers\LessonController::class);

Route::resource('enrollments', App\Http\Controllers\EnrollmentController::class);


Route::resource('categories', App\Http\Controllers\CategoryController::class)->except('show');

Route::resource('courses', App\Http\Controllers\CourseController::class)->except('show');

Route::resource('lessons', App\Http\Controllers\LessonController::class)->except('show');

Route::resource('enrollments', App\Http\Controllers\EnrollmentController::class)->except('show');
