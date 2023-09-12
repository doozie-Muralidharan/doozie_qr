<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ManageAdminController extends Controller
{
    public function index()
    {
        $manage_admin  = User::where('role', 'admin')->withTrashed()->get();
        return view('superadmin.manage_admin.index')->with('manage_admin', $manage_admin);
    }
    public function create()
    {
        return view('superadmin.manage_admin.create');
    }
    public function edit($id)
    {
        $admin = User::find($id);
        return view('superadmin.manage_admin.edit')->with('admin', $admin);
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'username' => 'required',
            'email' => 'required',
        ]);

        $admin = new User();
        $admin->firstname = $request->first_name;
        $admin->lastname = $request->last_name;
        $admin->username = $request->username;
        $admin->email = $request->email;
        $password = $request->password;
        $hashedPaasword = Hash::make($password);
        $admin->password = $hashedPaasword;
        $admin->role = 'admin';

        $admin->save();

        toastr()->success('Admin  added successfully');
        return redirect()->route('manage_admin.index');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'username' => 'required',
            'email' => 'required',
        ]);

        $admin =  User::find($id);
        $admin->firstname = $request->first_name;
        $admin->lastname = $request->last_name;
        $admin->username = $request->username;
        $admin->email = $request->email;
        $password = $request->password;
        $hashedPaasword = Hash::make($password);
        $admin->password = $hashedPaasword;
        $admin->role = 'admin';

        $admin->save();

        toastr()->success('Admin  updated successfully');
        return redirect()->route('manage_admin.index');
    }

    public function activate($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->restore(); // Restore a soft-deleted model.
            toastr()->success('Status activated');
        } else {
            toastr()->error('User not found');
        }

        return redirect()->back();
    }

    public function deactivate($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->delete(); // Soft delete the user.
            toastr()->success('Status deactivated');
        } else {
            toastr()->error('User not found');
        }

        return redirect()->back();
    }
}
