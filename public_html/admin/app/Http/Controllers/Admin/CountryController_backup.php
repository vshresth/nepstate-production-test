<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Countries;
use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Users;
use App\Models\Products;

use Illuminate\Support\Facades\Storage;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Countries::all();
        return view('admin_country.index', compact('countries'));
    }

    public function create()
    {
        return view('admin_country.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'code' => 'required|unique:admin_countries',
            'title' => 'required',
            'flag' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|boolean',
        ]);

        $imageUrl = null;

        if ($request->hasFile('flag')) {
            $imageName = time() . '.' . $request->flag->extension();
            $request->flag->move(public_path('flags'), $imageName);
            $imageUrl = url('flags/' . $imageName);
        }

        $country = new Countries();
        $country->code = $validatedData['code'];
        $country->title = $validatedData['title'];
        $country->status = $validatedData['status'];
        $country->flag = $imageUrl;

        $country->save();

        return redirect()->route('countries.index')->with('success', 'Country created.');
    }



    public function edit(Countries $country)
    {
        return view('admin_country.edit', compact('country'));
    }

    public function update(Request $request, Countries $country)
    {
        $validatedData = $request->validate([
            'code' => 'required|unique:admin_countries,code,' . $country->id,
            'title' => 'required|unique:admin_countries,title,' . $country->id,
            'flag' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|boolean',

        ]);

        $country->code = $validatedData['code'];
        $country->title = $validatedData['title'];
        $country->status = $validatedData['status'];


        if ($request->hasFile('flag')) {

            if ($country->flag) {
                $oldImageName = basename(parse_url($country->flag, PHP_URL_PATH));
                if (file_exists(public_path('flags/' . $oldImageName))) {
                    unlink(public_path('flags/' . $oldImageName));
                }
            }


            $imageName = time() . '.' . $request->flag->extension();
            $request->flag->move(public_path('flags'), $imageName);
            $imageUrl = url('flags/' . $imageName);
            $country->flag = $imageUrl;
        }

        $country->save();

        return redirect()->route('countries.index')->with('success', 'Country updated.');
    }


    public function destroy(Countries $country)
    {
        if ($country->status == 0) {
            $country->delete();
            return redirect()->route('countries.index')->with('success', 'Country deleted.');
        } else {
            return redirect()->route('countries.index')->with('error', 'Country cannot be deleted because it is default');
        }
    }
    public function show(Countries $country){
        $categories = Categories::where('parent_id', 0)->get();
        $users = Users::where('country_id', $country->id)->get();
        return view('admin_country.show', compact('country','categories','users'));
    }
    public function showCategoryInfo(Countries $country, $slug)
    {
        $category = Categories::where('slug', $slug)->firstOrFail();
        $products = Products::where('category', $slug)
                            ->where('country_id', $country->id)
                            ->get();
    
        return view('admin_country.category_info', compact('country', 'category', 'products'));
    }
    

    
}
