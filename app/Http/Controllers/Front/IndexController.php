<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use DB;

class IndexController extends Controller {
    //root page
    public function index() {
        $category = DB::table( 'categories' )->get();
        $banner_product = Product::where( 'status', 1 )->where( 'product_slider', 1 )->latest()->first();
        $featured = Product::where( 'status', 1 )->where( 'featured', 1 )->orderBy( 'id', 'DESC')->limit(16)->get();
        $popular_product = Product::where( 'status', 1 )->orderBy( 'product_views', 'DESC')->limit(16)->get();
        $trendy_product = Product::where( 'status', 1 )->where( 'trendy', 1 )->orderBy( 'id', 'DESC')->limit(8)->get();
        $home_category = DB::table( 'categories' )->where('home_page', 1)->orderBy('category_name','ASC')->get();
        return view( 'frontend.index', compact( 'category', 'banner_product', 'featured', 'popular_product', 'trendy_product', 'home_category' ) );
    }

    //single product page calling method
    public function productDetails( $slug ) {
        $product = Product::where( 'slug', $slug )->first();
        Product::where( 'slug', $slug )->increment( 'product_views' );
        $related_product = DB::table( 'products' )->where( 'subcategory_id', $product->subcategory_id )->orderBy( 'id', 'DESC' )->take( 10 )->get();
        $review = Review::where( 'product_id', $product->id )->take( 6 )->get();
        return view( 'frontend.product.product_details', compact( 'product', 'related_product', 'review' ) );
    }

    //prodduct quick view
    public function productQuickView( $id ){
        $product = Product::where( 'id', $id )->first();
        return view( 'frontend.product.quick_view', compact('product') );
    }
}
