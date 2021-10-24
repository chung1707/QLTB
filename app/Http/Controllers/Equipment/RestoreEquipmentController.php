<?php

namespace App\Http\Controllers\Equipment;

use App\Models\AppConst;
use App\Models\Equipment;
use Illuminate\Http\Request;
use App\Models\Equipment_Used;
use App\Models\DeletedEquipment;
use App\Http\Controllers\Controller;
use App\Models\HistoryRestoreEquipment;

class RestoreEquipmentController extends Controller
{
    public function restoreEquipment(Request $request){
        if($request->state == 0){
            $item = Equipment::find($request->equipment_id);
            $item->quantity += $request->quantity;
            $item->update();
            $usedEquipmentQuery = Equipment_Used::where('id','=', $request->usedItem_id);
            if($request->area_id !== 'null'){
                $usedEquipment = $usedEquipmentQuery->whereHas('area', function($query) use($request){
                    $query->where('area_id','=',$request->area_id);
                })->first();
                $usedEquipment->room_id = null;
            }else{
                $usedEquipment = $usedEquipmentQuery->whereHas('room', function($query) use($request){
                    $query->where('room_id', '=', $request->room_id);
                })->first();
                $usedEquipment->area_id = null;
            }
            $usedEquipment->quantity -= $request->quantity;
            if($usedEquipment->quantity == 0){
                $usedEquipment->delete();
            }else{
                $usedEquipment->update();
            }
            $history = new HistoryRestoreEquipment;
            $history->fill($request->all());
            $history->user_id = auth()->user()->id;
            $history->area_id = $usedEquipment->area_id;
            $history->room_id = $usedEquipment->room_id;
            $history->locate = "Kho thiết bị.";
            $history->save();
            return response()->json(['status' => 201]);
        }
        if($request->state == 1){
            $deletedEquipment = DeletedEquipment::firstOrNew([
                'equipment_id' => $request->equipment_id,
            ]);
            if($deletedEquipment->quantity && !$deletedEquipment->note){
                $deletedEquipment->quantity += $request->quantity;
                $deletedEquipment->update();
            }else{
                $deletedEquipment->fill(request()->all());
                $deletedEquipment->save();
            }
            $usedEquipmentQuery = Equipment_Used::where('id',$request->usedItem_id);
            if($request->area_id !== 'null'){
                $usedEquipment = $usedEquipmentQuery->whereHas('area', function($query) use($request){
                    $query->where('area_id','=',$request->area_id);
                })->first();
                $usedEquipment->room_id = null;
            }else{
                $usedEquipment = $usedEquipmentQuery->whereHas('room', function($query) use($request){
                    $query->where('room_id', '=', $request->room_id);
                })->first();
                $usedEquipment->area_id = null;
            }
            $usedEquipment->quantity -= $request->quantity;
            if($usedEquipment->quantity == 0){
                $usedEquipment->delete();
            }else{
                $usedEquipment->update();
            }
            $history = new HistoryRestoreEquipment;
            $history->fill($request->all());
            $history->user_id = auth()->user()->id;
            $history->area_id = $usedEquipment->area_id;
            $history->room_id = $usedEquipment->room_id;
            $history->locate = "Kho thiết bị hư hỏng.";
            $history->note = $request->note;
            $history->save();
            return response()->json(['status' => 201]);
        }
    }
    public function restoreHistory(){
        $restoreHistory = HistoryRestoreEquipment::orderBy('id','desc')->with('equipment','user')->paginate(AppConst::DEFAULT_PER_PAGE);
        return view('history.restore_history')->with('restoreHistory', $restoreHistory);
    }
    public function delete($id){
        HistoryRestoreEquipment::find($id)->delete();
        return redirect()->back();
    }
}
