<?php

use App\Models\Equipment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\Export\ExportController;
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

Route::get('warehouse/login', function () {
    return view('auth.login');
});

Route::get('/', function () {
    return view('auth.login');
});
Auth::routes();

Route::get('/warehouse', [App\Http\Controllers\HomeController::class, 'index'])->middleware(['auth', 'role:admin,employee'])->name('home');

// user manage
Route::resource('/users',UserMangeController::class)->middleware(['auth', 'role:admin']);
//block user
Route::post('users/block/{user}', [UserMangeController::class, 'blockUser']);
Route::post('users/unblock/{user}', [UserMangeController::class, 'unBlockUser']);

//category
Route::resource('/category',CategoryController::class)->middleware(['auth', 'role:admin']);

Route::resource('/equipment',EquipmentController::class)->middleware(['auth', 'role:admin,employee']);

//import
Route::get('/import',[ImportController::class,'index'])->middleware(['auth', 'role:admin,employee'])->name('import.index');
Route::get('/import/create',[ImportController::class,'create'])->middleware(['auth', 'role:admin,employee'])->name('import.create');


//history
Route::get('/history',[HistoryController::class,'index'])->middleware(['auth', 'role:admin,employee'])->name('history.index');
//history import
Route::delete('/import/{importbill}',[ImportController::class,'destroy'])->middleware(['auth', 'role:admin'])->name('import.destroy');
Route::get('/import/{importbill}',[ImportController::class,'show'])->middleware(['auth', 'role:admin,employee'])->name('import.show');

//cart
Route::get('/cart',[CartController::class,'index'])->middleware(['auth', 'role:admin,employee']);
Route::post('/cart',[CartController::class,'store'])->middleware(['auth', 'role:admin,employee']);
Route::get('/get_cart',[CartController::class,'getCart'])->middleware('auth');
Route::post('/delete_equipment_in_cart',[CartController::class,'deleteEquipmentInCart'])->middleware('auth');
Route::post('/update_qty_cart',[CartController::class,'updateQty'])->middleware('auth');
Route::post('/clearCart',[CartController::class,'clearCart'])->middleware('auth');

//export
Route::get('/export',[ExportController::class,'index'])->middleware(['auth', 'role:admin,employee'])->name('export.index');
Route::post('/export',[ExportController::class,'storeExportBill'])->middleware(['auth', 'role:admin,employee'])->name('store_export_bill');

