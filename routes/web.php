<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('test',[TestController::class,'sendEmail']);

Route::get('/attachments', [TestController::class, 'index'])->name('attachments.index');
Route::get('/attachments/{filename}', [TestController::class, 'getAttachment']);
