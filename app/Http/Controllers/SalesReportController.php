<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Carbon\Carbon;

class SalesReportController extends Controller
{
    public function index(Request $request)
    {
        // Set default date range to the current month
        $startDate = $request->input('start_date', Carbon::now()->startOfMonth()->toDateString());
        $endDate = $request->input('end_date', Carbon::now()->endOfMonth()->toDateString());

        // Fetch orders within the date range
        $orders = Order::whereBetween('received_date', [$startDate, $endDate])->get();

        // Group orders by day, month, and year
        $dailyProfits = $orders->groupBy(function ($order) {
            return Carbon::parse($order->received_date)->format('Y-m-d');
        })->map(function ($orders) {
            return $orders->sum('estimated_profit');
        });

        $monthlyProfits = $orders->groupBy(function ($order) {
            return Carbon::parse($order->received_date)->format('Y-m');
        })->map(function ($orders) {
            return $orders->sum('estimated_profit');
        });

        $yearlyProfits = $orders->groupBy(function ($order) {
            return Carbon::parse($order->received_date)->format('Y');
        })->map(function ($orders) {
            return $orders->sum('estimated_profit');
        });

        return view('sales.report', [
            'startDate' => $startDate,
            'endDate' => $endDate,
            'dailyProfits' => $dailyProfits,
            'monthlyProfits' => $monthlyProfits,
            'yearlyProfits' => $yearlyProfits,
        ]);
    }
}
