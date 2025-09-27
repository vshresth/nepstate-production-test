<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Cities;
use App\Models\Countries;
use App\Models\ProductImages;
use App\Models\Products;
use App\Models\ProductsAds;
use App\Models\User;
use App\Models\Users;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function events()
    {
        $events = Products::where('category', 'events')->get();
        return view('product.events', compact('events'));
    }
    public function trainings()
    {
        $trainings = Products::where('category', 'it-trainings')->get();
        return view('product.trainings', compact('trainings'));
    }

    public function jobs()
    {
        $jobs = Products::where('category', 'jobs')->get();
        return view('product.jobs', compact('jobs'));
    }
    public function rentals()
    {
        $rentals = Products::where('category', 'roomates-rentals')->get();
        return view('product.rentals', compact('rentals'));
    }
    public function services()
    {
        $services = Products::where('category', 'services')->get();
        return view('product.services', compact('services'));
    }

    public function showEvent($id)
    {
        $product = Products::findOrFail($id);
        $users = Users::find($product->uID);
        $country = Countries::find($product->country_id);
        $city = Cities::find($product->city_id);
        
        $productImages = ProductImages::where('product_id', $id);
        $galleryImage = $productImages->where('gallery', 1)->get();
        $simpleImage = ProductImages::where('product_id', $id)->where('gallery', 0)->get();
    
        $json = json_decode($product->json_content, true);
    
        $formattedJson = $this->preprocessJson($json);
    
        return view('product.show.event', compact('product', 'formattedJson', 'users', 'country', 'city', 'json', 'galleryImage', 'simpleImage'));
    }
    

    public function showJobs($id)
    {
        $product = Products::findOrFail($id);
        $users = Users::find($product->uID);
        $country = Countries::find($product->country_id);
        $city = Cities::find($product->city_id);
        $productImages = ProductImages::where('product_id', $id);
        $galleryImage = $productImages->where('gallery', 1)->get();
        $simpleImage = ProductImages::where('product_id', $id)->where('gallery', 0)->get();
    

        $json = json_decode($product->json_content, true);

        $formattedJson = $this->preprocessJson($json);

        return view('product.show.job', compact('product', 'formattedJson', 'users', 'country', 'city', 'json', 'galleryImage', 'simpleImage'));    }

    public function showTrainings($id)
    {
        $product = Products::findOrFail($id);
        $users = Users::find($product->uID);
        $country = Countries::find($product->country_id);
        $city = Cities::find($product->city_id);

        $json = json_decode($product->json_content, true);
        $productImages = ProductImages::where('product_id', $id);
        $galleryImage = $productImages->where('gallery', 1)->get();
        $simpleImage = ProductImages::where('product_id', $id)->where('gallery', 0)->get();
    
        $formattedJson = $this->preprocessJson($json);

        return view('product.show.train', compact('product', 'formattedJson', 'users', 'country', 'city', 'json', 'galleryImage', 'simpleImage'));
    }

    public function showRentals($id)
    {
        $product = Products::findOrFail($id);
        $users = Users::find($product->uID);
        $country = Countries::find($product->country_id);
        $city = Cities::find($product->city_id);
        $productImages = ProductImages::where('product_id', $id);
        $galleryImage = $productImages->where('gallery', 1)->get();
        $simpleImage = ProductImages::where('product_id', $id)->where('gallery', 0)->get();
    
        $json = json_decode($product->json_content, true);

        $formattedJson = $this->preprocessJson($json);

        return view('product.show.rental', compact('product', 'formattedJson', 'users', 'country', 'city', 'json', 'galleryImage', 'simpleImage'));
    }

    public function showServices($id)
    {
        $product = Products::findOrFail($id);
        $users = Users::find($product->uID);
        $country = Countries::find($product->country_id);
        $city = Cities::find($product->city_id);
        $productImages = ProductImages::where('product_id', $id);
        $galleryImage = $productImages->where('gallery', 1)->get();
        $simpleImage = ProductImages::where('product_id', $id)->where('gallery', 0)->get();
    
        $json = json_decode($product->json_content, true);

        $formattedJson = $this->preprocessJson($json);

        return view('product.show.service',compact('product', 'formattedJson', 'users', 'country', 'city', 'json', 'galleryImage', 'simpleImage'));  }

    private function preprocessJson($json)
    {
        
        if (is_null($json)) {
            return ['JSON Content' => 'No JSON content available'];
        }

        $formattedJson = [];
        $defaultIfNull = 'N/A';

        foreach ($json as $key => $value) {
            if (!in_array($key, ['stripeToken', 'sub_plan_amount', 'plan_amount', 'coupon_code', 'banner_type', 'plan', 'description'])) {
                $formattedKey = ucwords(str_replace('_', ' ', $key));
                switch ($key) {
                    case 'refundable_policy':
                        $formattedJson[$formattedKey] = $value ? 'Yes' : 'No';
                        break;
                    case 'event_type':
                        $formattedJson[$formattedKey] = $value == 1 ? 'Yes' : 'No';
                        break;
                    default:
                        $formattedJson[$formattedKey] = $value ?? $defaultIfNull;
                }
            }
        }

        return $formattedJson;
    }

    public function productAd()
    {
        $ads = ProductsAds::all();
        $users = Admin::all();
        return view('product.ads.index', compact('ads', 'users'));
    }

    public function productAddelete($id)
    {

        $ad = ProductsAds::find($id);
        if (!$ad) {
            return redirect()->route('product_ad')->with('error', 'Advertisement not found.');
        }
        $ad->delete();
        return redirect()->back()->with('success', 'Advertisement deleted successfully.');
    }

    public function AdCreate()
    {
        $users = Admin::all();
        $countries = Countries::all();
        $cities = Cities::all();
        $categories = Products::all();
        return view('product.ads.create', compact('users', 'countries', 'cities', 'categories'));
    }
    public function productAdStore(Request $request)
    {
        $validatedData = $request->validate([
            'ad_for' => 'required|string',
            'link' => 'required|url',
            'ad_expires' => 'required|date',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
            // 'category' => 'nullable',
        ]);

        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);
        $imageUrl = url('images/' . $imageName);
        $validatedData['image'] = $imageUrl;

        $advertisement = new ProductsAds();
        $advertisement->uID_pID = 1;
        $advertisement->created_at = now();
        $advertisement->ad_for = $validatedData['ad_for'];
        $advertisement->ad_expires = $validatedData['ad_expires'];
        $advertisement->link = $validatedData['link'];
        $advertisement->ad_location = 'Website home page banner';

        $advertisement->user_id = -1;
        $advertisement->country_id = 1;
        $advertisement->city_id = 1;
        $advertisement->image = $validatedData['image'];

        $advertisement->save();

        $categories = Products::all();

        return redirect()->route('product_ad')->with([
            'success' => 'Advertisement created successfully',
            'categories' => $categories
        ]);
    }




    public function edit($id)
    {

        $advertisement = ProductsAds::findOrFail($id);
        $users = Admin::all();
        $countries = Countries::all();
        $cities = Cities::all();
        $categories = Products::all();
        session()->flash('old_ad_for', $advertisement->ad_for);
        return view('product.ads.edit', compact('advertisement', 'users', 'countries', 'cities', 'categories'));
    }
    public function update(Request $request, $id)
    {
        $advertisement = ProductsAds::findOrFail($id);
        $validatedData = $request->validate([
            'link' => 'required|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        $advertisement->link = $validatedData['link'];

        if ($request->hasFile('image')) {
            if ($advertisement->image && file_exists(public_path('images/' . $advertisement->image))) {
                unlink(public_path('images/' . $advertisement->image));
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $imageUrl = url('images/' . $imageName);
            $advertisement->image = $imageUrl;
        }

        $advertisement->save();

        return redirect()->route('product_ad')->with('success', 'Advertisement updated successfully');
    }



    public function view($id)
    {
        $advertisement = ProductsAds::findOrFail($id);
        $users = Admin::all();
        $countries = Countries::all();
        $cities = Cities::all();
        $categories = Products::all();
        return view('product.ads.display', compact('advertisement', 'users', 'countries', 'cities', 'categories'));
    }




    // -
    // -
    // -
    // -
    // -
    // -
    // -
    // -
    // -
    // -
    // -
    public function createPage()
    {
        $countries = Countries::all();
        return view('product.ads.createAd1', compact('countries'));
    }
    public function ad1Store(Request $request)
    {
        $validatedData = $request->validate([
            'link' => 'required|url',
            'ad_expires' => 'required|date',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
            'country_id' => 'required|exists:countries,id',
        ]);

        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);
        $imageUrl = url('images/' . $imageName);
        $validatedData['image'] = $imageUrl;

        $advertisement = new ProductsAds();
        $advertisement->uID_pID = 1;
        $advertisement->created_at = now();
        $advertisement->ad_for = 'website_home_banner';
        $advertisement->ad_expires = $validatedData['ad_expires'];
        $advertisement->link = $validatedData['link'];
        $advertisement->ad_location = 'website_home_banner';
        $advertisement->user_id = -1;
        $advertisement->country_id = $validatedData['country_id'];
        $advertisement->city_id = 1;
        $advertisement->image = $validatedData['image'];
        $advertisement->save();

        $categories = Products::all();

        return redirect()->route('product_ad')->with([
            'success' => 'Advertisement created successfully',
            'categories' => $categories
        ]);
    }


    public function createAd2()
    {
        $countries = Countries::all();
        return view('product.ads.createAd2', compact('countries'));
    }
    public function ad2Store(Request $request)
    {

        $validatedData = $request->validate([
            // 'ad_for' => 'required|string',
            'link' => 'required|url',
            'ad_expires' => 'required|date',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
            'country_id' => 'required|exists:countries,id',


        ]);


        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);
        $imageUrl = url('images/' . $imageName);
        $validatedData['image'] = $imageUrl;

        $advertisement = new ProductsAds();
        $advertisement->uID_pID = 1;
        $advertisement->created_at = now();
        $advertisement->ad_for = 'home_middle';
        $advertisement->ad_expires = $validatedData['ad_expires'];
        $advertisement->link = $validatedData['link'];
        // $advertisement->ad_location = 'AD # 2';
        $advertisement->user_id = -1;
        $advertisement->country_id = $validatedData['country_id'];

        $advertisement->city_id = 1;
        $advertisement->image = $validatedData['image'];
        $advertisement->save();
        $categories = Products::all();
        return redirect()->route('product_ad')->with([
            'success' => 'Advertisement created successfully'
        ]);
    }
    public function createAd3()
    {
        $countries = Countries::all();

        return view('product.ads.createAd3', compact('countries'));
    }
    public function ad3Store(Request $request)
    {

        $validatedData = $request->validate([
            // 'ad_for' => 'required|string',
            'link' => 'required|url',
            'ad_expires' => 'required|date',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
            'country_id' => 'required|exists:countries,id',


        ]);


        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);
        $imageUrl = url('images/' . $imageName);
        $validatedData['image'] = $imageUrl;

        $advertisement = new ProductsAds();
        $advertisement->uID_pID = 1;
        $advertisement->created_at = now();
        $advertisement->ad_for = 'web_footer';
        $advertisement->ad_expires = $validatedData['ad_expires'];
        $advertisement->link = $validatedData['link'];
        // $advertisement->ad_location = 'AD#3';
        $advertisement->user_id = -1;
        $advertisement->country_id = $validatedData['country_id'];

        $advertisement->city_id = 1;
        $advertisement->image = $validatedData['image'];
        $advertisement->save();
        return redirect()->route('product_ad')->with([
            'success' => 'Advertisement created successfully'
        ]);
    }
    public function createAd4()
    {
        $countries = Countries::all();

        return view('product.ads.createAd4', compact('countries'));
    }
    public function ad4Store(Request $request)
    {

        $validatedData = $request->validate([
            // 'ad_for' => 'required|string',
            'link' => 'required|url',
            'ad_expires' => 'required|date',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
            'category' => 'required',
            'country_id' => 'required|exists:countries,id',

        ]);


        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);
        $imageUrl = url('images/' . $imageName);
        $validatedData['image'] = $imageUrl;

        $advertisement = new ProductsAds();
        $advertisement->uID_pID = 1;
        $advertisement->created_at = now();
        $advertisement->ad_for = 'category_home_page';
        $advertisement->ad_expires = $validatedData['ad_expires'];
        $advertisement->link = $validatedData['link'];
        // $advertisement->ad_location = 'Category home page';
        $advertisement->user_id = -1;
        $advertisement->country_id = $validatedData['country_id'];

        $advertisement->city_id = 1;
        $advertisement->category = $validatedData['category'];

        $advertisement->image = $validatedData['image'];
        $advertisement->save();
        return redirect()->route('product_ad')->with([
            'success' => 'Advertisement created successfully'
        ]);
    }
    public function createAd5()
    {
        $countries = Countries::all();

        return view('product.ads.createAd5', compact('countries'));
    }
    public function ad5Store(Request $request)
    {

        $validatedData = $request->validate([
            // 'ad_for' => 'required|string',
            'link' => 'required|url',
            'ad_expires' => 'required|date',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
            'country_id' => 'required|exists:countries,id',
            'category' => 'required',

        ]);

        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);
        $imageUrl = url('images/' . $imageName);
        $validatedData['image'] = $imageUrl;

        $advertisement = new ProductsAds();
        $advertisement->uID_pID = 1;
        $advertisement->created_at = now();
        $advertisement->ad_for = 'cat_right';
        $advertisement->ad_expires = $validatedData['ad_expires'];
        $advertisement->link = $validatedData['link'];
        // $advertisement->ad_location = 'Category right side';
        $advertisement->ad_location = 'right_banner';
        $advertisement->user_id = -1;
        $advertisement->country_id = $validatedData['country_id'];

        $advertisement->city_id = 1;
        $advertisement->category = $validatedData['category'];

        $advertisement->image = $validatedData['image'];
        $advertisement->save();
        return redirect()->route('product_ad')->with([
            'success' => 'Advertisement created successfully'
        ]);
    }
    public function createAd6()
    {
        $countries = Countries::all();

        return view('product.ads.createAd6', compact('countries'));
    }
    public function ad6Store(Request $request)
    {

        $validatedData = $request->validate([
            'ad_location' => 'required|string',
            'link' => 'required|url',
            'ad_expires' => 'required|date',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
            'country_id' => 'required|exists:countries,id',
            // 'category' => 'required',

        ]);


        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);
        $imageUrl = url('images/' . $imageName);
        $validatedData['image'] = $imageUrl;

        $advertisement = new ProductsAds();
        $advertisement->uID_pID = 1;
        $advertisement->created_at = now();
        $advertisement->ad_for = 'blog';
        $advertisement->ad_expires = $validatedData['ad_expires'];
        $advertisement->link = $validatedData['link'];
        $advertisement->ad_location = $validatedData['ad_location'];
        $advertisement->user_id = -1;
        $advertisement->country_id = $validatedData['country_id'];

        $advertisement->city_id = 1;
        // $advertisement->category = $validatedData['category'];

        $advertisement->image = $validatedData['image'];
        $advertisement->save();
        return redirect()->route('product_ad')->with([
            'success' => 'Advertisement created successfully'
        ]);
    }
    public function createAd7()
    {
        $countries = Countries::all();

        return view('product.ads.createAd7', compact('countries'));
    }
    public function ad7Store(Request $request)
    {

        $validatedData = $request->validate([
            'ad_location' => 'required|string',
            'link' => 'required|url',
            'ad_expires' => 'required|date',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
            'country_id' => 'required|exists:countries,id',
            // 'category' => 'required',

        ]);

        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);
        $imageUrl = url('images/' . $imageName);
        $validatedData['image'] = $imageUrl;

        $advertisement = new ProductsAds();
        $advertisement->uID_pID = 1;
        $advertisement->created_at = now();
        $advertisement->ad_for = 'forum';
        $advertisement->ad_expires = $validatedData['ad_expires'];
        $advertisement->link = $validatedData['link'];
        $advertisement->ad_location = $validatedData['ad_location'];
        $advertisement->user_id = -1;
        $advertisement->country_id = $validatedData['country_id'];

        $advertisement->city_id = 1;
        // $advertisement->category = $validatedData['category'];

        $advertisement->image = $validatedData['image'];
        $advertisement->save();
        return redirect()->route('product_ad')->with([
            'success' => 'Advertisement created successfully'
        ]);
    }
    public function createAd8()
    {
        $countries = Countries::all();

        return view('product.ads.createAd8', compact('countries'));
    }
    public function ad8Store(Request $request)
    {

        $validatedData = $request->validate([
            'ad_location' => 'required|string',
            'link' => 'required|url',
            'ad_expires' => 'required|date',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
            'country_id' => 'required|exists:countries,id',
            // 'category' => 'required',

        ]);


        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);
        $imageUrl = url('images/' . $imageName);
        $validatedData['image'] = $imageUrl;
        $advertisement = new ProductsAds();
        $advertisement->uID_pID = 1;
        $advertisement->created_at = now();
        $advertisement->ad_for = 'confession';
        $advertisement->ad_expires = $validatedData['ad_expires'];
        $advertisement->link = $validatedData['link'];
        $advertisement->ad_location = $validatedData['ad_location'];
        $advertisement->user_id = -1;
        $advertisement->country_id = $validatedData['country_id'];

        $advertisement->city_id = 1;
        // $advertisement->category = $validatedData['category'];

        $advertisement->image = $validatedData['image'];
        $advertisement->save();
        return redirect()->route('product_ad')->with([
            'success' => 'Advertisement created successfully'
        ]);
    }
    public function destroyClassified($id)
    {
        $product = Products::findOrFail($id);
        $product->delete();
        return back()->with('success', 'List deleted');
    }
}
