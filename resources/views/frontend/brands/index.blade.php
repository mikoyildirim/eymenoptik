@extends('frontend.layout')

@section('title', 'Markalar')

@section('content')

<section style="padding:70px 0;background:#f7f7f7;">
    <div class="container">

        <div style="margin-bottom:35px;">
            <span style="background:#000;color:#fff;padding:8px 14px;font-size:12px;font-weight:900;">
                MARKALAR
            </span>

            <h1 style="font-size:56px;line-height:1;margin-top:18px;">
                Eymen Optik Markaları
            </h1>

            <p style="color:#666;margin-top:12px;">
                Mağazamızdaki aktif markaları inceleyebilirsiniz.
            </p>
        </div>

        <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:20px;">

            @forelse($brands as $brand)

                <a
                    href="{{ route('products.index') }}?brand={{ $brand->slug }}"
                    style="background:#fff;padding:30px;border:1px solid #eee;display:block;"
                >
                    <h3 style="font-size:24px;margin-bottom:8px;">
                        {{ $brand->name }}
                    </h3>

                    <span style="color:#777;font-weight:700;">
                        {{ $brand->products_count }} ürün
                    </span>
                </a>

            @empty

                <div style="grid-column:1 / -1;background:#fff;padding:30px;color:#777;">
                    Henüz marka bulunmuyor.
                </div>

            @endforelse

        </div>

    </div>
</section>

@endsection