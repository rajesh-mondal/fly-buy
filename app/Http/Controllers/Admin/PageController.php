<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $page = DB::table('pages')->latest()->get();
        return view('admin.setting.page.index', compact('page'));
    }

    //create method
    public function create(){
        return view('admin.setting.page.create');
    }

    //store method
    public function store(Request $request){
        $data = array();
        $data['page_position'] = $request->page_position;
        $data['page_name'] = $request->page_name;
        $data['page_slug'] = Str::slug($request->page_name, '-');
        $data['page_title'] = $request->page_title;
        $data['page_description'] = $request->page_description;
        DB::table('pages')->insert($data);

        $notification = array('message' => 'Page Created!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
}
