<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\DefendantController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SurveyController;
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


Route::middleware('guest')->group(function () {
    Route::get('register', [RegisterController::class, 'index'])
        ->middleware('guest')
        ->name('register');
    Route::post('register', [RegisterController::class, 'store'])
        ->name('register.store');

    Route::get('login', [LoginController::class, 'index'])
        ->name('login');
    Route::post('login', [LoginController::class, 'store'])
        ->name('login.store');
});

Route::middleware('auth')->group(function () {
    Route::view('/home', 'home/index')->name('home');

    Route::get('surveys', [SurveyController::class, 'index'])
        ->name('surveys');
    Route::get('surveys/create', [SurveyController::class, 'create'])
        ->name('surveys.create');
    Route::post('surveys', [SurveyController::class, 'store'])
        ->name('surveys.store');
    Route::get('surveys/{survey}', [SurveyController::class, 'show'])
        ->name('surveys.show');
    Route::delete('surveys/{survey}', [SurveyController::class, 'destroy'])
        ->name('surveys.destroy');

    Route::get('defendants', [DefendantController::class, 'index'])
        ->name('defendants');

    Route::get('defendants/create', [DefendantController::class, 'create'])
        ->name('defendants.create');
    Route::post('defendants', [DefendantController::class, 'store'])
        ->name('defendants.store');
    Route::get('defendants/{defendant}', [DefendantController::class, 'show'])
        ->name('defendants.show');
    Route::get('defendants/{defendant}/edit',
        [DefendantController::class, 'edit'])
        ->name('defendants.edit');
    Route::delete('defendants/{defendant}',
        [DefendantController::class, 'delete'])
        ->name('defendants.delete');


    Route::get('answers/{answer}', [AnswerController::class, 'show'])
        ->name('answers.show');

    Route::get('answers/{answer}/edit', [AnswerController::class, 'edit'])
        ->name('answers.edit');

    Route::delete('answers/{answer}', [AnswerController::class, 'delete'])
        ->name('answers.delete');
});