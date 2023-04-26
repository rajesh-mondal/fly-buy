<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Image;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //seo page show method
    public function seo(){
        $data = DB::table('seos')->first();
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

    //smtp setting show
    public function smtp(){
        $smtp = DB::table('smtp')->first();
        return view('admin.setting.smtp', compact('smtp'));
    }

    //smtp setting update
    public function smtpUpdate(Request $request, $id){
        $data = array();
        $data['mailer'] = $request->mailer;
        $data['host'] = $request->meta_author;
        $data['port'] = $request->meta_tag;
        $data['user_name'] = $request->user_name;
        $data['password'] = $request->password;
        DB::table('smtp')->where('id',$id)->update($data);

        $notification = array('message' => 'SMTP Setting Updated!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    //website setting
    public function websiteSetting(){
        $setting = DB::table('settings')->first();
        return view('admin.setting.website_setting', compact('setting'));
    }

    //website setting update
    public function websiteSettingUpdate(Request $request,$id){
        $data = array();
        $data['currency'] = $request->currency;
        $data['phone_one'] = $request->phone_one;
        $data['phone_two'] = $request->phone_two;
        $data['main_email'] = $request->main_email;
        $data['support_email'] = $request->support_email;
        $data['address'] = $request->address;
        $data['facebook'] = $request->facebook;
        $data['twitter'] = $request->twitter;
        $data['instagram'] = $request->instagram;
        $data['linkedin'] = $request->linkedin;
        $data['youtube'] = $request->youtube;

        if ($request->logo) {
            $logo = $request->logo;
            $logo_name = uniqid().'.'.$logo->getClientOriginalExtension();
            $logo->move('files/setting/',$logo_name); //without image intervention
            // Image::make($logo)->resize(320, 120)->save('files/setting/'.$logo_name); //Image intervention
            $data['logo'] = 'files/setting/'.$logo_name;
        }else{
            $data['logo'] = $request->old_logo;
        }

        if ($request->favicon) {
            $favicon = $request->favicon;
            $favicon_name = uniqid().'.'.$favicon->getClientOriginalExtension();
            $favicon->move('files/setting/',$favicon_name); //without image intervention
            // Image::make($favicon)->resize(320, 120)->save('files/setting/'.$favicon_name); //Image intervention
            $data['favicon'] = 'files/setting/'.$favicon_name;
        }else{
            $data['favicon'] = $request->old_favicon;
        }

        DB::table('settings')->where('id',$id)->update($data);

        $notification = array('message' => 'Website Setting Updated!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
}
