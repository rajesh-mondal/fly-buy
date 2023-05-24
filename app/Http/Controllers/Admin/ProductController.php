<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class ProductController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    //create method
    public function create(){
        $category = DB::table('categories')->get();
        $brand = DB::table('brands')->get();
        $warehouse = DB::table('warehouses')->get();
        $pickup_point = DB::table('pickup_point')->get();

        return view('admin.product.create', compact('category','brand','warehouse','pickup_point'));
    }

    //store method
    public function store(Request $request){
        dd($request->all());
    }

}
