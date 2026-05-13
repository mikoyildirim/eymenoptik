@extends('adminlte::page')
@section('title','Kategori')
@section('content_header')<h1>Kategori {{ $category->exists ? 'Düzenle':'Ekle' }}</h1>@endsection
@section('content')<div class="card"><div class="card-body"><form method="POST" action="{{ $category->exists ? route('admin.categories.update',$category) : route('admin.categories.store') }}">@csrf @if($category->exists) @method('PUT') @endif <div class="form-group"><label>Ad</label><input name="name" value="{{ old('name',$category->name) }}" class="form-control" required></div><label><input type="checkbox" name="is_active" value="1" {{ old('is_active',$category->is_active ?? true) ? 'checked':'' }}> Aktif</label><br><button class="btn btn-primary mt-3">Kaydet</button></form></div></div>@endsection
