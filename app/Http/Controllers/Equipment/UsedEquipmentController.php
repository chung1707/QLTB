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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Equipment_Used  $equipment_Used
     * @return \Illuminate\Http\Response
     */
    public function show(Equipment_Used $equipment_Used)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Equipment_Used  $equipment_Used
     * @return \Illuminate\Http\Response
     */
    public function edit(Equipment_Used $equipment_Used)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Equipment_Used  $equipment_Used
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Equipment_Used $equipment_Used)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Equipment_Used  $equipment_Used
     * @return \Illuminate\Http\Response
     */
    public function destroy(Equipment_Used $equipment_Used)
    {
        //
    }
}
