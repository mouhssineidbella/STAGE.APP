<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;
use App\Http\Controllers\DocumentController;

// Home route - Redirects to the form page
Route::get('/', function () {
    return redirect('/form');
});

// Route to show the form
Route::get('/form', [FormController::class, 'showForm'])->name('form.show');

// Route to handle document generation
Route::post('/generate-document', [DocumentController::class, 'generate'])->name('generate.document');
