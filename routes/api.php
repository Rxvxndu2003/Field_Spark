<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\InstructorAuthController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AppointmentController;



Route::get('/questions', [QuestionController::class, 'index']);
Route::post('/questions', [QuestionController::class, 'store']);
Route::get('/questions/{id}', [QuestionController::class, 'show']);
Route::post('/questions/{id}/replies', [QuestionController::class, 'storeReply']);
Route::get('/questions/search/{query}', [QuestionController::class, 'search']);
// Route::post('/questions/{id}/solve', [QuestionController::class, 'markAsSolved']);
Route::post('/questions/{id}/solve', 'QuestionController@markAsSolved');
Route::get('/questions/solved', 'QuestionController@getSolvedQuestions');
Route::post('/questions/{id}/like', [QuestionController::class, 'likeQuestion']);






Route::post('/instructor/register', [InstructorAuthController::class, 'register']);
Route::post('/instructor/login', [InstructorAuthController::class, 'login'])->middleware('guest:sanctum');
Route::post('/instructor/logout', [InstructorAuthController::class, 'logout'])->middleware('guest:sanctum');


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//User Registration and Login Routes
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/auth/register', [UserController::class, 'createUser'])->name('register');;
Route::post('/auth/login', [UserController::class, 'loginUser']);

// Route::post('/auth/instructorregister', [InstructorController::class, 'createInstructor'])->name('instructorregister');;
// Route::post('/auth/instructorlogin', [InstructorController::class, 'loginInstructor']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});