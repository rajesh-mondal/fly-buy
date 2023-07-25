<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cart;
use App\Models\Product;

class CartController extends Controller
{
    public function addToCartQuickView(Request $request){
        $product = Product::find($request->id);
        Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'qty' => $request->qty,
            'price' => $request->price,
            'weight' => '1',
            'options' => ['size'=>$request->size, 'color'=>$request->color, 'thumbnail'=>$product->thumbnail]
        ]);
        return response()->json("Added!");
    }

    public function myCart(){
        $content = Cart::content();
        return view('frontend.cart.cart', compact('content'));
    }
}
