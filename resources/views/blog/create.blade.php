@extends('header')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    .ck-editor__editable{
        min-height: 500px;
    }
    .rating{
        display: flex;
        padding: 0;
        margin: 0 auto;
    }
    .rating li { list-style-type: none; }
    .rating-item{border: 1px solid #fff; cursor: pointer; color: red;}
    .rating-item::before{content: "\2605"; }
    .rating-item.active ~ .rating-item::before{ content: "\2606"; }
    .rating:hover .rating-item::before{content: "\2605"; }
    .rating-item:hover ~ .rating-item::before{content: "\2606";}
</style>
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('{{asset('/images/bg_1.jpg')}}');">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
            <div class="col-md-9 ftco-animate pb-5 text-center">
                <p class="breadcrumbs"><span class="mr-2"><a href="index.html">메인화면 <i
                                class="fa fa-chevron-right"></i></a></span> <span>블로그</span></p>
                <h1 class="mb-0 bread">글쓰기</h1>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section">
    <div class="container">
        <form action="{{route('blog.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label"><span style="font-weight: bold; color:black">제목</span></label>
                <input type="text" id="title" name="title" class="form-control"style="height:100% !important">
            </div>
            <div class="mb-3">
                <label for="thumbnail" class="form-label"><span style="font-weight: bold; color:black">썸네일 이미지</span></label>
                <input type="file" id="thumbnail" name="thumbnail" class="form-control" style="height:100% !important">
            </div>
            <div class="mb-3">
                <label for="content" class="form-label"><span style="font-weight: bold; color:black">내용</span></label>
                <textarea name="content" id="content" name="content" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <div class="row">
                    <div class="col">
                        <label for="Satisfaction" style="float: left; margin-right: 0.2rem"><span style="color:black;">만족도</span></label>
                        <ul class="rating">
                            <li class="rating-item" data-rate="1"></li>
                            <li class="rating-item" data-rate="2"></li>
                            <li class="rating-item" data-rate="3"></li>
                            <li class="rating-item" data-rate="4"></li>
                            <li class="rating-item" data-rate="5"></li>
                        </ul>
                        <div style="clear: both;"></div>
                    </div>
                    <div class="col" style="text-align: right;">
                        <input type="hidden" id="rate" value="0">
                        <button type="submit">저장</button>
                    </div>
                </div>
            </div>
            <script>
                const container = document.querySelector('.rating');
                const items = container.querySelectorAll('.rating-item');
                const rate = document.querySelector('#rate');

                container.onclick = e => {
                    const elClass = e.target.classList;
                    if(!elClass.contains('active')){
                        items.forEach( item => item.classList.remove('active'));
                        rate.value = e.target.getAttribute('data-rate');
                        elClass.add('active');
                    }
                }
            </script>
        </form>
    </div>
</section>
<script src="{{asset('ckeditor/ckeditor.js')}}"></script>
<script>
    const loadPage = () => {
        CKEDITOR.replace('content', {
            filebrowserUploadUrl: "{{route('blog.upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
        CKEDITOR.editorConfig = (config) => {
            config.htmlEncodeOutput = false;
            config.enterMode = CKEDITOR.ENTER_BR;
            config.allowedContent = true;
        }
    }
    const formSubmit = (f) => {
        CKEDITOR.instances.content.updateElement();
        if(f.content.value == ""){
            alert("내용을 입력해 주세요");
            return false;
        }
        alert(f.content.value);

        return false;
    }
    loadPage();
// Laravel에서 AJAX사용하려면 추가해줘야함
//xhr.setRequestHeader('X-CSRF-TOKEN', `${$("meta[name='csrf-token']").attr('content')}`);
</script>


@endsection
