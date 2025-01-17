<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DesktopController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ComputerController;
use App\Http\Controllers\PeripheralController;
use App\Http\Controllers\MaintenanceLogController;
use App\Http\Controllers\DisposalArchiveController;

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

/*
    NOTE: To use Auth, you need to execute the ff. commands in the terminal:
    -   composer require laravel/ui
    -   php artisan ui bootstrap --auth
    -   npm install && npm run dev
*/

Auth::routes();

Route::middleware(['auth'])->group(function() {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    

    Route::get('/profile', [ProfileController::class, 'index']);
    Route::patch('/profile/image/{userID}', [ProfileController::class, 'updateImage']);
    Route::patch('/profile/user/{userID}', [ProfileController::class, 'updateUser']);
    Route::patch('/profile/changepassword/{userID}', [ProfileController::class, 'updatePassword']);
    Route::delete('/profile/deleteaccount/{userID}', [ProfileController::class, 'deleteAccount']);
    

    Route::get('/computers/create', [ComputerController::class, 'create']);
    Route::post('/computers', [ComputerController::class, 'store']);
    Route::get('/computers', [ComputerController::class, 'index']);

    // w/out Route Model Binding
    // Route::get('/computers/{computerId}/edit', [ComputerController::class, 'edit']);

    // w/ Route Model Binding (NOTE: Make sure the model 'Computer' exists)
    // Route::get('/computers/{computer}/edit', [ComputerController::class, 'edit']);

    Route::get('/computers/{computer}/edit', [ComputerController::class, 'edit']);
    Route::patch('/computers/{computer}', [ComputerController::class, 'update']);
    Route::delete('/computers/{computer}', [ComputerController::class, 'destroy']);
    // Route::resource('/computers', ComputerController::class);    // alternative way of declaring routes
    

    Route::delete('/desktops/delete/all/{userID}', [DesktopController::class, 'deleteAll']);
    Route::resource('/desktops', DesktopController::class);
    Route::patch('/desktops/status/{statusID}/desktop/{desktopID}', [DesktopController::class, 'updateStatus']);
    

    Route::delete('/peripherals/delete/all/{userID}', [PeripheralController::class, 'deleteAll']);
    Route::get('/peripherals/monitor', [PeripheralController::class, 'showMonitor']);
    Route::get('/peripherals/keyboard', [PeripheralController::class, 'showKeyboard']);
    Route::get('/peripherals/mouse', [PeripheralController::class, 'showMouse']);
    Route::get('/peripherals/headset', [PeripheralController::class, 'showHeadset']);
    Route::resource('/peripherals', PeripheralController::class);
    Route::patch('/peripherals/status/{statusID}/peripheral/{peripheralID}', [PeripheralController::class, 'updateStatus']);
    

    Route::get('/users/deactivated', [UserController::class, 'showDeactivatedUsers']);
    Route::patch('/users/restore/{userID}', [UserController::class, 'restore']);
    Route::delete('/users/permanentdelete/{userID}', [UserController::class, 'permanentDelete']);
    Route::resource('/users', UserController::class);
    

    Route::get('/maintenancelog', [MaintenanceLogController::class, 'index']);
    Route::delete('/maintenancelog/status/{mlID}', [MaintenanceLogController::class, 'setStatus']);
    Route::delete('/maintenancelog/disposal/{mlID}', [MaintenanceLogController::class, 'setDisposal']);
    Route::post('/maintenancelog/remarks/{remarksID}', [MaintenanceLogController::class, 'getRemarks']);
    Route::patch('/maintenancelog/remarks/{remarksID}/update/{formRemarks}', [MaintenanceLogController::class, 'updateRemarks']);
    

    Route::get('/disposalarchive', [DisposalArchiveController::class, 'index']);
    Route::delete('/disposalarchive/restore/{dpID}', [DisposalArchiveController::class, 'restoreItem']);
    Route::delete('/disposalarchive/dispose/{dpID}', [DisposalArchiveController::class, 'disposeItem']);
    Route::post('/disposalarchive/disposed/details/get/{detailsID}', [DisposalArchiveController::class, 'getDisposedItemDetails']);
    Route::post('/disposalarchive/hasdetails/{detailsID}', [DisposalArchiveController::class, 'hasItemDetails']);
    Route::patch('/disposalarchive/details/save/{detailsID}', [DisposalArchiveController::class, 'saveItemDetails']);
    Route::post('/disposalarchive/details/edit/{detailsID}', [DisposalArchiveController::class, 'editItemDetails']);
    Route::patch('/disposalarchive/details/update/{detailsID}', [DisposalArchiveController::class, 'updateItemDetails']);
});