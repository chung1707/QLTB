<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Equipment;
use App\Models\Importbill;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totalEquipment  = Equipment::count('id');
        $totalAccount   = User::count('id');
        $totalImportbill = Importbill::count('id');
        return view('home')->with('totalEquipment', $totalEquipment)
        ->with('totalAccount', $totalAccount)
        ->with('totalImportbill', $totalImportbill);
    }
}
