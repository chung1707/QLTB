<?php

namespace App\Http\Controllers\Export;


use App\Models\AppConst;
use App\Models\Equipment;
use App\Models\Exportbill;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Equipment_Used;
use App\Http\Controllers\Controller;

class ExportController extends Controller
{
    public function index(){
        return view('cart.export');
    }
    public function storeExportBill(Request $request){
        try{
            $bill = new Exportbill;
            $bill->transaction_id = Str::random(AppConst::RANDOM_CODE);
            $bill->area_id = $request->exportBill['area_id'];
            $bill->user_id = auth()->user()->id;
            $bill->save();
            foreach($request->exportBill['items'] as $item){
                $usedEquipment = Equipment_Used::firstOrNew(
                    [
                        'equipment_id' => $item['id'],
                        'area_id' => $bill->area_id
                    ],
                );
                $usedEquipment->status = 'Tốt';
                $usedEquipment->quantity += $item['pivot']['quantity'];
                $usedEquipment->save();
                $equip = Equipment::find($item['id']);
                $bill->equipments()->attach($equip,['quantity' => $item['pivot']['quantity']]);
        }
            return response()->json(['status' => 201]);
        }catch(\Exception $e){
            return response()->json(['status' => 401, 'error' => $e]);
        }
    }
    public function exportToRoom(Request $request){
        try{
            $bill = new Exportbill;
            $bill->transaction_id = Str::random(AppConst::RANDOM_CODE);
            $bill->room_id = $request->exportBill['room_id'];
            $bill->user_id = auth()->user()->id;
            $bill->save();
            foreach($request->exportBill['items'] as $item){
                $usedEquipment = Equipment_Used::firstOrNew(
                    [
                        'equipment_id' => $item['id'],
                        'room_id' => $bill->room_id
                    ],
                );
                $usedEquipment->status = 'Tốt';
                $usedEquipment->quantity += $item['pivot']['quantity'];
                $usedEquipment->save();
                $equip = Equipment::find($item['id']);
                $bill->equipments()->attach($equip,['quantity' => $item['pivot']['quantity']]);
        }
            return response()->json(['status' => 201]);
        }catch(\Exception $e){
            return response()->json(['status' => 401, 'error' => $e]);
        }
    }
    public function history(){
        $bills = Exportbill::orderBy('id','desc')->paginate(AppConst::DEFAULT_PER_PAGE);
        $totalPage = count($bills);
        $total = Exportbill::count('id');
        return view('history.export_history')
        ->with('totalPage',$totalPage)
        ->with('total',$total)
        ->with('bills',$bills);
    }
    public function show($id){
        $bill = Exportbill::find($id);
        $items = $bill->equipments;
        return view('history.export_history_details')
        ->with('bill', $bill)
        ->with('items', $items);
    }
}
