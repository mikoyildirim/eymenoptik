@extends('adminlte::page')

@section('css')

<style>

    body{
        font-family: 'Inter', sans-serif;
    }

    .content-wrapper{
        background:
            radial-gradient(circle at top left, rgba(40,84,217,.08), transparent 26%),
            radial-gradient(circle at top right, rgba(199,154,58,.10), transparent 24%),
            #f4f6fb;
    }

    .card{
        border:none;
        border-radius:24px;
        box-shadow:0 18px 44px rgba(7,17,31,.06);
    }

    .btn{
        border-radius:14px;
        font-weight:700;
    }

    .table{
        margin:0;
    }

    .table thead th{
        border-top:none;
    }

</style>

@yield('page_css')

@endsection


@section('js')

@yield('page_js')

@endsection