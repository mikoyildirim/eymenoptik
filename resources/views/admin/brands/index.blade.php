@extends('adminlte::page')
@section('title','Markalar')
@section('content_header')<div class="d-flex justify-content-between"><h1>Markalar</h1><a href="{{ route('admin.brands.create') }}" class="btn btn-primary">Yeni Ekle</a></div>@endsection
@section('content')@if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
<div class="card"><div class="card-body table-responsive"><table class="table table-bordered"><tr><th>ID</th><th>Ad</th><th>Durum</th><th></th></tr>@foreach($brands as $brand)<tr><td>{{ $brand->id }}</td><td>{{ $brand->name }}</td><td>{{ $brand->is_active ? 'Aktif':'Pasif' }}</td><td><a href="{{ route('admin.brands.edit',$brand) }}" class="btn btn-sm btn-warning">Düzenle</a><form action="{{ route('admin.brands.destroy',$brand) }}" method="POST" class="d-inline">@csrf @method('DELETE')<button class="btn btn-sm btn-danger">Sil</button></form></td></tr>@endforeach</table>{{ $brands->links() }}</div></div>@endsection
