<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class FranchisorPackageController extends Controller
{
    public function index(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'price' => 'required|numeric',
            ]);

            Package::create($request->all());

            return redirect()->route('adminhome')->with('success', 'Package created successfully.');
        }

        $packages = Package::all();
        return view('adminhome', compact('packages'));
    }

    public function edit($id)
    {
        $package = Package::findOrFail($id);
        return view('editpackage', compact('package'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
        ]);

        $package = Package::findOrFail($id);
        $package->update($request->all());

        return redirect()->route('adminhome')->with('success', 'Package updated successfully.');
    }

    public function destroy($id)
    {
        $package = Package::findOrFail($id);
        $package->delete();

        return redirect()->route('adminhome')->with('success', 'Package deleted successfully.');
    }
}
