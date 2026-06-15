@extends('admin.layout')

@section('title', 'Kategori Yönetimi')

@section('content_header')

<div class="eo-page-header">

    <div>

        <span class="eo-page-badge">
            <i class="fas fa-layer-group"></i>
            Eymen Optik
        </span>

        <h1>Kategori Yönetimi</h1>

        <p>
            Ürün kategorilerini yönetin, düzenleyin ve mağaza yapısını organize edin.
        </p>

    </div>

    <div class="eo-header-actions">

        <a href="{{ route('admin.categories.create') }}" class="btn eo-btn-primary">
            <i class="fas fa-plus"></i>
            Yeni Kategori
        </a>

    </div>

</div>

@endsection

@section('content')

@if(session('success'))

<div class="alert alert-success eo-alert-success">
    <i class="fas fa-check-circle"></i>
    {{ session('success') }}
</div>

@endif

<div class="card eo-card">

    <div class="card-header eo-card-header">

        <div>

            <h3>
                <i class="fas fa-folder-open"></i>
                Kategori Listesi
            </h3>

            <span>
                Toplam
                <strong>{{ $categories->total() ?? $categories->count() }}</strong>
                kategori bulunuyor.
            </span>

        </div>

    </div>

    <div class="card-body p-0">

        <div class="table-responsive">

            <table class="table eo-table mb-0">

                <thead>

                    <tr>
                        <th>Kategori</th>
                        <th>Slug</th>
                        <th>Durum</th>
                        <th class="text-right">İşlemler</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($categories as $category)

                    <tr>

                        {{-- Kategori --}}
                        <td>

                            <div class="eo-category-info">

                                <div class="eo-category-icon">
                                    <i class="fas fa-layer-group"></i>
                                </div>

                                <div>

                                    <strong>
                                        {{ $category->name }}
                                    </strong>

                                    <span>
                                        Ürün kategorisi
                                    </span>

                                </div>

                            </div>

                        </td>

                        {{-- Slug --}}
                        <td>

                            <span class="eo-slug">
                                {{ $category->slug }}
                            </span>

                        </td>

                        {{-- Durum --}}
                        <td>

                            @if($category->is_active)

                                <span class="badge badge-success eo-status-badge">
                                    Aktif
                                </span>

                            @else

                                <span class="badge badge-secondary eo-status-badge">
                                    Pasif
                                </span>

                            @endif

                        </td>

                        {{-- İşlemler --}}
                        <td class="text-right">

                            <div class="eo-actions">

                                <a
                                    href="{{ route('admin.categories.edit', $category) }}"
                                    class="btn eo-btn-edit btn-sm"
                                >
                                    <i class="fas fa-pen"></i>
                                    Düzenle
                                </a>

                                <form
                                    action="{{ route('admin.categories.destroy', $category) }}"
                                    method="POST"
                                    onsubmit="return confirm('Kategori silinsin mi?')"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn eo-btn-delete btn-sm"
                                    >
                                        <i class="fas fa-trash"></i>
                                        Sil
                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="5">

                            <div class="eo-empty">

                                <div class="eo-empty-icon">
                                    <i class="fas fa-layer-group"></i>
                                </div>

                                <h4>Henüz kategori bulunmuyor</h4>

                                <p>
                                    İlk kategoriyi oluşturarak ürün yapısını başlatın.
                                </p>

                                <a
                                    href="{{ route('admin.categories.create') }}"
                                    class="btn eo-btn-primary"
                                >
                                    <i class="fas fa-plus"></i>
                                    Kategori Ekle
                                </a>

                            </div>

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

    @if(method_exists($categories, 'links'))

    <div class="card-footer eo-pagination">
        {{ $categories->links() }}
    </div>

    @endif

</div>

@endsection

@section('page_css')

