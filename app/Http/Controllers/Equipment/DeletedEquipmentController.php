<?php

namespace App\Http\Controllers\Equipment;

use App\Models\AppConst;
use Illuminate\Http\Request;
use App\Models\DeletedEquipment;
use App\Http\Controllers\Controller;

class DeletedEquipmentController extends Controller
{
    public function index(){
        $equipments = DeletedEquipment::orderBy('id', 'desc')->paginate(AppConst::DEFAULT_PER_PAGE);
        $totalEquipment = count($equipments);
        return view('equipment.deleted_equipment')
        ->with('equipments', $equipments)
        ->with('totalEquipment', $totalEquipment);
    }
}
