<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use Illuminate\Support\Str;
use Image;

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
        $validated = $request->validate([
            'name' => 'required',
            'code' => 'required|unique:products|max:55',
            'subcategory_id' => 'required',
            'brand_id' => 'required',
            'unit' => 'required',
            'selling_price' => 'required',
            'color' => 'required',
            'description' => 'required',
        ]);

        $subcategory = DB::table('subcategories')->where('id',$request->subcategory_id)->first();
        $slug = Str::slug($request->name, '-');

        $data = array();
        $data['name'] = $request->name;
        $data['slug'] = Str::slug($request->name, '-');
        $data['code'] = $request->code;
        $data['category_id'] = $subcategory->category_id;
        $data['subcategory_id'] = $request->subcategory_id;
        $data['childcategory_id'] = $request->childcategory_id;
        $data['brand_id'] = $request->brand_id;
        $data['pickup_point_id'] = $request->pickup_point_id;
        $data['unit'] = $request->unit;
        $data['tags'] = $request->tags;
        $data['purchase_price'] = $request->purchase_price;
        $data['selling_price'] = $request->selling_price;
        $data['discount_price'] = $request->discount_price;
        $data['warehouse'] = $request->warehouse;
        $data['stock_quantity'] = $request->stock_quantity;
        $data['color'] = $request->color;
        $data['size'] = $request->size;
        $data['description'] = $request->description;
        $data['video'] = $request->video;
        $data['featured'] = $request->featured;
        $data['today_deal'] = $request->today_deal;
        $data['status'] = $request->status;
        $data['admin_id'] = Auth::id();
        $data['date'] = date('d-m-Y');
        $data['month'] = date('F');

        if($request->thumbnail){
            $thumbnail = $request->thumbnail;
            $thumbnailname = $slug.'.'.$thumbnail->getClientOriginalExtension();
            $thumbnail->move('files/product/',$thumbnailname); //without image intervention
            // Image::make($photo)->resize(600, 600)->save('files/product/'.$thumbnailname); //Image intervention

            $data['thumbnail'] = $thumbnailname;
        }

        //multiple image
        $images = array();
        if($request->hasFile('images')){
            foreach ($request->file('images') as $key => $image) {
                $imageName = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
                $image->move('files/product/',$imageName);
                array_push($images, $imageName);
            }
            $data['images'] = json_encode($images);
        }

        DB::table('products')->insert($data);

        $notification = array('message' => 'Product Added', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
}
