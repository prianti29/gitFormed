<?php

use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PullRequestController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RepositoryController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\WatcherController;

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
Route::get('/pull-req/{id}', [PullRequestController::class, 'getPullRequestByRepository']);
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::resource('/addrepo', RepositoryController::class)->only([
        'index', 'create', 'store', 'edit', 'update', 'destroy'
    ]);
});
Route::middleware(['auth'])->group(function () {
    Route::resource('/add-pull-req', PullRequestController::class)->only([
        'index', 'create', 'store', 'edit', 'update', 'destroy'
    ]);
});
Route::get('/read-notifications', [NotificationController::class, 'readNotificationsAndUpdateReadStatus']);

Route::post('/watcher/update', [WatcherController::class, 'updateWatchers']);


require __DIR__.'/auth.php';
