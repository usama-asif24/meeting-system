<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\GoogleCalendarController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/meetings', [GoogleCalendarController::class, 'createMeeting']);
Route::put('/meetings/{id}', [GoogleCalendarController::class, 'updateMeeting']);
Route::delete('/meetings/{id}', [GoogleCalendarController::class, 'deleteMeeting']);
