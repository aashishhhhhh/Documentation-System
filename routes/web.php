<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HotelController;
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
    return view('welcome');
});

Route::get('/api/example', [HotelController::class, 'index']);
Route::get('/user', [AuthController::class, 'checkUser']);
Route::post('/user/login', [AuthController::class, 'login']);

Route::get('/get-csrf', function () {
    return response()->json(['csrfToken' => csrf_token()]);
});
