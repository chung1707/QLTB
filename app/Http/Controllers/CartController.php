<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Equipment;
use Illuminate\Http\Request;

class CartController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $equipment = Equipment::find($request->equipment_id);
        $cart = auth()->user()->cart;
        $itemInCart = $cart->equipments()->where('equipment_id', '=', $equipment->id)->first();
        if (empty($itemInCart)) {
            $cart->equipments()->attach($equipment);
        } else {
            $quantity = $itemInCart->pivot->quantity;
            if($quantity+1 > $itemInCart->quantity){
                $cart->equipments()->updateExistingPivot($equipment, [
                    'quantity' => $equipment->quantity,
                ]);
            }
            else{
                $cart->equipments()->updateExistingPivot($equipment, [
                    'quantity' => $quantity + 1,
                ]);
            }
        }
    }
    public function getCart()
    {
        $cart = auth()->user()->cart;
        $equipments = $cart->equipments()->get();
        $totalEquipments = $cart->equipments->sum('pivot.quantity');
        return response()->json(['equipments' => $equipments, 'totalEquipments' => $totalEquipments]);
    }
    public function deleteEquipmentInCart(Request $request)
    {
        $cart = auth()->user()->cart;
        $equipment = Equipment::find($request->equipment_id);
        $cart->equipments()->detach($equipment);
    }
    public function updateQty(Request $request)
    {
        $newQty = $request->newQuanty;
        $cart = auth()->user()->cart;
        $equipment = $cart->equipments()->where('equipment_id', '=', $request->equipment_id)->first();
        $cart->equipments()->updateExistingPivot($equipment, [
            'quantity' => $equipment->pivot->quantity + ($newQty - $equipment->pivot->quantity),
        ]);
        return response()->json(['qty' => $equipment->pivot->quantity]);
    }
    public function clearCart(){
        $cart = auth()->user()->cart;
        $cart->equipments()->detach();
    }
}
