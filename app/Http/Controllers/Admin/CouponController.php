<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Yajra\DataTables\DataTables;

class CouponController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){
        if($request->ajax()){
            $data=DB::table('coupons')->latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                    $actionbtn='<a href="#" class="btn btn-info btn-sm edit" data-toggle="modal" data-target="#editModal"><i class="fas fa-pencil-alt"></i></a>
                    <a href="'.route('coupon.delete',$row->id).'" class="btn btn-danger btn-sm" id="delete_coupon"><i class="fas fa-trash"></i></a>';

                    return $actionbtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.offer.coupon.index');
    }

    //store method
    public function store(Request $request){
        $data = array(
            'coupon_code' => $request->coupon_code,
            'type' => $request->type,
            'coupon_amount' => $request->coupon_amount,
            'valid_date' => $request->valid_date,
            'status' => $request->status,
        );

        DB::table('coupons')->insert($data);
        return response()->json('Coupon Created');
    }

    //delete coupon method
    public function destroy($id){
        DB::table('coupons')->where('id',$id)->delete();
        return response()->json('Coupon Delete!');
    }
}
