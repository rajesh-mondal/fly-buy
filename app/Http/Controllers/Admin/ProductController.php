<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use Image;
use App\Models\Product;

class ProductController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    //index method
    public function index(Request $request){
        if($request->ajax()){
            $imgurl = 'files/product';
            $product = "";

            $query = DB::table('products')->leftJoin('categories','products.category_id','categories.id')
                ->leftJoin('subcategories','products.subcategory_id','subcategories.id')
                ->leftJoin('brands','products.brand_id','brands.id');

                if($request->category_id){
                    $query->where('products.category_id', $request->category_id);
                }
                if($request->brand_id){
                    $query->where('products.brand_id', $request->brand_id);
                }
                if($request->warehouse){
                    $query->where('products.warehouse', $request->warehouse);
                }
                if($request->status==1){
                    $query->where('products.status', 1);
                }
                if($request->status==0){
                    $query->where('products.status', 0);
                }

            $product = $query->select('products.*','categories.category_name','subcategories.subcategory_name','brands.brand_name')
                ->get();

            return DataTables::of($product)
                ->addIndexColumn()
                ->editColumn('thumbnail',function($row) use ($imgurl) {
                    return '<img src="'.$imgurl.'/'.$row->thumbnail.'" height="30" width="30">';
                })
                ->editColumn('featured',function($row){
                    if ($row->featured==1) {
                        return '<a href="#" data-id="'.$row->id.'" class="deactive_featured"><i class="fas fa-thumbs-down text-danger"> <span class="badge badge-success">active</span> </i></a>';
                    } else {
                        return '<a href="#" data-id="'.$row->id.'" class="active_featured"><i class="fas fa-thumbs-up text-success"> <span class="badge badge-danger">deactive</span> </i></a>';
                    }
                })
                ->editColumn('today_deal',function($row){
                    if ($row->today_deal==1) {
                        return '<a href="#" data-id="'.$row->id.'" class="deactive_deal"><i class="fas fa-thumbs-down text-danger"> <span class="badge badge-success">active</span> </i></a>';
                    } else {
                        return '<a href="#" data-id="'.$row->id.'" class="active_deal"><i class="fas fa-thumbs-up text-success"> <span class="badge badge-danger">deactive</span> </i></a>';
                    }
                })
                ->editColumn('status',function($row){
                    if ($row->status==1) {
                        return '<a href="#" data-id="'.$row->id.'" class="deactive_status"><i class="fas fa-thumbs-down text-danger"> <span class="badge badge-success">active</span> </i></a>';
                    } else {
                        return '<a href="#" data-id="'.$row->id.'" class="active_status"><i class="fas fa-thumbs-up text-success"> <span class="badge badge-danger">deactive</span> </i></a>';
                    }
                })
                ->addColumn('action', function($row){

                    $actionbtn='<a href="#" class="btn btn-info btn-sm edit"><i class="fas fa-pencil-alt"></i></a><a href="#" class="btn btn-primary btn-sm edit"><i class="fas fa-eye"></i></a>
                    <a href="'.route('product.delete',[$row->id]).'" class="btn btn-danger btn-sm" id="delete"><i class="fas fa-trash"></i></a>';

                    return $actionbtn;
                })
                ->rawColumns(['action','category_name','subcategory_name','brand_name','thumbnail','featured','today_deal','status'])
                ->make(true);
        }
        $category = DB::table('categories')->get();
        $brand = DB::table('brands')->get();
        $warehouse = DB::table('warehouses')->get();
        return view('admin.product.index', compact('category','brand','warehouse'));

        return view('admin.product.index');
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

    //not featured
    public function notfeatured($id){
        DB::table('products')->where('id',$id)->update(['featured'=>0]);
        return response()->json('Product Not Featured');
    }

    //active featured
    public function activefeatured($id){
        DB::table('products')->where('id',$id)->update(['featured'=>1]);
        return response()->json('Product Featured Activated');
    }

    //not deal
    public function notdeal($id){
        DB::table('products')->where('id',$id)->update(['today_deal'=>0]);
        return response()->json('Today Deal Deactivated');
    }

    //active deal
    public function activedeal($id){
        DB::table('products')->where('id',$id)->update(['today_deal'=>1]);
        return response()->json('Today Deal Activated');
    }

    //not deal
    public function deactivestatus($id){
        DB::table('products')->where('id',$id)->update(['status'=>0]);
        return response()->json('Status Deactivated');
    }

    //active deal
    public function activestatus($id){
        DB::table('products')->where('id',$id)->update(['status'=>1]);
        return response()->json('Status Activated');
    }

    //delete method
    public function destroy($id){
        DB::table('products')->where('id',$id)->delete();
        $notification = array('message' => 'Successfully Deleted!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
}
