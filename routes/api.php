<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Author\AuthorGetController;
use App\Http\Controllers\Api\Author\AuthorRemoveController;
use App\Http\Controllers\Api\Author\AuthorStoreController;
use App\Http\Controllers\Api\Author\AuthorUpdateController;
use App\Http\Controllers\Api\Book\BookGetController;
use App\Http\Controllers\Api\Book\BookStoreController;
use App\Http\Controllers\Api\Book\BookUpdateController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/auth')->group(function () {
    Route::post('/login',       [LoginController::class, '__invoke'])->name('auth.login');
    Route::post('/register',    [RegisterController::class, '__invoke'])->name('auth.register');
});

Route::namespace('api')->group(function () {

    // Author
    Route::prefix('/author')->group(function () {
        Route::post('/store',   [AuthorStoreController::class, '__invoke'])->name('author.store');
        Route::post('/update',  [AuthorUpdateController::class, '__invoke'])->name('author.update');
        Route::post('/remove',  [AuthorRemoveController::class, '__invoke'])->name('author.remove');
        Route::get('/{id}',     [AuthorGetController::class, '__invoke'])->name('author.get');
    });

    // Book
    Route::prefix('/book')->group(function () {
        Route::post('/store',   [BookStoreController::class, '__invoke'])->name('book.store');
        Route::post('/update',  [BookUpdateController::class, '__invoke'])->name('book.update');
        Route::get('/{id}',     [BookGetController::class, '__invoke'])->name('book.get');
    });
});
