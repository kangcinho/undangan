<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InviteController;
use App\Http\Controllers\LoginController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::get("/admin", [InviteController::class, 'getList']);


Route::get("/{nama}", [InviteController::class, 'index']);

Route::post("/reservasi", [InviteController::class, 'reservasi']);
Route::get("/reservasi/{id}", [InviteController::class, 'reservasiGet']);

Route::get("/admin/login", [LoginController::class, 'index'])->middleware('guest')->name("login");
Route::post("/admin/login", [LoginController::class, 'login'])->middleware('guest');

//Kasta Admin
Route::post("/admin/logout", [LoginController::class, 'logout'])->middleware('auth');

Route::get("/admin/list", [InviteController::class, 'getList'])->middleware('auth');

Route::get("/admin/input", [InviteController::class, 'inputPage'])->middleware('auth');
Route::post("/admin/input", [InviteController::class, 'post'])->middleware('auth');

Route::get("/admin/update/{id}", [InviteController::class, 'updatePage'])->middleware('auth');
Route::post("/admin/update/{id}", [InviteController::class, 'update'])->middleware('auth');

Route::get("/admin/delete/{url}", [InviteController::class, 'delete'])->middleware('auth');