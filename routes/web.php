<?php

use App\Http\Controllers\ComputerController;
use App\Http\Controllers\DesktopController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

/*
    Common Resource Routes:
    *index - show ALL items
    *show - show SINGLE item
    *create - show form to CREATE new item
    *store - STORE new item
    *edit - show form to EDIT item
    *update - UPDATE item
    *destroy - DELETE item
*/

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/computers/create', [ComputerController::class, 'create']);
Route::post('/computers', [ComputerController::class, 'store']);
Route::get('/computers', [ComputerController::class, 'index']);
Route::get('/computers/{computerId}/edit', [ComputerController::class, 'edit']);
Route::patch('/computers/{computerId}', [ComputerController::class, 'update']);
Route::delete('/computers/{computerId}', [ComputerController::class, 'destroy']);
// Route::resource('/computers', 'ComputerController');

Route::delete('/desktops/delete/all/{userID}', [DesktopController::class, 'deleteAll']);
Route::resource('/desktops', DesktopController::class);
Route::patch('/desktops/status/{statusID}/desktop/{desktopID}', [DesktopController::class, 'updateStatus']);