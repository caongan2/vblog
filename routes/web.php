<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
Route::get('/', function (){
   return view('customer.login');
});
Route::get('/login', [LoginController::class, 'showFormLogin'])->name('formLogin');
Route::get('/register', [LoginController::class, 'showFormRegister'])->name('formRegister');

Route::prefix('user')->group(function (){
    Route::get('list', [UserController::class, 'index'])->name('user.list');
    Route::get('adduser', [UserController::class, 'create'])->name('user.adduser');
    Route::post('create', [UserController::class, 'store'])->name('user.create');
    Route::get('edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::post('update/{id}', [UserController::class, 'update'])->name('user.update');
    Route::get('{id}/delete', [UserController::class, 'destroy'])->name('user.delete');
    Route::get('{id}/profile', [UserController::class, 'show'])->name('user.profile');
});
