<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use DB;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::with('category')->orderBy('id', 'DESC')->get();
        return view('coupons.index', compact('coupons'));
    }

    public function create()
    {
        $getCategories = DB::table('categories')->where('parent_id', 0)->where('status', 1)->get();
        return view('coupons.create',compact('getCategories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'coupon_code' => 'required|unique:coupons|max:255',
            'discount' => 'required|numeric',
            'discount_type' => 'required|in:0,1',
            // 'status' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'category_id' => 'required',
        ]);

        Coupon::create($request->all());
        return redirect()->route('coupons.index')->with('success', 'Coupon created successfully.');
    }

    public function edit(Coupon $coupon)
    {
        $getCategories = DB::table('categories')->where('parent_id', 0)->where('status', 1)->get();

        return view('coupons.edit', compact('coupon', 'getCategories'));
    }

    public function update(Request $request, Coupon $coupon)
    {   
        $request->validate([
            'coupon_code' => 'required|max:255|unique:coupons,coupon_code,' . $coupon->id,
            'discount' => 'required|numeric',
            'discount_type' => 'required|in:0,1',
            // 'status' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'category_id' => 'required',
        ]);

        $coupon->update($request->all());

        return redirect()->route('coupons.index')->with('success', 'Coupon updated successfully.');
    }

    public function destroy(Coupon $coupon)
    {
        $coupon->delete();

        return redirect()->route('coupons.index')->with('success', 'Coupon deleted successfully.');
    }
}
