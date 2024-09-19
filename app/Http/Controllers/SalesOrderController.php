<?php
// app/Http/Controllers/SalesOrderController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Inventory;

class SalesOrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->paginate(5); // Paginate the orders, 5 per page
        return view('sales.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with('items.inventory')->findOrFail($id);
        return view('sales.show', compact('order'));
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('sales-orders.index')->with('success', 'Order deleted successfully.');
    }

    public function ship($id)
    {
        $order = Order::findOrFail($id);
        $order->update([
            'status' => 'shipped',
            'completed_date' => now(),
        ]);

        return redirect()->route('sales-orders.index')->with('success', 'Order marked as shipped.');
    }

    public function receive($id)
    {
        $order = Order::findOrFail($id);
        $order->update([
            'status' => 'received',
            'received_date' => now(),
            'completed_date' => now(),
        ]);

        foreach ($order->items as $item) {
            $inventoryItem = Inventory::find($item->inventory_id);
            $inventoryItem->decrement('quantity', $item->quantity);
        }

        return redirect()->route('sales-orders.index')->with('success', 'Order marked as received.');
    }

    public function history()
    {
        $completedOrders = Order::with('user')->where('status', 'received')->paginate(5); // Paginate the completed orders, 5 per page
        return view('sales.history', compact('completedOrders'));
    }
}
