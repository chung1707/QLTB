<?php

namespace App\Http\Controllers\Admin\Supplier;

use App\Models\AppConst;
use App\Models\Supplier;
use App\Models\Equipment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::orderBy('id', 'desc')->paginate(AppConst::DEFAULT_PER_PAGE);
        $total = Supplier::count('id');
        $totalPage = count($suppliers);
        return view('admin.supplier.list')
        ->with('suppliers', $suppliers)
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
        return view('admin.supplier.add');
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
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        $total = $supplier->equipments()->count('id');
        $mostItem = Equipment::whereHas('supplier', function($query) use($supplier){
            $query->where('supplier_id','=',$supplier->id);
        })->orderBy('quantity', 'desc')->first();
        return view('admin.supplier.details')
        ->with('supplier', $supplier)
        ->with('mostItem', $mostItem)
        ->with('total', $total);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        return view('admin.supplier.edit')->with('supplier', $supplier);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        //
    }
}
