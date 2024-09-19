<?php

namespace App\Http\Controllers;

use App\Models\User; // Assuming your franchisees are users
use Illuminate\Http\Request;

class ValidationController extends Controller
{
    public function index()
    {
        // Fetch all users except admins
        $franchisees = User::where('usertype', '!=', 'admin')->get();
        return view('validation', compact('franchisees'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => ['required', 'in:Registered,Paid,Completed'],
        ]);

        $user = User::findOrFail($id);
        $user->status = $request->status;
        $user->save();

        return response()->json(['success' => 'Status updated successfully.']);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

    return redirect()->route('validation.index')->with('success', 'Franchisee deleted successfully.');
    }

}

