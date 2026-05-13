@extends('adminlte::page')
@section('title','Siparişler')
@section('content_header')<h1>Siparişler</h1>@endsection
@section('content')<div class="card"><div class="card-body"><table class="table table-bordered"><tr><th>No</th><th>Müşteri</th><th>Telefon</th><th>Tutar</th><th>Durum</th></tr>@foreach($orders as $order)<tr><td>{{ $order->order_number }}</td><td>{{ $order->full_name }}</td><td>{{ $order->phone }}</td><td>{{ number_format($order->total_price,2) }} ₺</td><td>{{ $order->status }}</td></tr>@endforeach</table>{{ $orders->links() }}</div></div>@endsection
