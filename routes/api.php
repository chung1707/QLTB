<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\InfoController;
use App\Http\Controllers\Api\ThumbnailController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('uploads',[ThumbnailController::class,'uploads']);

// get info resource
Route::get('categories',[InfoController::class,'getCategories']);
Route::get('suppliers',[InfoController::class,'getSuppliers']);

