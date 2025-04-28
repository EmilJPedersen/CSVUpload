<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CsvController;

Route::get('/', [CsvController::class, 'index']);
Route::post('/upload', [CsvController::class, 'upload'])->name('csv.upload');
Route::get('/download-pdf', [CsvController::class, 'downloadPdf'])->name('csv.download.pdf');

// Route::get('/', function () {
//     return view('welcome');
// });
