<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\OrdersExport;

class OrderController extends Controller
{
    public function store(Request $request) {
        $order = Order::create([
            'total_amount' => $request->total_amount,
            'payment_status' => 'pending',
        ]);
    
        foreach ($request->items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'unit_price' => $item['unit_price'],
            ]);
        }
    
        return response()->json($order->load('items.product'));
    }
    
    public function exportExcel() {
        return Excel::download(new OrdersExport, 'orders.xlsx');
    }

    public function print($id) {
        $order = Order::with('items.product')->findOrFail($id);
        $pdf = Pdf::loadView('invoice', compact('order'));
        return $pdf->download("invoice_{$id}.pdf");
    }
}
