<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\FranchiseeAgreement;
use Illuminate\Support\Facades\Auth;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::all();
        return view('packages.index', compact('packages'));
    }

    public function select(Request $request)
    {
        $packageId = $request->input('package_id');
        // Logic for selecting the package
        return redirect()->route('packages.agreement')->with('package_id', $packageId);
    }

    public function agreement()
    {
        return view('packages.agreement');
    }

    public function submitAgreement(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'business_experience' => 'required|integer',
            'ssm_certificate' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'receipt' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'declaration' => 'required|boolean',
        ]);

        $ssmCertificatePath = $request->file('ssm_certificate')->store('ssm_certificates', 'public');
        $receiptPath = $request->file('receipt')->store('receipts', 'public');

        FranchiseeAgreement::create([
            'user_id' => Auth::id(),
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'address' => $request->input('address'),
            'phone_number' => $request->input('phone_number'),
            'business_experience' => $request->input('business_experience'),
            'ssm_certificate' => $ssmCertificatePath,
            'receipt' => $receiptPath,
            'status' => 'Pending',
        ]);

        return redirect()->back()->with('success', 'Agreement submitted successfully!');
    }
}
