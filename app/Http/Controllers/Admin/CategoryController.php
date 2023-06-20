<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Category;
use Illuminate\Support\Str;
use Image;
use File;

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
            'icon' => 'required',
        ]);

        //Query builder
        // $data = array();
        // $data['category_name'] = $request->category_name;
        // $data['category_slug'] = Str::slug($request->category_name, '-');
        // DB::table('categories')->insert($data);

        $slug = Str::slug($request->category_name, '-');
        $photo = $request->icon;
        $photoname = $slug.'.'.$photo->getClientOriginalExtension();
        $photo->move('files/category/',$photoname);
        // $data['icon'] = 'files/category/'.$photoname;

        //Eloquent ORM
        Category::insert([
            'category_name' => $request->category_name,
            'category_slug' => Str::slug($request->category_name, '-'),
            'home_page' => $request->home_page,
            'icon' => 'files/category/'.$photoname,
        ]);

        $notification = array('message' => 'Category Created', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    // Edit category method
    public function edit($id){
        // $data=DB::table('categories')->where('id',$id)->first();
        $data=Category::findorfail($id);
        return view('admin.category.category.edit', compact('data'));
    }

    // Update category method
    public function update(Request $request){
        // Eloquent ORM
        /* $category = Category::where('id',$request->id)->first();
        $category->update([
            'category_name'=>$request->category_name,
            'category_slug' => Str::slug($request->category_name, '-')
        ]); */

        $slug = Str::slug($request->category_name, '-');

        $data = array();
        $data['category_name'] = $request->category_name;
        $data['category_slug'] = $slug;
        $data['home_page'] = $request->home_page;

        if($request->icon){
            if(File::exists($request->old_icon)){
                unlink($request->old_icon);
            }
            $photo = $request->icon;
            $photoname = $slug.'.'.$photo->getClientOriginalExtension();
            $photo->move('files/category/',$photoname); //without image intervention
            // Image::make($photo)->resize(240, 120)->save('files/category/'.$photoname); //Image intervention
            $data['icon'] = 'files/category/'.$photoname;
            DB::table('categories')->where('id', $request->id)->update($data);

            $notification = array('message' => 'Category Updated!', 'alert-type' => 'success');
            return redirect()->back()->with($notification);
        }else{
            $data['icon'] = 'files/category/'.$request->old_icon;
            DB::table('categories')->where('id', $request->id)->update($data);
            $notification = array('message' => 'Category Updated!', 'alert-type' => 'success');
            return redirect()->back()->with($notification);
        }

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
