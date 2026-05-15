@extends('frontend.layout')

@section('title','Blog')

@section('content')

<section class="blog-page">
    <div class="container">

        <div class="blog-header">
            <span>BLOG</span>
            <h1>Eymen Optik Blog</h1>
            <p>
                Gözlük modası, lens teknolojileri ve stil önerileri.
            </p>
        </div>

        <div class="blog-grid">

            @foreach($posts as $post)

                <article class="blog-card">

                    <a href="{{ route('blog.show', $post['slug']) }}" class="blog-image">
                        <img src="{{ $post['image'] }}" alt="{{ $post['title'] }}">
                    </a>

                    <div class="blog-content">

                        <h3>
                            {{ $post['title'] }}
                        </h3>

                        <p>
                            {{ $post['excerpt'] }}
                        </p>

                        <a href="{{ route('blog.show', $post['slug']) }}" class="blog-btn">
                            Devamını Oku
                        </a>

                    </div>

                </article>

            @endforeach

        </div>

    </div>
</section>

<style>

.blog-page{
    padding:60px 0;
    background:#f7f7f7;
}

.blog-header{
    margin-bottom:40px;
}

.blog-header span{
    display:inline-block;
    background:#000;
    color:#fff;
    padding:8px 14px;
    font-size:12px;
    font-weight:900;
    margin-bottom:20px;
}

.blog-header h1{
    font-size:60px;
    line-height:1;
    margin-bottom:15px;
    letter-spacing:-3px;
}

.blog-header p{
    max-width:600px;
    color:#666;
    line-height:1.8;
}

.blog-grid{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:24px;
}

.blog-card{
    background:#fff;
    overflow:hidden;
    box-shadow:0 20px 60px rgba(0,0,0,.05);
    transition:.3s ease;
}

.blog-card:hover{
    transform:translateY(-8px);
}

.blog-image{
    height:280px;
    display:block;
    overflow:hidden;
}

.blog-image img{
    width:100%;
    height:100%;
    object-fit:cover;
    transition:.4s ease;
}

.blog-card:hover img{
    transform:scale(1.08);
}

.blog-content{
    padding:24px;
}

.blog-content h3{
    font-size:26px;
    margin-bottom:12px;
    line-height:1.2;
}

.blog-content p{
    color:#666;
    line-height:1.7;
    margin-bottom:20px;
}

.blog-btn{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    height:46px;
    padding:0 22px;
    background:#000;
    color:#fff;
    font-weight:800;
}

@media(max-width:992px){

    .blog-grid{
        grid-template-columns:1fr 1fr;
    }

}

@media(max-width:680px){

    .blog-grid{
        grid-template-columns:1fr;
    }

    .blog-header h1{
        font-size:42px;
    }

}

</style>

@endsection