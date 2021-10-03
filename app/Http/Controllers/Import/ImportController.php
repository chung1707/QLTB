<?php

namespace App\Http\Controllers\Import;

use App\Http\Controllers\Controller;
use App\Models\ImportbIll;
use Illuminate\Http\Request;

class ImportController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('import.create_import');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return response()->json(dd($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ImportbIll  $importbIll
     * @return \Illuminate\Http\Response
     */
    public function show(ImportbIll $importbIll)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ImportbIll  $importbIll
     * @return \Illuminate\Http\Response
     */
    public function edit(ImportbIll $importbIll)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ImportbIll  $importbIll
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ImportbIll $importbIll)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ImportbIll  $importbIll
     * @return \Illuminate\Http\Response
     */
    public function destroy(ImportbIll $importbIll)
    {
        //
    }
}
