<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::all();
        return view('masters.package.index')->with('packages', $packages);
    }

    public function create()
    {
        return view('masters.package.create');
    }
    public function edit($id)
    {
        $package = Package::find($id);
        return view('masters.package.edit')->with('package',$package);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'number_of_codes' => 'required',
            'cost' => 'required',
            'monthly_cap' => 'required',
        ]);

        $package = new Package;
        $package->name = $request->input('name');
        $package->number_of_codes = $request->input('number_of_codes');
        $package->cost = $request->input('cost');
        $package->monthly_cap = $request->input('monthly_cap');

        $package->save();

        toastr()->success('Package  added successfully');
        return redirect()->route('packages.index');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'number_of_codes' => 'required',
            'cost' => 'required',
            'monthly_cap' => 'required',
        ]);

        $package =  Package::find($id);
        $package->name = $request->input('name');
        $package->number_of_codes = $request->input('number_of_codes');
        $package->cost = $request->input('cost');
        $package->monthly_cap = $request->input('monthly_cap');

        $package->save();

        toastr()->success('Package updated successfully');
        return redirect()->route('packages.index');
    }
}
