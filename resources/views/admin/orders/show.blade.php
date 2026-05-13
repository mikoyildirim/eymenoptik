@extends('adminlte::page')
@section('title','Sipariş Detay')
@section('content_header')<h1>{{ $order->order_number }}</h1>@endsection
@section('content')<div class="card"><div class="card-body"><p><b>Müşteri:</b> {{ $order->full_name }}</p><p><b>Telefon:</b> {{ $order->phone }}</p><p><b>Adres:</b> {{ $order->address }}</p><form method="POST" action="{{ route('admin.orders.status',$order) }}">@csrf<select name="status" class="form-control mb-2"><option>beklemede</option><option>hazirlaniyor</option><option>kargoda</option><option>tamamlandi</option><option>iptal</option></select><button class="btn btn-primary">Güncelle</button></form></div></div>@endsection
