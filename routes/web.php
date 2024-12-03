<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HotelController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
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
use Illuminate\Support\Facades\Session;



Route::get('/api/example', [HotelController::class, 'index']);
Route::get('/user', [AuthController::class, 'checkUser']);
Route::post('/user/login', [AuthController::class, 'login']);
Route::post('/user/checkpw', [AuthController::class, 'checkPw']);
Route::post('/user/changepw', [AuthController::class, 'changePw']);

Route::get('/get-csrf', function () {
    return response()->json(['csrfToken' => csrf_token()]);
});


Route::get('/clear-cache', function () {
    if (Session::flush()) {
        return response()->json(1);
    };
});

