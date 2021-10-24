<?php

use App\Models\Equipment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\Admin\AreaController;
use App\Http\Controllers\Export\ExportController;
use App\Http\Controllers\Import\ImportController;
use App\Http\Controllers\Equipment\SellController;
use App\Http\Controllers\Admin\UserMangeController;
use App\Http\Controllers\Equipment\EquipmentController;
use App\Http\Controllers\Admin\Category\CategoryController;
use App\Http\Controllers\Admin\Supplier\SupplierController;
use App\Http\Controllers\Equipment\UsedEquipmentController;
use App\Http\Controllers\Equipment\DeletedEquipmentController;
use App\Http\Controllers\Equipment\RestoreEquipmentController;

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

Route::get('/warehouse', [App\Http\Controllers\HomeController::class, 'index'])->middleware(['auth', 'role:admin,employee','checkBlock'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware(['auth', 'role:admin,employee']);


// user manage
Route::resource('/users',UserMangeController::class)->middleware(['auth', 'role:admin','checkBlock']);
Route::get('/warehouse/employees',[UserMangeController::class,'employees'])->middleware(['auth', 'role:admin','checkBlock']);
//block user
Route::post('users/block/{user}', [UserMangeController::class, 'blockUser'])->middleware(['auth', 'role:admin','checkBlock']);;
Route::post('users/unblock/{user}', [UserMangeController::class, 'unBlockUser'])->middleware(['auth', 'role:admin','checkBlock']);;

//category
Route::resource('/category',CategoryController::class)->middleware(['auth', 'role:admin','checkBlock']);

Route::resource('/equipment',EquipmentController::class)->middleware(['auth', 'role:admin,employee','checkBlock']);

//import
Route::get('/import',[ImportController::class,'index'])->middleware(['auth', 'role:admin,employee','checkBlock'])->name('import.index');
Route::get('/import/create',[ImportController::class,'create'])->middleware(['auth', 'role:admin,employee','checkBlock'])->name('import.create');


//history
Route::get('/history',[HistoryController::class,'index'])->middleware(['auth', 'role:admin,employee','checkBlock'])->name('history.index');
//history import
Route::delete('/import/{importbill}',[ImportController::class,'destroy'])->middleware(['auth', 'role:admin,employee','checkBlock'])->name('import.destroy');
Route::get('/import/{importbill}',[ImportController::class,'show'])->middleware(['auth', 'role:admin,employee','checkBlock'])->name('import.show');
Route::get('/restore/history',[RestoreEquipmentController::class,'restoreHistory'])->middleware(['auth', 'role:admin,employee','checkBlock'])->name('restore.history');

//cart
Route::get('/cart',[CartController::class,'index'])->middleware(['auth', 'role:admin,employee','checkBlock']);
Route::post('/cart',[CartController::class,'store'])->middleware(['auth', 'role:admin,employee','checkBlock']);
Route::get('/get_cart',[CartController::class,'getCart'])->middleware(['auth', 'role:admin,employee','checkBlock']);
Route::post('/delete_equipment_in_cart',[CartController::class,'deleteEquipmentInCart'])->middleware(['auth', 'role:admin,employee','checkBlock']);
Route::post('/update_qty_cart',[CartController::class,'updateQty'])->middleware(['auth', 'role:admin,employee','checkBlock']);
Route::post('/clearCart',[CartController::class,'clearCart'])->middleware(['auth', 'role:admin,employee','checkBlock']);

//export
Route::get('/export',[ExportController::class,'index'])->middleware(['auth', 'role:admin,employee','checkBlock'])->name('export.index');
Route::post('/export',[ExportController::class,'storeExportBill'])->middleware(['auth', 'role:admin,employee','checkBlock'])->name('store_export_bill');
Route::post('/export_to_room',[ExportController::class,'exportToRoom'])->middleware(['auth', 'role:admin,employee','checkBlock'])->name('export_to_room');
Route::get('/export_history',[ExportController::class,'history'])->middleware(['auth', 'role:admin,employee','checkBlock'])->name('export_history');
Route::get('/export_history/{id}',[ExportController::class,'show'])->middleware(['auth', 'role:admin,employee','checkBlock'])->name('export.show');
Route::delete('/export_history/{id}',[ExportController::class,'delete'])->middleware(['auth', 'role:admin,employee','checkBlock'])->name('export.delete');

// Used Equipment
Route::resource('/used_equipment',UsedEquipmentController::class)->middleware(['auth', 'role:admin,employee','checkBlock']);
Route::post('/restore_equipment',[RestoreEquipmentController::class,'restoreEquipment'])->middleware(['auth', 'role:admin,employee','checkBlock']);

//delete restore history
Route::delete('/restore_history/{id}',[RestoreEquipmentController::class,'delete'])->middleware(['auth', 'role:admin'])->name('restore_history.delete');

//deleted_equipments
Route::get('/deleted_equipment',[DeletedEquipmentController::class,'index'])->middleware(['auth', 'role:admin,employee','checkBlock']);
Route::delete('/deleted_equipment/{id}',[DeletedEquipmentController::class,'delete'])->middleware(['auth', 'role:admin'])->name('deleted_equipment_destroy');


//sellcart
Route::get('/sell',[SellController::class,'index'])->middleware(['auth', 'role:admin,employee'])->name('sell.index');
Route::post('/sell_cart',[SellController::class,'store'])->middleware('auth');
Route::get('/get_sell_cart',[SellController::class,'getCart'])->middleware('auth');
Route::post('/delete_equipment_in_sell_cart',[SellController::class,'deleteEquipmentInCart'])->middleware('auth');
Route::post('/update_qty_sell_cart',[SellController::class,'updateQty'])->middleware('auth');
Route::post('/update_new_price_sell_cart',[SellController::class,'updateNewPrice'])->middleware('auth');
Route::post('/clearSellCart',[SellController::class,'clearCart'])->middleware('auth');

Route::post('/create_sell_bill',[SellController::class,'storeSellBill'])->middleware(['auth', 'role:admin,employee','checkBlock']);
// list sellbill
Route::get('/sell_bill',[SellController::class,'history'])->middleware(['auth', 'role:admin,employee','checkBlock']);
Route::get('/sell_bill/show/{bill}',[SellController::class,'showSellBill'])->name('sell_bill_details')->middleware(['auth', 'role:admin,employee','checkBlock']);
Route::delete('/sell_bill/{id}',[SellController::class,'delete'])->middleware(['auth', 'role:admin','checkBlock'])->name('sell_bill.delete');


// supplier
Route::resource('/supplier',SupplierController::class)->middleware(['auth', 'role:admin','checkBlock']);
// area
Route::get('/area_list',[AreaController::class,'index'])->middleware(['auth', 'role:admin','checkBlock']);
