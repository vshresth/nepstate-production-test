<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blogs;
use App\Models\Confessions;
use App\Models\Countries;
use App\Models\Products;
use App\Models\ProductsAds;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function showUser()
    {
         $users = Users::with('country')->get(); 
    return view('users.user.index', compact('users'));
    }

    public function storeUser(Request $request)
    {
        $countries = Countries::all();
        return view('users.user.create', compact('countries'));
    }


    //Creating new user
    public function storeAndAuthenticate(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'nullable|string|min:6',
            'username' => 'required|string|unique:users|max:255',
            'status' => 'required|boolean',
            'country_id' => 'required|exists:countries,id',
            'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imageName = null;
        if ($request->hasFile('profile_pic')) {
            $imageName = time() . '.' . $request->profile_pic->extension();
            $request->profile_pic->move(public_path('images'), $imageName);
        }

        $user = new Users();
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        if (!empty($validatedData['password'])) {
            $user->password = bcrypt($validatedData['password']);
        }
        $user->status = $validatedData['status'];
        $user->username = $validatedData['username'];
        $user->phone = $request->input('phone', null);
        $user->address = $request->input('address', null);
        $user->country_id = $validatedData['country_id'];
        $user->profile_pic = $imageName ? url('images/' . $imageName) : null;
        $user->created_at = now();

        $user->save();

        return redirect()->route('users.user.index')->with('success', 'User created successfully');
    }




    // Deleting the user
    public function destroy(Users $user)
    {
        $user->delete();

        return redirect()->route('users.user.index')->with('status', 'User deleted ');
    }

    // Editing and updating the user
    public function edit(Users $user)
    {
        $countries = Countries::all();
        return view('users.user.edit', compact('user', 'countries'));
    }

    public function update(Request $request, Users $user)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'status' => 'required|boolean',
            'country_id' => 'required|exists:countries,id',
            'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user->name = $validatedData['name'];
        $user->status = $validatedData['status'];
        $user->username = $validatedData['username'];
        $user->country_id = $validatedData['country_id'];
        $user->phone = $request->input('phone', null);
        $user->address = $request->input('address', null);

        if ($request->hasFile('profile_pic')) {
            if ($user->profile_pic && file_exists(public_path(parse_url($user->profile_pic, PHP_URL_PATH)))) {
                unlink(public_path(parse_url($user->profile_pic, PHP_URL_PATH)));
            }

            $imageName = time() . '.' . $request->profile_pic->extension();
            $request->profile_pic->move(public_path('images'), $imageName);
            $imageUrl = url('images/' . $imageName);
            $user->profile_pic = $imageUrl;
        }

        $user->save();

        return redirect()->route('users.user.index')->with('success', 'User updated successfully');
    }


    public function displayUser($id)
{
    $users = Users::findOrFail($id);
    $countryId = $users->country_id;
    $country = Countries::find($countryId);
    $blogs = Blogs::where('uID', $id)->get();
    $confessions = Confessions::where('uID', $id)->where('type', 'confession')->get();
    $forums = Confessions::where('uID', $id)->where('type', 'forum')->get();
    $events = Products::where('uID', $id)->where('category', 'events')->get();
    $jobs = Products::where('uID', $id)->where('category', 'jobs')->get();
    $trains = Products::where('uID', $id)->where('category', 'it-trainings')->get();
    $services = Products::where('uID', $id)->where('category', 'services')->get();
    $rooms = Products::where('uID', $id)->where('category', 'roomates-rentals')->get();
    $ads = ProductsAds::where('user_id', $id)->get();

    return view('users.user.display', compact('users', 'blogs', 'confessions', 'forums', 'events', 'jobs', 'trains', 'rooms', 'services', 'ads', 'country'));
}



public function allreviews()
{
    $orderReviews = DB::table('order_reviews')
        ->join('users', 'order_reviews.user_id', '=', 'users.id') 
        ->join('products', 'order_reviews.order_id', '=', 'products.id') 
        ->select(
            'order_reviews.*',
            'users.name as user_name',
            'products.title as product_title'
        )
        ->get();

    return view('all_reviews', compact('orderReviews'));
}



public function deleteReview($id)
{
    $deleted = DB::table('order_reviews')->where('id', $id)->delete();
    if ($deleted) {
        return redirect()->back()->with('success', 'Review deleted successfully.');
    }
    return redirect()->back()->with('error', 'Review not found.');
}






}
