<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $statuses = ['beklemede', 'hazirlaniyor', 'kargoda', 'tamamlandi', 'iptal'];

        $orders = Order::paid()->latest();

        $status = $request->query('status');
        if ($status && in_array($status, $statuses, true)) {
            $orders->where('status', $status);
        }

        $search = trim((string) $request->query('search', ''));
        if ($search !== '') {
            $orders->where(function ($query) use ($search) {
                $query->where('order_number', 'like', "%{$search}%")
                    ->orWhere('full_name', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        return view('admin.orders.index', [
            'orders' => $orders->paginate(20)->withQueryString(),
            'statusOptions' => $statuses,
            'selectedStatus' => $status,
            'search' => $search,
        ]);
    }

    public function show(Order $order)
    {
        $order->load(['items.product']);

        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $r, Order $order)
    {
        $r->validate(['status' => 'required']);

        $order->update(['status' => $r->status]);

        return back()->with('success', 'Sipariş durumu güncellendi.');
    }
}
