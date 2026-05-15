@extends('frontend.layout')

@section('title','Blog Detay')

@section('content')

<section style="padding:100px 0;">
    <div class="container">

        <h1 style="font-size:60px;margin-bottom:20px;">
            {{ str_replace('-', ' ', ucfirst($slug)) }}
        </h1>

        <p style="max-width:800px;line-height:2;color:#666;">
            Blog detay içeriği burada yer alacak.
            Daha sonra admin panelden dinamik hale getirebiliriz.
        </p>

    </div>
</section>

@endsection