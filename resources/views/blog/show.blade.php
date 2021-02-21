@extends('hmain')
@section('content')
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('{{asset("images/bg_1.jpg")}}');">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
            <div class="col-md-9 ftco-animate pb-5 text-center">
                <p class="breadcrumbs">
                    <span class="mr-2"><a href="/">Home <i class="fa fa-chevron-right"></i></a></span>
                    <span class="mr-2"><a href="{{route('blog.index')}}">블로그<i class="fa fa-chevron-right"></i></a></span>
                    <span>Blog Single</span>
            </div>
        </div>
    </div>
</section>

<div class="ftco-section ftco-no-pt pb-5">
    <div class="container">
        <div class="mt-5 mb-3">
            <h2>{{$row->title}}</h2>
        </div>
        <hr>
        <div class="mb-3 mt-5 text-right">
            @if((session()->exists('consumer')) && session()->get('consumer')->id != null && session()->get('consumer')->id == $row->user_id)
            <a href="{{route('blog.edit', $row->id)}}" class="btn btn-primary">수정</a>
            <a href="{{route('blog.destroy', $row->id)}}" class="btn btn-primary ml-3">삭제</a>
            @endif
        </div>
        <div class="mb-3 mt-5">
            {!! $content !!}
        </div>
    </div>
</div> <!-- .section -->

<script src="https://code.jquery.com/jquery-3.5.1.slim.js" integrity="sha256-DrT5NfxfbHvMHux31Lkhxg42LY6of8TaYyK50jnxRnM=" crossorigin="anonymous"></script>
@endsection
