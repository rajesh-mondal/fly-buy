<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use DB;

class IndexController extends Controller
{
    //root page
    public function index(){
        $category = DB::table('categories')->get();
        $banner_product = Product::where('product_slider', 1)->latest()->first();
        return view('frontend.index', compact('category','banner_product'));
    }

    //single product page calling method
    public function productDetails($slug){
        $product = Product::where('slug',$slug)->first();
        $related_product = DB::table('products')->where('subcategory_id', $product->subcategory_id)->orderBy('id','DESC')->limit(10)->get();
        $review = Review::where('product_id',$product->id)->get();
        return view('frontend.product_details', compact('product','related_product','review'));
    }
}
