<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Settings::all();
        return view('setting', compact('settings'));
    }

    public function update(Request $request)
    {

        $validatedData = $request->validate([
            'site_title' => 'required|string',
            'site_logo' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            // 'site_logo_small' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            // 'site_favicon' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'mobile' => 'required|string',
            'email' => 'required|email',
            // 'copy_right' => 'required|string',
            'facebook' => 'nullable|string',
            'instagram' => 'nullable|string',
            'twitter' => 'nullable|string',
            'linkedin' => 'nullable|string',
            'snapchat' => 'nullable|string', //i am saving pinterest url in snapchat
            // 'skype' => 'nullable|string',
            // 'youtube' => 'nullable|string',
            // 'frontend_url' => 'nullable|string',
            'address' => 'required|string',
            'map_address' => 'nullable|string',
            'confession_rules' => 'required|string',
            'paragraph' => 'required|string',
            'forum_rules' => 'required|string',
            // 'google_ads' => 'required|string',
            'event' => 'required|boolean',
            'mainheading' => 'required|string',
            'subheading' => 'required|string',
            'list_view' => 'required|boolean',
            'no_of_lists' => 'required|numeric',
            'happy_customers' => 'required|numeric',
            'visitors' => 'required|numeric'
        ]);


        if ($request->hasFile('site_logo')) {
            $siteLogoName = time() . '.' . $request->file('site_logo')->getClientOriginalExtension();
            $request->file('site_logo')->move(public_path('images/logo'), $siteLogoName);
            $siteLogoUrl = url('images/logo/' . $siteLogoName);
            $validatedData['site_logo'] = $siteLogoUrl;
        }

        if ($request->hasFile('site_logo_small')) {
            $siteLogoSmall = $request->file('site_logo_small');
            $siteLogoSmallName = time() . '.' . $siteLogoSmall->getClientOriginalExtension();
            $siteLogoSmall->move(public_path('images/logo'), $siteLogoSmallName);
            $validatedData['site_logo_small'] = $siteLogoSmallName;
        }
        if ($request->hasFile('site_favicon')) {
            $siteFavicon = $request->file('site_favicon');
            $siteFaviconName = time() . '.' . $siteFavicon->getClientOriginalExtension();
            $siteFavicon->move(public_path('images/logo'), $siteFaviconName);
            $validatedData['site_favicon'] = $siteFaviconName;
        }


        $setting = Settings::firstOrNew();
        $setting->update($validatedData);


        return redirect('setting')->with('success', 'Settings Updated');
    }

    public function rules()
    {
        $settings = Settings::all();
        return view('confession.rules', ['settings' => $settings]);
    }



    public function showGoogleAds()
    {
        $googleAds = Settings::pluck('google_ads')->first();
        return view('googleAds', compact('googleAds'));
    }


    public function updateGoogleAds(Request $request)
    {
        $googleAds = $request->input('description');
        Settings::where('id', 1)->update(['google_ads' => $googleAds]);
        return redirect()->back()->with('success', 'Google Ads description updated successfully!');
    }
}
