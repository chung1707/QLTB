<?php

namespace App\Http\Controllers;

use App\Models\AppConst;
use App\Models\Importbill;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index(){
        $importbills = Importbill::orderBy('id', 'desc')->paginate(AppConst::DEFAULT_PER_PAGE);
        $totalPage = count($importbills);
        $total = Importbill::count('id');
        return view('history.history')->with('importbills',$importbills)
        ->with('totalPage',$totalPage)
        ->with('total',$total);
    }
}
