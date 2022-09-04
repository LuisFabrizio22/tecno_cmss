<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Category;

class ApiController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('IsAdmin');
    }

    public function getSubCategories($parent){
        $categories=Category::where('parent', $parent)->get();
        return response()->json($categories);

    }
}
