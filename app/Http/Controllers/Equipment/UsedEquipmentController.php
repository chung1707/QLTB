<?php

namespace App\Http\Controllers\Equipment;

use App\Models\AppConst;
use Illuminate\Http\Request;
use App\Models\Equipment_Used;
use App\Http\Controllers\Controller;

class UsedEquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $equipments = Equipment_Used::orderBy('id', 'desc')->paginate(AppConst::DEFAULT_PER_PAGE);
        $totalPage = count($equipments);
        $totalEquipment = Equipment_Used::count('id');
        return view('equipment.used_equipments')
        ->with('equipments', $equipments)
        ->with('totalEquipment', $totalEquipment)
        ->with('totalPage', $totalPage);
    }
}
