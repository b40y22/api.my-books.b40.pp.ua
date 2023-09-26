<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Author\AuthorGetController;
use App\Http\Controllers\Api\Author\AuthorListController;
use App\Http\Controllers\Api\Author\AuthorRemoveController;
use App\Http\Controllers\Api\Author\AuthorStoreController;
use App\Http\Controllers\Api\Author\AuthorUpdateController;
use App\Http\Controllers\Api\Book\BookGetController;
use App\Http\Controllers\Api\Book\BookListController;
use App\Http\Controllers\Api\Book\BookRemoveController;
use App\Http\Controllers\Api\Book\BookStoreController;
use App\Http\Controllers\Api\Book\BookUpdateController;
use App\Http\Controllers\Api\ExternalSource\ExternalSourceListController;
use App\Http\Controllers\Api\ExternalSource\ExternalSourceStoreController;
use App\Http\Controllers\Api\Import\ImportBookController;
use App\Http\Controllers\Api\User\UserGetController;
use App\Http\Controllers\Api\User\UserPhotoUpdateController;
use App\Http\Controllers\Api\User\UserUpdateController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/auth')->group(function () {
    Route::post('/login',       [LoginController::class, '__invoke'])->name('auth.login');
    Route::post('/register',    [RegisterController::class, '__invoke'])->name('auth.register');
});

Route::middleware('auth:sanctum')->namespace('api')->group(function () {

    // Author
    Route::prefix('/author')->group(function () {
        Route::get('/{id}',     [AuthorGetController::class, '__invoke'])->name('author.get');
        Route::post('/',        [AuthorStoreController::class, '__invoke'])->name('author.store')->middleware('addUserId');
        Route::put('/{id}',     [AuthorUpdateController::class, '__invoke'])->name('author.update');
        Route::delete('/{id}',  [AuthorRemoveController::class, '__invoke'])->name('author.delete');
    });
    Route::get('/authors',      [AuthorListController::class, '__invoke'])->name('author.list');

    // Book
    Route::prefix('/book')->group(function () {
        Route::get('/{id}',     [BookGetController::class, '__invoke'])->name('book.get');
        Route::post('/',        [BookStoreController::class, '__invoke'])->name('book.store')->middleware('addUserId');
        Route::put('/{id}',     [BookUpdateController::class, '__invoke'])->name('book.update');
        Route::delete('/{id}',  [BookRemoveController::class, '__invoke'])->name('book.delete');
    });
    Route::get('/books',        [BookListController::class, '__invoke'])->name('book.list');

    // Import
    Route::prefix('/import')->group(function () {
        Route::post('/',        [ImportBookController::class, '__invoke'])->name('import.book')->middleware('addUserId');
    });

    // External source
    Route::prefix('/external-source')->group(function () {
        Route::post('/',        [ExternalSourceStoreController::class, '__invoke'])->name('external.source.store');
    });
    Route::get('/external-sources', [ExternalSourceListController::class, '__invoke'])->name('external.source.list');

    // User
    Route::prefix('/user')->group(function () {
        Route::get('/',         [UserGetController::class, '__invoke'])->name('user.get');
        Route::post('/photo',   [UserPhotoUpdateController::class, '__invoke'])->name('user.photo.update');
        Route::put('/{id}',     [UserUpdateController::class, '__invoke'])->name('user.update');
    });
});
