<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InfoController extends Controller
{
    public function getSuppliers(){
        $suppliers = Supplier::all();
        return response()->json(['suppliers' => $suppliers]);
    }
    public function getCategories(){
        $categories = Category::all();
        return response()->json(['categories' => $categories]);
    }
}
