<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CityController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\UserController;

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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::match(['post', 'get'], '/', [MainController::class, 'index'])->name('main');
Route::match(['post', 'get'], '/sort', [MainController::class, 'sort'])->name('sort');
Route::match(['post', 'get'], '/sort_users', [MainController::class, 'sortUsers'])->name('sortUsers');
Route::match(['post', 'get'], '/city', [CityController::class, 'store'])->name('city');
Route::delete('/city/{id}', [CityController::class, 'destroy'])->name('delete');
Route::put('/cities/{city}', [CityController::class, 'edit'])->name('edit');


// Route::match(['post', 'get'], '/all_users', [UserController::class, 'index'])->name('users');

Route::match(['post', 'get'], '/all_users', [UserController::class, 'store'])->name('all_users');
Route::put('/users/{user}', [UserController::class, 'update'])->name('edit_user');

Route::match(['post', 'get'], '/search', [MainController::class, 'search'])->name('search');

Route::resource('users', 'App\Http\Controllers\UserController');
