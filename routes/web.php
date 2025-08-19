<?php

use App\Http\Controllers\DocumentPrintController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/admin');
})->name('login');

Route::middleware(['auth'])->group(function () {
    Route::get('document/{id}/print', [DocumentPrintController::class, 'show'])
        ->name('documents.print');
});
