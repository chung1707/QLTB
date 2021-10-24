<?php

namespace App\Http\Controllers\Admin;

use App\Models\Area;
use App\Models\AppConst;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AreaController extends Controller
{
    public function index(){
        $areas = Area::orderBy('id','desc')->paginate(AppConst::DEFAULT_PER_PAGE);
        return view('area.list')->with('areas', $areas);
    }
}
