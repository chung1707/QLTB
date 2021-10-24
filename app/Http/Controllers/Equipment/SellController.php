<?php

namespace App\Http\Controllers\Equipment;

use App\Models\AppConst;
use App\Models\Sellbill;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\DeletedEquipment;
use App\Http\Controllers\Controller;

class SellController extends Controller
{
    public function index(){
        return view('sell.sell');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $equipment = DeletedEquipment::find($request->equipment_id);
        $cart = auth()->user()->sellCart;
        $itemInCart = $cart->deletedEquipments()->where('deleted_equipment_id', '=', $equipment->id)->first();
        if (empty($itemInCart)) {
            $cart->deletedEquipments()->attach($equipment);
        } else {
            $quantity = $itemInCart->pivot->quantity;
            if($quantity+1 > $itemInCart->quantity){
                $cart->deletedEquipments()->updateExistingPivot($equipment, [
                    'quantity' => $equipment->quantity,
                ]);
            }
            else{
                $cart->deletedEquipments()->updateExistingPivot($equipment, [
                    'quantity' => $quantity + 1,
                ]);
            }
        }
    }
    public function getCart()
    {
        $cart = auth()->user()->sellCart;
        $equipments = $cart->deletedEquipments()->get();
        $equipments->load('equipment');
        $totalEquipments = $cart->deletedEquipments->sum('pivot.quantity');
        return response()->json(['equipments' => $equipments, 'totalEquipments' => $totalEquipments]);
    }
    public function deleteEquipmentInCart(Request $request)
    {
        $cart = auth()->user()->sellCart;
        $equipment = DeletedEquipment::find($request->equipment_id);
        $cart->deletedEquipments()->detach($equipment);
    }
    public function updateQty(Request $request)
    {
        $newQty = $request->newQuanty;
        $cart = auth()->user()->sellCart;
        $equipment = $cart->deletedEquipments()->where('deleted_equipment_id', '=', $request->equipment_id)->first();
        $cart->deletedEquipments()->updateExistingPivot($equipment, [
            'quantity' => $equipment->pivot->quantity + ($newQty - $equipment->pivot->quantity),
        ]);
        return response()->json(['qty' => $equipment->pivot->quantity]);
    }
    public function clearCart(){
        $cart = auth()->user()->sellCart;
        $cart->deletedEquipments()->detach();
    }
    public function updateNewPrice(Request $request){
        $newPrice = $request->newPrice;
        $cart = auth()->user()->sellCart;
        $equipment = $cart->deletedEquipments()->where('deleted_equipment_id', '=', $request->equipment_id)->first();
        $cart->deletedEquipments()->updateExistingPivot($equipment, [
            'newPrice' => $newPrice,
        ]);
        return response()->json(['newPrice' => $newPrice]);
    }
    // hoa don
    public function storeSellBill(Request $request){
        try{
            //tao hoa don
            $bill = new Sellbill;
            $bill->fill($request->sellBill);
            $bill->user_id = auth()->user()->id;
            $bill->transaction_id = Str::random(AppConst::RANDOM_CODE);
            $bill->save();
            // gan thiet bi vao hoa don
            $equipments = $request->sellBill['items'];
            foreach($equipments as $equipment){
                $item = DeletedEquipment::find($equipment['id']);
                $bill->deletedEquipments()->attach(
                    $item,
                    ['quantity' => $equipment['pivot']['quantity'], 'price' => $equipment['pivot']['newPrice']]
                );
                $item->quantity -= $equipment['pivot']['quantity'];
                if($item->quantity ==0){
                    $item->sold = true;
                }
                $item->update();
            }
            return response()->json(['status' => '201', 'bill_id' => $bill->id]);
        }catch(\Exception $e){
            return response()->json(['status' => '401', 'error' => $e]);
        }
    }
    // history sellbill
    public function history(){
        $bills = Sellbill::orderBy('id','desc')->paginate(AppConst::DEFAULT_PER_PAGE);
        return view('sell.list')->with('bills', $bills);
    }
    public function showSellBill(SellBill $bill){
        $items = $bill->deletedEquipments;
        $items->load('equipment');
        return view('sell.details')
        ->with('bill', $bill)
        ->with('items', $items);
    }
}
