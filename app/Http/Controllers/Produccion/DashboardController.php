<?php

namespace App\Http\Controllers\Produccion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __Construct(){

        $this->middleware('auth');
        $this->middleware('IsProduccion');


    }

    public function getDashboard(){
        return view('produccion.dashboard');
    }
}
