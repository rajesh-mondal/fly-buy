<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //seo page show method
    public function seo(){
        $data = DB::table('seos')->first();
        // return $data;
        return view('admin.setting.seo', compact('data'));
    }

    //update seo method
    public function seoUpdate(Request $request, $id){
        $data = array();
        $data['meta_title'] = $request->meta_title;
        $data['meta_author'] = $request->meta_author;
        $data['meta_tag'] = $request->meta_tag;
        $data['meta_keyword'] = $request->meta_keyword;
        $data['meta_description'] = $request->meta_description;
        $data['google_verification'] = $request->google_verification;
        $data['alexa_verification'] = $request->alexa_verification;
        $data['google_analytics'] = $request->google_analytics;
        $data['google_adsense'] = $request->google_adsense;
        DB::table('seos')->where('id',$id)->update($data);

        $notification = array('message' => 'SEO Setting Updated!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
}
