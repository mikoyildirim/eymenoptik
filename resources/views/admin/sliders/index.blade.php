@extends('adminlte::page')

@section('title', 'Slider Yönetimi')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <div>
        <h1 class="mb-0">Slider Yönetimi</h1>
        <small class="text-muted">
            Ana sayfa sliderlarını yönetin
        </small>
    </div>

    <a href="{{ route('admin.sliders.create') }}" class="btn btn-dark">
        <i class="fas fa-plus"></i>
        Yeni Slider
    </a>
</div>
@endsection

@section('content')

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="card">
    <div class="card-body p-0">

        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th width="100">Görsel</th>
                    <th>Başlık</th>
                    <th>Badge</th>
                    <th>Sıra</th>
                    <th>Durum</th>
                    <th width="180">İşlem</th>
                </tr>
            </thead>

            <tbody>

            @forelse($sliders as $slider)

                <tr>

                    <td>
                        @if($slider->image)
                            <img
                                src="{{ asset($slider->image) }}"
                                style="width:80px;height:60px;object-fit:cover;border-radius:10px;"
                            >
                        @endif
                    </td>

                    <td>
                        <strong>{{ $slider->title }}</strong>
                    </td>

                    <td>
                        {{ $slider->badge }}
                    </td>

                    <td>
                        {{ $slider->sort_order }}
                    </td>

                    <td>
                        @if($slider->is_active)
                            <span class="badge badge-success">
                                Aktif
                            </span>
                        @else
                            <span class="badge badge-danger">
                                Pasif
                            </span>
                        @endif
                    </td>

                    <td>

                        <a
                            href="{{ route('admin.sliders.edit',$slider) }}"
                            class="btn btn-sm btn-primary"
                        >
                            Düzenle
                        </a>

                        <form
                            action="{{ route('admin.sliders.destroy',$slider) }}"
                            method="POST"
                            class="d-inline"
                        >
                            @csrf
                            @method('DELETE')

                            <button
                                onclick="return confirm('Silinsin mi?')"
                                class="btn btn-sm btn-danger"
                            >
                                Sil
                            </button>
                        </form>

                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="6" class="text-center py-5">
                        Henüz slider eklenmemiş.
                    </td>
                </tr>

            @endforelse

            </tbody>

        </table>

    </div>
</div>

@endsection