<style>

    .eo-page-header{
        display:flex;
        justify-content:space-between;
        align-items:center;
        gap:20px;
        padding:30px;
        border-radius:28px;
        margin-bottom:20px;
        background:
            radial-gradient(circle at top right, rgba(199,154,58,.18), transparent 30%),
            linear-gradient(135deg,#07111f,#17375f);
        color:#fff;
        box-shadow:0 24px 60px rgba(7,17,31,.18);
    }

    .eo-page-badge{
        display:inline-flex;
        align-items:center;
        gap:8px;
        padding:8px 14px;
        border-radius:999px;
        background:rgba(255,255,255,.12);
        font-size:12px;
        font-weight:800;
        margin-bottom:14px;
    }

    .eo-page-header h1{
        font-size:38px;
        font-weight:900;
        letter-spacing:-1.4px;
        margin-bottom:6px;
    }

    .eo-page-header p{
        margin:0;
        color:rgba(255,255,255,.68);
    }

    .eo-btn-primary{
        height:48px;
        padding:0 22px;
        border:none;
        border-radius:16px;
        background:linear-gradient(135deg,#2854d9,#17375f);
        color:#fff !important;
        font-weight:800;
        display:inline-flex;
        align-items:center;
        gap:10px;
        box-shadow:0 16px 34px rgba(40,84,217,.24);
    }

    .eo-btn-primary:hover{
        transform:translateY(-2px);
    }

    .eo-alert-success{
        border-radius:18px;
        border:none;
        display:flex;
        align-items:center;
        gap:10px;
    }

    .eo-card{
        border:none;
        border-radius:28px;
        overflow:hidden;
        box-shadow:0 20px 50px rgba(7,17,31,.08);
    }

    .eo-card-header{
        padding:24px 28px;
        border-bottom:1px solid rgba(7,17,31,.06);
        background:#fff;
    }

    .eo-card-header h3{
        font-size:20px;
        font-weight:900;
        margin:0 0 8px;
        display:flex;
        align-items:center;
        gap:10px;
        color:#07111f;
    }

    .eo-card-header span{
        color:#707b8d;
        font-size:14px;
        font-weight:600;
    }

    .eo-table thead th{
        border-top:none;
        border-bottom:1px solid rgba(7,17,31,.06);
        padding:18px;
        color:#707b8d;
        font-size:12px;
        text-transform:uppercase;
        letter-spacing:.5px;
    }

    .eo-table td{
        padding:18px;
        vertical-align:middle;
        border-top:1px solid rgba(7,17,31,.05);
    }

    .eo-id-box{
        width:54px;
        height:40px;
        border-radius:14px;
        background:#eef2f8;
        display:flex;
        align-items:center;
        justify-content:center;
        font-weight:900;
        color:#07111f;
    }

    .eo-category-info{
        display:flex;
        align-items:center;
        gap:14px;
        min-width:220px;
    }

    .eo-category-icon{
        width:52px;
        height:52px;
        border-radius:18px;
        background:linear-gradient(135deg,#2854d9,#17375f);
        display:grid;
        place-items:center;
        color:#fff;
        font-size:18px;
        box-shadow:0 12px 30px rgba(40,84,217,.20);
    }

    .eo-category-info strong{
        display:block;
        color:#07111f;
        font-size:15px;
        font-weight:900;
        margin-bottom:4px;
    }

    .eo-category-info span{
        color:#707b8d;
        font-size:13px;
        font-weight:700;
    }

    .eo-slug{
        display:inline-flex;
        align-items:center;
        justify-content:center;
        padding:8px 12px;
        border-radius:999px;
        background:#eef2f8;
        color:#394456;
        font-size:12px;
        font-weight:900;
    }

    .eo-status-badge{
        border-radius:999px;
        padding:8px 12px;
        font-size:11px;
        font-weight:800;
    }

    .eo-actions{
        display:flex;
        justify-content:flex-end;
        gap:8px;
        flex-wrap:wrap;
    }

    .eo-btn-edit{
        border:none;
        border-radius:14px;
        background:rgba(199,154,58,.14);
        color:#8a651c;
        font-weight:800;
        padding:8px 14px;
    }

    .eo-btn-delete{
        border:none;
        border-radius:14px;
        background:#fff0f0;
        color:#e33b3b;
        font-weight:800;
        padding:8px 14px;
    }

    .eo-empty{
        padding:60px 20px;
        text-align:center;
    }

    .eo-empty-icon{
        width:82px;
        height:82px;
        border-radius:26px;
        margin:0 auto 20px;
        display:grid;
        place-items:center;
        font-size:28px;
        color:#fff;
        background:linear-gradient(135deg,#2854d9,#17375f);
        box-shadow:0 20px 50px rgba(40,84,217,.24);
    }

    .eo-empty h4{
        font-size:24px;
        font-weight:900;
        margin-bottom:10px;
        color:#07111f;
    }

    .eo-empty p{
        color:#707b8d;
        margin-bottom:24px;
    }

    .eo-pagination{
        background:#fff;
        border-top:1px solid rgba(7,17,31,.06);
        padding:20px;
    }

    @media(max-width:768px){

        .eo-page-header{
            flex-direction:column;
            align-items:flex-start;
            padding:24px;
        }

        .eo-actions{
            justify-content:flex-start;
        }

    }

</style>

@endsection