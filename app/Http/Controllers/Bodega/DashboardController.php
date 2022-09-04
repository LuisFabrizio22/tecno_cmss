<?php

namespace App\Http\Controllers\Bodega;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __Construct(){

        $this->middleware('auth');
        $this->middleware('IsBodega');


    }
   public function getDashboard(){
       return view('bodega.dashboard');
   }
}
