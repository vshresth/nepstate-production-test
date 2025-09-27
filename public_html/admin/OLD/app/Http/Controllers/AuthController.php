<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Settings;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Rules\AlphaNumericCharacter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class AuthController extends Controller
{
    public function login()
    {
        return view("auth.login");
    }
    public function loginUser(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = Admin::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {

            if ($user->status == 0) {
                return back()->with('fail', 'Your account has been deactivate!');
            }
            $request->session()->put('loginId', $user->id);
            $request->session()->put('permissions', $user->permissions);
            $request->session()->put('role', $user->role_type);

            $role = session('role');
            $permissions = session('permissions');

            if ($role == 'admin') {

                return redirect('dashboard');
            } else if ($role == 'sub_admin') {

                if (!empty($permissions)) {
                    return redirect($this->redirectURL($permissions));
                } else {
                    return back()->with('fail', 'You do not have any permission');
                }
            }
        } else {
            return back()->with('fail', 'Incorrect Email or Password');
        }
    }

    public function trying()
    {
        $userCount = DB::table('users')->count();
        $blogCount = DB::table('blogs')->count();
        $adminCountryCount = DB::table('admin_countries')->count();
        $confessionCount = DB::table('confessions')->where('type', 'confession')->count();
        $forumCount = DB::table('confessions')->where('type', 'forum')->count();
        $productCount = DB::table('products')->count();
        $forumCategoryCount = DB::table('forum_categories')->count();
        $mainCategoriesCount = DB::table('categories')->where('parent_id', '0')->count();
        $subCategoriesCount = DB::table('categories')->where('parent_id', '!=', '0')->count();
        $bloglikeCount = DB::table('blog_likes')->count();
        $blogcommentCount = DB::table('blog_comment')->count();
        $confessionlikeCount = DB::table('confession_likes')->count();
        $confessioncommentCount = DB::table('confession_comment')->count();
        $setting = Settings::all();
        $data = array();
        if (Session::has('loginId')) {
            $data = Admin::where('id', '=', Session::get('loginId'))->first();
        }
        return view('dashboard', compact(
            'data',
            'userCount',
            'blogCount',
            'adminCountryCount',
            'confessionCount',
            'forumCount',
            'productCount',
            'forumCategoryCount',
            'mainCategoriesCount',
            'subCategoriesCount',
            'bloglikeCount',
            'blogcommentCount',
            'confessionlikeCount',
            'confessioncommentCount',
            'setting',
        ));
    }
    public function logout()
    {
        if (Session::has('loginId')) {
            Session::pull('loginId');
            Session::forget('permissions');
            Session::forget('role');
            return redirect('Nepstate-admin-login-page');
        }
    }

    public function password()
    {
        $loggedInUserId = session('loginId');
        $admin = Admin::findOrFail($loggedInUserId);
        return view('reset_password', compact('admin'));
    }


    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required|string|min:6',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $loggedInUserId = session('loginId');
        $admin = Admin::findOrFail($loggedInUserId);
        if (!Hash::check($request->old_password, $admin->password)) {
            return back()->withErrors(['old_password' => 'The provided old password does not match our records.']);
        }
        $admin->password = bcrypt($request->password);
        $admin->save();
        return back()->with('success', 'Password Changed Successfully');
    }
    public function profile()
    {
        $loggedInUserId = session('loginId');
        $admin = Admin::findOrFail($loggedInUserId);
        // dd($admin);
        return view('profile', compact('admin'));
    }
    public function updateProfile(Request $request)
    {
        $loggedInUserId = session('loginId');
        $admin = Admin::findOrFail($loggedInUserId);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:admins,email,' . $admin->id,
            'admin_profile_pic' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            // 'status' => 'required|boolean',
        ]);

        $admin->name = $request->name;
        $admin->email = $request->email;
        // $admin->status = $request->status;

        if ($request->hasFile('admin_profile_pic')) {
            if ($admin->admin_profile_pic) {
                $oldImageName = basename(parse_url($admin->admin_profile_pic, PHP_URL_PATH));
                if (file_exists(public_path('images/' . $oldImageName))) {
                    unlink(public_path('images/' . $oldImageName));
                }
            }
            $image = $request->file('admin_profile_pic');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $admin->admin_profile_pic = url('images/' . $imageName);
        }
        $admin->save();
        return back()->with('success', 'Profile updated.');
    }
    public function redirectURL($permissions)
    {
        $userPermissions = explode(',', $permissions);
        if ($userPermissions[0] == 'Dashboard') {
            return '/dashboard';
        } else if ($userPermissions[0] == 'Users') {
            return '/users';
        } else if ($userPermissions[0] == 'Countries') {
            return '/admin-countries';
        } else if ($userPermissions[0] == 'Classified_Categories') {
            return '/category';
        } else if ($userPermissions[0] == 'Classified') {
            return '/show-classifer-Events';
        } else if ($userPermissions[0] == 'Advertisment') {
            return '/product-ads';
        } else if ($userPermissions[0] == 'Payment_Plans') {
            return '/payment-plans';
        } else if ($userPermissions[0] == 'Forum') {
            return '/type-forums';
        } else if ($userPermissions[0] == 'Confession') {
            return '/type-confessions';
        } else if ($userPermissions[0] == 'Blogs') {
            return '/blogs';
        } else if ($userPermissions[0] == 'FAQS') {
            return '/faqs';
        } else if ($userPermissions[0] == 'Static_Page') {
            return '/static-page';
        } else if ($userPermissions[0] == 'Testimonials') {
            return '/testimonials';
        } else if ($userPermissions[0] == 'Google_Ads') {
            return '/google-ads';
        } else if ($userPermissions[0] == 'All_Comments') {
            return '/all-comments';
        } else if ($userPermissions[0] == 'Coupons') {
            return '/coupons';
        } else if ($userPermissions[0] == 'Notifications') {
            return '/notifications';
        } else if ($userPermissions[0] == 'Settings') {
            return '/setting';
        }
        else if ($userPermissions[0] == 'Email_Templates') {
            return '/email-templates';
        }
    }

}
