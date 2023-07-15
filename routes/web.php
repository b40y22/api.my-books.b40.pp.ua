<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/pdf/book/first-page', function () {
//    return view('pdf.book.first-page', [
//        'title' => 'Нимфа лунного моря',
//        'authors' => ['Вера Петрук'],
//        'cover' => 'http://loveread.ec/img/photo_books/109941.jpg',
//        'year' => 2023
//    ]);
//});
