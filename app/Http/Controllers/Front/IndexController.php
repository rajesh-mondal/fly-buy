<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use DB;

class IndexController extends Controller
{
    public function index(){
        $category = DB::table('categories')->get();
        $banner_product = Product::where('product_slider', 1)->latest()->first();
        return view('frontend.index', compact('category','banner_product'));
    }
}
