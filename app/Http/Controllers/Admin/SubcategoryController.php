<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Subcategory;
use App\Models\Category;
use DB;

class SubcategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //index method for read data
    public function index(){
        $data = DB::table('subcategories')->leftjoin('categories','subcategories.category_id','categories.id')->select('subcategories.*','categories.category_name')->get();
        $category = Category::all();
        return view('admin.category.subcategory.index', compact('data','category'));
    }

    //Store method
    public function store(Request $request){
        $validated = $request->validate([
            'subcategory_name' => 'required|max:55',
        ]);

        Subcategory::insert([
            'category_id' => $request->category_id,
            'subcategory_name' => $request->subcategory_name,
            'subcat_slug' => Str::slug($request->subcategory_name, '-')
        ]);

        $notification = array('message' => 'Subcategory Created!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    // Edit subcategory
    public function edit($id){
        $data = Subcategory::findorfail($id);
        $category = Category::all();
        
        return view('admin.category.subcategory.edit', compact('data','category'));
    }

    // Update category 
    public function update(Request $request){
        $subcategory = subcategory::where('id',$request->id)->first();
        $subcategory->update([
            'category_id' => $request->category_id,
            'subcategory_name' => $request->subcategory_name,
            'subcat_slug' => Str::slug($request->subcategory_name, '-')
        ]);

        $notification = array('message' => 'Subcategory Updated!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    // Delete method
    public function destroy($id){
        // DB::table('subcategories')->where('id',$id)->delete(); // Query builder

        // Eloquent ORM
        $subcategory = Subcategory::findorfail($id);
        $subcategory->delete();
        $notification = array('message' => 'Subategory Deleted!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
}
