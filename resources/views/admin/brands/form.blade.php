@extends('adminlte::page')
@section('title','Marka')
@section('content_header')<h1>Marka {{ $brand->exists ? 'Düzenle':'Ekle' }}</h1>@endsection
@section('content')<div class="card"><div class="card-body"><form method="POST" action="{{ $brand->exists ? route('admin.brands.update',$brand) : route('admin.brands.store') }}">@csrf @if($brand->exists) @method('PUT') @endif <div class="form-group"><label>Ad</label><input name="name" value="{{ old('name',$brand->name) }}" class="form-control" required></div><label><input type="checkbox" name="is_active" value="1" {{ old('is_active',$brand->is_active ?? true) ? 'checked':'' }}> Aktif</label><br><button class="btn btn-primary mt-3">Kaydet</button></form></div></div>@endsection
