<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RepositoryController;
use App\Http\Controllers\WelcomeController;

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


Route::get('/', function () {
    return view('welcome');
});
Route::get('/allrepo', [WelcomeController::class, 'index']);
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
Route::get('/addrepo', [RepositoryController::class, 'index'])->middleware(['auth'])->name('post.index');
Route::get('/addrepo/create', [RepositoryController::class, 'create'])->middleware(['auth']);
Route::post('/addrepo', [RepositoryController::class, 'store'])->middleware(['auth']);
Route::get('/addrepo/{id}/edit', [RepositoryController::class, 'edit'])->middleware(['auth']);
Route::put('/addrepo/{id}', [RepositoryController::class, 'update'])->middleware(['auth']);
Route::delete('/addrepo/{id}', [RepositoryController::class, 'destroy'])->middleware(['auth']);

require __DIR__.'/auth.php';
