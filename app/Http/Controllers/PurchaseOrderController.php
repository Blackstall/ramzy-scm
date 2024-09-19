<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Inventory;

class PurchaseOrderController extends Controller
{
    public function create()
    {
        $inventoryItems = Inventory::all();
        return view('orders.create', compact('inventoryItems'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:0',
            'items.*.inventory_id' => 'required|integer|exists:inventories,id',
            'receipt' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);
    
        $totalPrice = 0;
        $totalProfit = 0;
    
        foreach ($request->items as $item) {
            $totalPrice += $item['quantity'] * $item['price'];
            $inventoryItem = Inventory::find($item['inventory_id']);
            $totalProfit += ($item['quantity'] * $item['price']) * ($inventoryItem->profit_percentage / 100);
        }

        $receiptPath = $request->file('receipt')->store('receipts', 'public');
    
        $order = Order::create([
            'user_id' => auth()->id(),
            'total_price' => $totalPrice,
            'status' => 'pending',
            'estimated_profit' => $totalProfit,
            'purchase_date' => now(),
            'receipt' => $receiptPath,
        ]);
    
        foreach ($request->items as $item) {
            $order->items()->create([
                'inventory_id' => $item['inventory_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }
    
        return redirect()->route('orders.index')->with('success', 'Order placed successfully.');
    }
    
    

    public function index()
    {
        $orders = Order::where('user_id', auth()->id())->get();
        return view('orders.index', compact('orders'));
    }

    public function status()
    {
        $orders = Order::where('user_id', auth()->id())->get();
        return view('orders.status', compact('orders'));
    }

    public function receive($id)
    {
        $order = Order::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $order->update([
            'status' => 'received',
            'received_date' => now(),
            'completed_date' => now(),
        ]);

        // Decrease the inventory quantity based on the order items
        foreach ($order->items as $item) {
            $inventoryItem = Inventory::find($item->inventory_id);
            $inventoryItem->decrement('quantity', $item->quantity);
        }

        return redirect()->route('orders.status')->with('success', 'Order marked as received.');
    }

    // app/Http/Controllers/PurchaseOrderController.php

    public function history()
    {
        $orders = Order::where('user_id', auth()->id())->get();
        $totalSpent = $orders->sum('total_price');

        return view('orders.history', compact('orders', 'totalSpent'));
    }

    public function show($id)
    {
        $order = Order::with('items')->findOrFail($id);
        return view('orders.show', compact('order'));
    }

}
