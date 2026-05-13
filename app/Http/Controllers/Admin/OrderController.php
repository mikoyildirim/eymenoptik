<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller; use App\Models\Order; use Illuminate\Http\Request;
class OrderController extends Controller { public function index(){return view('admin.orders.index',['orders'=>Order::latest()->paginate(20)]);} public function show(Order $order){return view('admin.orders.show',compact('order'));} public function updateStatus(Request $r, Order $order){$r->validate(['status'=>'required']); $order->update(['status'=>$r->status]); return back()->with('success','Sipariş durumu güncellendi.');} }
