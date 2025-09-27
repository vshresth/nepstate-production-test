<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubAdmins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SubAdminController extends Controller
{
    public function index()
    {
        $subAdmins = SubAdmins::where('id', '!=', -1)->get();
        return view('sub_admin.index', compact('subAdmins'));
    }

    public function create()
    {
        return view('sub_admin.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'username' => 'required|string|unique:admins',
            'email' => 'required|email|unique:admins',
            'password' => 'required|string|min:6',
            'status' => 'required|in:1,0',
        ]);

        // Hash the password before storing it
        $data['password'] = Hash::make($data['password']);

        $data['role_type'] = 'sub_admin';

        if ($request->permissions != '') {
            $data['permissions'] = implode(',', $request->permissions);
        }

        SubAdmins::create($data);

        return redirect('sub-admin')->with('success', 'Sub-admin created successfully');
    }


    public function edit(SubAdmins $subAdmin)
    {
        return view('sub_admin.edit', compact('subAdmin'));
    }

    public function update(Request $request, SubAdmins $subAdmin)
    {
        $data = $request->validate([
            'name' => 'required|string',
            // 'username' => 'required|string|unique:admins,username,' . $subAdmin->id,
            // 'email' => 'required|email|unique:admins,email,' . $subAdmin->id,
            // 'password' => 'nullable|string|min:6',

            'status' => 'required|in:1,0',
        ]);

        if ($request->permissions != '') {
            $data['permissions'] = implode(',', $request->permissions);
        } else {
            $data['permissions'] = '';
        }

        $subAdmin->update($data);

        return redirect('sub-admin')->with('success', 'Sub-admin updated successfully');
    }

    public function destroy($id)
    {
        $user = SubAdmins::findOrFail($id);
        $user->delete();

        return redirect('sub-admin')->with('success', 'Sub-admin deleted successfully');
    }
}
