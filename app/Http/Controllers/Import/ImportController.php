<?php

namespace App\Http\Controllers\Import;

use App\Models\Importbill;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ImportController extends Controller
{
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
     * Display the specified resource.
     *
     * @param  \App\Models\Importbill  $importbill
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $importbill = Importbill::find($id);
        $equipments = $importbill->equipments;
        return view('history.history_details')
        ->with('importbill', $importbill)
        ->with('equipments', $equipments);
    }
     /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Importbill  $importbill
     * @return \Illuminate\Http\Response
     */
    public function destroy(Importbill $importbill)
    {
        $importbill->delete();
        return redirect()->back();
    }
}
