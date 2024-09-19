<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use Illuminate\Support\Facades\Log;

class InventoryController extends Controller
{
    public function index()
    {
        $items = Inventory::all();
        return view('inventory.index', compact('items'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'profit_percentage' => 'required|numeric',
        ]);

        $data = $request->all();
        $data['estimated_profit'] = $data['price'] * ($data['profit_percentage'] / 100);

        // Log the data to verify estimated_profit is being set correctly
        Log::info('Inventory data: ', $data);

        Inventory::create($data);
        return redirect()->route('inventory.index')->with('success', 'Item added successfully.');
    }

    public function edit(Inventory $inventory)
    {
        return view('inventory.edit', compact('inventory'));
    }

    public function update(Request $request, Inventory $inventory)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'profit_percentage' => 'required|numeric'
        ]);

        $data = $request->all();
        $data['estimated_profit'] = $data['price'] * ($data['profit_percentage'] / 100);

        // Log the data to verify estimated_profit is being set correctly
        Log::info('Updated Inventory data: ', $data);

        $inventory->update($data);
        return redirect()->route('inventory.index')->with('success', 'Item updated successfully.');
    }

    public function destroy(Inventory $inventory)
    {
        $inventory->delete();
        return redirect()->route('inventory.index')->with('success', 'Item deleted successfully.');
    }
}
