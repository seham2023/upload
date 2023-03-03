<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\Admin\PermissionController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/upload', [UploadController::class, 'store']);
Route::get('/upload', [UploadController::class, 'index']);
Route::get('/upload/{id}/edit', [UploadController::class, 'edit'])->name('upload.edit')->middleware('userauth:edit');
Route::delete('/upload/{id}', [UploadController::class, 'destroy'])->name('upload.destroy')->middleware('userauth:delete');

Route::put('/upload/{id}', [UploadController::class, 'update'])->middleware('userauth:update');

// Route::resource('upload',UploadController::class,);
Route::resource('users',UserController::class,);
Route::resource('permissions',PermissionController::class,);

require __DIR__.'/auth.php';
