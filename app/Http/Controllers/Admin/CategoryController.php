<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // All category showing method
    public function index(){
        // $data = DB::table('categories')->get(); //query builder
        $data = Category::all();
        return view('admin.category.category.index', compact('data'));
    }

    // store method
    public function store(Request $request){
        $validated = $request->validate([
            'category_name' => 'required|unique:categories|max:55',
        ]);

        //Query builder
        // $data = array();
        // $data['category_name'] = $request->category_name;
        // $data['category_slug'] = Str::slug($request->category_name, '-');
        // DB::table('categories')->insert($data);

        //Eloquent ORM
        Category::insert([
            'category_name' => $request->category_name,
            'category_slug' => Str::slug($request->category_name, '-')
        ]);

        $notification = array('message' => 'Category Created', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    // Edit category method
    public function edit($id){
        // $data=DB::table('categories')->where('id',$id)->first();

        $data=Category::findorfail($id);
        return response()->json($data);
    }

    // Update category method
    public function update(Request $request){
        // Query Builder
        // $data =array();
        // $data['category_name'] = $request->category_name;
        // $data['category_slug'] = Str::slug($request->category_name, '-');
        // DB::table('categories')->where('id',$request->id)->update($data);

        // Eloquent ORM
        $category = Category::where('id',$request->id)->first();
        $category->update([
            'category_name'=>$request->category_name,
            'category_slug' => Str::slug($request->category_name, '-')
        ]);

        $notification = array('message' => 'Category Updated', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    // Delete category method
    public function destroy($id){
        // Query Builder
        // DB::table('categories')->where('id',$id)->delete();

        // Eloquent ORM
        $category = Category::find($id);
        $category->delete();
        $notification = array('message' => 'Category Deleted', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    //get childcategory method
    public function GetChildCategory($id){
        $data = DB::table('childcategories')->where('subcategory_id',$id)->get();
        return response()->json($data);
    }
}
