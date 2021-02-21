@extends('hmain')
@section('content')
<style>
    .btn-absol{position: absolute; bottom: 0;left: auto;}
    .blog-entry .text{ min-height: 280px;}
    .blog-entry.justify-content-end {width: 100%;}
    .ftco-section.m-section {min-height: 1936px;max-height: 1936px;}
    @media (max-width:767px) {
        .blog-entry .text{ min-height: 200px !important;}
        .ftco-section.m-section {max-height: none;}
    }
    @media (max-width:990px) {
        .blog-entry .text{ min-height: 390px;}
        .ftco-section.m-section {max-height: none;}
    }
</style>
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/bg_1.jpg');">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
            <div class="col-md-9 ftco-animate pb-5 text-center">
                <p class="breadcrumbs"><span class="mr-2"><a href="index.html">메인화면 <i
                                class="fa fa-chevron-right"></i></a></span> <span>블로그</span></p>
                <h1 class="mb-0 bread">블로그</h1>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section m-section">
    <div class="container">
        <div class="row d-flex">
            @foreach ($list as $item)
            @if($item->deleteTime == null)
            <?php
                $content_length = mb_strlen($item->content);
            ?>
            <div class="col-md-4 d-flex ftco-animate">
                <div class="blog-entry justify-content-end">
                    <a href="{{route('blog.show', $item->id)}}" class="block-20" style="background-image: url('images/thumbnail/{{$item->thumb}}');">
                    </a>
                    <div class="text">
                        <div class="d-flex align-items-center mb-4 topp">
                            <div class="one">
                                <span class="day">11</span>
                            </div>
                            <div class="two">
                                <span class="yr">2020</span>
                                <span class="mos">September</span>
                            </div>
                        </div>
                        <h3 class="heading"><a href="{{route('blog.show', $item->id)}}">{{$item->title}}</a></h3>
                        <p>{{$item->created_at}}</p>
                        <p style="position: absolute !important; bottom: 0 !important; margin-bottom:1.4rem !important;"><a href="{{route('blog.show', $item->id)}}" class="btn btn-primary">Read more</a></p>
                    </div>
                </div>
            </div>
            @endif
            @endforeach

            <div class="col-md-4 d-flex ftco-animate">
                <div class="blog-entry justify-content-end">
                    <a href="blog-single.html" class="block-20" style="background-image: url('images/image_1.jpg');">
                    </a>
                    <div class="text">
                        <div class="d-flex align-items-center mb-4 topp">
                            <div class="one">
                                <span class="day">11</span>
                            </div>
                            <div class="two">
                                <span class="yr">2020</span>
                                <span class="mos">September</span>
                            </div>
                        </div>
                        <h3 class="heading"><a href="#">Most Popular Place In This World</a></h3>
                        <p>한글테스트용 한글테스트용 한글테스트용 한글테스트용</p>
                        <p class="btn-absol"><a href="#" class="btn btn-primary">Read more</a></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 d-flex ftco-animate">
                <div class="blog-entry justify-content-end">
                    <a href="blog-single.html" class="block-20" style="background-image: url('images/image_2.jpg');">
                    </a>
                    <div class="text">
                        <div class="d-flex align-items-center mb-4 topp">
                            <div class="one">
                                <span class="day">11</span>
                            </div>
                            <div class="two">
                                <span class="yr">2020</span>
                                <span class="mos">September</span>
                            </div>
                        </div>
                        <h3 class="heading"><a href="#">Most Popular Place In This World</a></h3>
                        <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.
                        </p>
                        <p class="btn-absol"><a href="#" class="btn btn-primary">Read more</a></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 d-flex ftco-animate">
                <div class="blog-entry">
                    <a href="blog-single.html" class="block-20" style="background-image: url('images/image_3.jpg');">
                    </a>
                    <div class="text">
                        <div class="d-flex align-items-center mb-4 topp">
                            <div class="one">
                                <span class="day">11</span>
                            </div>
                            <div class="two">
                                <span class="yr">2020</span>
                                <span class="mos">September</span>
                            </div>
                        </div>
                        <h3 class="heading"><a href="#">Most Popular Place In This World</a></h3>
                        <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.
                        </p>
                        <p class="btn-absol"><a href="#" class="btn btn-primary">Read more</a></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 d-flex ftco-animate">
                <div class="blog-entry">
                    <a href="blog-single.html" class="block-20" style="background-image: url('images/image_4.jpg');">
                    </a>
                    <div class="text">
                        <div class="d-flex align-items-center mb-4 topp">
                            <div class="one">
                                <span class="day">11</span>
                            </div>
                            <div class="two">
                                <span class="yr">2020</span>
                                <span class="mos">September</span>
                            </div>
                        </div>
                        <h3 class="heading"><a href="#">Most Popular Place In This World</a></h3>
                        <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.
                        </p>
                        <p class="btn-absol"><a href="#" class="btn btn-primary">Read more</a></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 d-flex ftco-animate">
                <div class="blog-entry">
                    <a href="blog-single.html" class="block-20" style="background-image: url('images/image_5.jpg');">
                    </a>
                    <div class="text">
                        <div class="d-flex align-items-center mb-4 topp">
                            <div class="one">
                                <span class="day">11</span>
                            </div>
                            <div class="two">
                                <span class="yr">2020</span>
                                <span class="mos">September</span>
                            </div>
                        </div>
                        <h3 class="heading"><a href="#">Most Popular Place In This World</a></h3>
                        <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.
                        </p>
                        <p class="btn-absol"><a href="#" class="btn btn-primary">Read more</a></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col text-center">
                <div class="block-27">
                    <ul>
                        <li><a href="#">&lt;</a></li>
                        <li class="active"><span>1</span></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li><a href="#">&gt;</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="ftco-intro ftco-section ftco-no-pt">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 text-center">
                <div class="img" style="background-image: url(images/bg_2.jpg);">
                    <div class="overlay"></div>
                    <h2>We Are Pacific A Travel Agency</h2>
                    <p>We can manage your dream building A small river named Duden flows by their place</p>
                    <p class="mb-0"><a href="#" class="btn btn-primary px-4 py-3">Ask For A Quote</a></p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
