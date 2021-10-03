<?php

namespace App\Http\Controllers\Equipment;

use App\Models\AppConst;
use App\Models\Equipment;
use Illuminate\Http\Request;
use App\Events\EquipmentsCreated;
use App\Http\Controllers\Controller;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $equipments = Equipment::orderBy('id', 'desc')->paginate(AppConst::DEFAULT_PER_PAGE);
        $totalPage = count($equipments);
        $total = Equipment::count('id');
        return view('equipment.list')
        ->with('equipments', $equipments)
        ->with('total', $total)
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
        try{
            $equipments = $request->equipments;
            foreach ($equipments as $item) {
                $equipment = Equipment::where('device_code', '=', $item['device_code'])->first();
                if($equipment){
                    $equipment->quantity += $item['quantity'];
                    $equipment->update();
                }else{
                    $equipment = new Equipment;
                    $equipment->fill($item);
                    if(isset($item['thumbnails'][0])){
                        $equipment->thumbnail = $item['thumbnails'][0];
                    }
                    $equipment->save();
                }
            }
            EquipmentsCreated::dispatch($request->bill);
            return response()->json(['success' => true, 'status' => 201]);
        }catch(\Exception $e){
            return response()->json(['e' => $e, 'status' => 401]);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function show(Equipment $equipment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function edit(Equipment $equipment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Equipment $equipment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Equipment $equipment)
    {
        //
    }
}