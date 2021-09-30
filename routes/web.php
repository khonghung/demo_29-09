<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
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


Route::get('', [LoginController::class, 'showFormLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('auth.login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('change-password', [LoginController::class, 'showFormChangePassword'])->name('change.form');
Route::post('change-password', [LoginController::class, 'changePassword'])->name('change.password');



Route::middleware('auth')->prefix('admin')->group(function () {
    Route::prefix('users')->group(function () {
        Route::get('/dashboard', [HomeController::class, 'index'])->name('home.index');
        Route::get('', [UserController::class, 'index'])->name('users.index');
        Route::get('/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/create', [UserController::class, 'store'])->name('users.store');
        Route::get('/{id}', [UserController::class, 'detail'])->whereNumber('id')->name('users.detail');
        Route::get('/{id}/comments/{id_comment?}', [UserController::class, 'getComment'])->name('users.getComment');
        Route::get('{id}/update', [UserController::class, 'update'])->name('users.update');
        Route::post('{id}/update', [UserController::class, 'edit'])->name('users.edit');
        Route::get('{id}/delete', [UserController::class, 'destroy'])->name('users.delete');
    });

    Route::prefix('books')->group(function () {
        Route::get('', [BookController::class, 'index'])->name('books.index');
        Route::get('/create', [BookController::class, 'create'])->name('books.create');
        Route::post('/create', [BookController::class, 'store'])->name('books.store');
        Route::get('{id}/update', [BookController::class, 'edit'])->name('books.update');
        Route::post('{id}/update', [BookController::class, 'update'])->name('books.edit');
        Route::get('{id}/delete', [BookController::class, 'destroy'])->name('books.delete');
        Route::post('/search', [BookController::class, 'search'])->name('books.search');
    });


    Route::prefix('categories')->group(function () {
        Route::get('', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('/create', [CategoryController::class, 'create'])->name('categories.create');
        Route::post('/create', [CategoryController::class, 'store'])->name('categories.store');
        Route::get('{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::post('{id}/edit', [CategoryController::class, 'update'])->name('categories.update');
        Route::get('{id}/delete', [CategoryController::class, 'destroy'])->name('categories.delete');
    });
});




/*
 * Route::method('uri', 'action')
 *
 * - method: GET - lấy tài nguyên
 *           POST - them moi
 *           PUT - cap nhat
 *           DELETE - Xoa
 *
 * - action: - function x
 *           - array [Controller::class, 'method'] -> nen su dung
 *           - string - 'App\Http\Controllers@method' x
 *
 */
