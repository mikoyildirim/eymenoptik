@extends('adminlte::page')
@section('title','Eymen Optik | Admin')
@section('content_header')<h1>Eymen Optik Yönetim Paneli</h1>@endsection
@section('content')
@if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
<div class="row">
@foreach([['Ürünler',$productCount,'info','fas fa-glasses','products.index'],['Kategoriler',$categoryCount,'success','fas fa-layer-group','categories.index'],['Markalar',$brandCount,'warning','fas fa-tags','brands.index'],['Siparişler',$orderCount,'danger','fas fa-shopping-bag','orders.index']] as $box)
<div class="col-lg-3 col-6"><div class="small-box bg-{{ $box[2] }}"><div class="inner"><h3>{{ $box[1] }}</h3><p>{{ $box[0] }}</p></div><div class="icon"><i class="{{ $box[3] }}"></i></div><a href="{{ route('admin.'.$box[4]) }}" class="small-box-footer">Git <i class="fas fa-arrow-circle-right"></i></a></div></div>
@endforeach
</div>
<div class="card"><div class="card-header"><strong>Son Siparişler</strong></div><div class="card-body table-responsive"><table class="table table-bordered"><thead><tr><th>No</th><th>Müşteri</th><th>Tutar</th><th>Durum</th></tr></thead><tbody>@forelse($latestOrders as $order)<tr><td>{{ $order->order_number }}</td><td>{{ $order->full_name }}</td><td>{{ number_format($order->total_price,2) }} ₺</td><td>{{ $order->status }}</td></tr>@empty<tr><td colspan="4" class="text-center text-muted">Henüz sipariş yok.</td></tr>@endforelse</tbody></table></div></div>
@endsection
