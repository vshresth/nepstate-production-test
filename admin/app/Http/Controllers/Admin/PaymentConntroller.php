<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentPlan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class PaymentConntroller extends Controller
{
    public function index()
    {
        $payments = PaymentPlan::all();
        return view('payment.index', compact('payments'));
    }
    public function create(){
        return view('payment.create');
    }
    public function store(Request $request)
    {
       
        $validatedData = $request->validate([
            'title' => 'required|string',
            'months' => 'required|integer|min:1|max:12',
            'amount' => 'required|numeric',
            'status' => 'required|in:0,1',
            'category_home_page' => 'nullable|numeric',
            'website_home_category_section' => 'nullable|numeric',
            'website_home_banner' => 'nullable|numeric',
            'home_middle' => 'nullable|numeric',
            'web_footer' => 'nullable|numeric',
            'blog' => 'nullable|numeric',
            'cat_right' => 'nullable|numeric',
            'confession' => 'nullable|numeric',
            'forum' => 'nullable|numeric',
        ]);
        $defaultCID = '1,2,3,4,5';

        $payment = new PaymentPlan();
        $payment->title = $validatedData['title'];
        $payment->months = $validatedData['months'];
        $payment->amount = number_format($validatedData['amount'], 2, '.', ''); 
        $payment->status = $validatedData['status'];
        $payment->category_home_page = isset($validatedData['category_home_page']) ? number_format($validatedData['category_home_page'], 2, '.', '') : null;
        $payment->website_home_category_section = isset($validatedData['website_home_category_section']) ? number_format($validatedData['website_home_category_section'], 2, '.', '') : null;
        $payment->website_home_banner = isset($validatedData['website_home_banner']) ? number_format($validatedData['website_home_banner'], 2, '.', '') : null;
        $payment->home_middle = isset($validatedData['home_middle']) ? number_format($validatedData['home_middle'], 2, '.', '') : null;
        $payment->web_footer = isset($validatedData['web_footer']) ? number_format($validatedData['web_footer'], 2, '.', '') : null;
        $payment->blog = isset($validatedData['blog']) ? number_format($validatedData['blog'], 2, '.', '') : null;
        $payment->cat_right = isset($validatedData['cat_right']) ? number_format($validatedData['cat_right'], 2, '.', '') : null;
        $payment->confession = isset($validatedData['confession']) ? number_format($validatedData['confession'], 2, '.', '') : null;
        $payment->forum = isset($validatedData['forum']) ? number_format($validatedData['forum'], 2, '.', '') : null;
        $payment->cID = $defaultCID;
        $payment->save();

        return redirect()->route('payment.index')->with('success', 'Payment record created successfully.');
    }
    public function edit($id)
    {
        $payment = PaymentPlan::findOrFail($id);
        $categories = DB::table('categories')->where('parent_id', 0)->get();
        return view('payment.edit', compact('payment','categories'));
    }

    public function update(Request $request, $id)
    {
       
        $payment = PaymentPlan::findOrFail($id);
        if(!$request->amount) {
            $validatedData = $request->validate([
                'title' => 'required|string',
                'months' => 'required|integer',
                'status' => 'required|in:0,1',
                "free_listings_count" => 'required|numeric',
            ]);

            $payment->cID = isset($request->category) ? implode(',',$request->category) : '';
            $payment->title = $validatedData['title'];
            $payment->months = $validatedData['months'];
            $payment->status = $validatedData['status'];
            $payment->free_listings_count = $validatedData['free_listings_count'];
            $payment->save();

            return redirect()->route('payment.index')->with('success', 'Payment plan updated successfully.');

        }else{
            $validatedData = $request->validate([
                'title' => 'required|string',
                'months' => 'required|integer|min:1|max:12',
                'amount' => 'required|numeric',
                'status' => 'required|in:0,1',
                'category_home_page' => 'nullable|numeric',
                'website_home_category_section' => 'nullable|numeric',
                'website_home_banner' => 'nullable|numeric',
                'home_middle' => 'nullable|numeric',
                'web_footer' => 'nullable|numeric',
                'blog' => 'nullable|numeric',
                'cat_right' => 'nullable|numeric',
                'confession' => 'nullable|numeric',
                'forum' => 'nullable|numeric',
            ]);

            $payment->title = $validatedData['title'];
            $payment->months = $validatedData['months'];
            $payment->amount = number_format($validatedData['amount'], 2, '.', ''); 
            $payment->status = $validatedData['status'];
            $payment->category_home_page = isset($validatedData['category_home_page']) ? number_format($validatedData['category_home_page'], 2, '.', '') : null;
            $payment->website_home_category_section = isset($validatedData['website_home_category_section']) ? number_format($validatedData['website_home_category_section'], 2, '.', '') : null;
            $payment->website_home_banner = isset($validatedData['website_home_banner']) ? number_format($validatedData['website_home_banner'], 2, '.', '') : null;
            $payment->home_middle = isset($validatedData['home_middle']) ? number_format($validatedData['home_middle'], 2, '.', '') : null;
            $payment->web_footer = isset($validatedData['web_footer']) ? number_format($validatedData['web_footer'], 2, '.', '') : null;
            $payment->blog = isset($validatedData['blog']) ? number_format($validatedData['blog'], 2, '.', '') : null;
            $payment->cat_right = isset($validatedData['cat_right']) ? number_format($validatedData['cat_right'], 2, '.', '') : null;
            $payment->confession = isset($validatedData['confession']) ? number_format($validatedData['confession'], 2, '.', '') : null;
            $payment->forum = isset($validatedData['forum']) ? number_format($validatedData['forum'], 2, '.', '') : null;
            $payment->save();

            return redirect()->route('payment.index')->with('success', 'Payment plan updated successfully.');

        }

        
    }


    public function destroy($id)
    {
        $payment = PaymentPlan::findOrFail($id);
        $payment->delete();
        return redirect()->route('payment.index')->with('success', 'Payment plan deleted successfully.');
    }
}
