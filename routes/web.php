<?php

use App\Models\Equipment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Import\ImportController;
use App\Http\Controllers\Admin\UserMangeController;
use App\Http\Controllers\Equipment\EquipmentController;
use App\Http\Controllers\Admin\Category\CategoryController;

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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// user manage
Route::resource('/users',UserMangeController::class)->middleware(['auth', 'role:admin']);
//block user
Route::post('users/block/{user}', [UserMangeController::class, 'blockUser']);
Route::post('users/unblock/{user}', [UserMangeController::class, 'unBlockUser']);

//category
Route::resource('/category',CategoryController::class)->middleware(['auth', 'role:admin']);

Route::resource('/equipment',EquipmentController::class)->middleware(['auth', 'role:admin,employee']);
Route::resource('/import',ImportController::class)->middleware(['auth', 'role:admin,employee']);




