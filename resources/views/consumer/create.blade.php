@extends('main')
@section('content')

 <!-- Start secstion -->
<style>
.input-margin{
	margin-bottom:20px; 
}
.input-padding{
	padding:6px 10;
}
</style>


 <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url(&quot;/images/bg_1.jpg&quot;); height: 912px;">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center" style="height: 912px;">
      <div class="col-md-9 ftco-animate pb-5 text-center fadeInUp ftco-animated">
       <p class="breadcrumbs"><span class="mr-2"><a href="/">Home <i class="fa fa-chevron-right"></i></a></span> <span>Sign up <i class="fa fa-chevron-right"></i></span></p>
       <h1 class="mb-0 bread">Sign up
	   </h1>
     </div>
   </div>
 </div>
</section>


<div class="container">
	<div class="offset-lg-1 offset-md-1 col-lg-10 col-md-10 card" style="margin-top:30px;margin-bottom:30px;color:black;">
		<h6 style="margin-top:30px;font-weight:600;font-size:19px;">회원가입</h6>
		<hr>
		<form action="{{route('consumer.store')}}" method="post" enctype="multipart/form-data">
		@csrf
			<div class="input-margin">
				<label for="name">이름 <span style="color:red;">*</span></label>
				<input type="text" placeholder="이름" name="name"  value="{{old('name')}}" class="form-control input-margin input-padding"  maxlength="20" required="">
				@error('name'){{$message}} @enderror
			</div>
			<div class="input-margin">
				<label for="birthday">생년월일 <span style="color:red;">*</span></label>
				<input type="text" placeholder="주민등록번호 앞 6자리" name="birthday" value="{{old('birthday')}}" class="form-control input-padding" maxlength="6" required="">
				@error('birthday'){{$message}} @enderror
			</div>
			<div class="input-margin">
				<label for="uid">아이디 <span style="color:red;">*</span></label>
				<input type="text" placeholder="아이디" name="uid"  value="{{old('uid')}}" class="form-control input-padding"  maxlength="20" required="">
				@error('uid'){{$message}} @enderror
			</div>
			<div class="input-margin">
				<label for="pwd">비밀번호 <span style="color:red;">*</span></label>
				<input type="password" placeholder="비밀번호" name="pwd" value="{{old('pwd')}}" class="form-control input-padding" maxlength="20" required="">
				@error('pwd'){{$message}} @enderror
			</div>
			<div class="input-margin">
				<label for="email">이메일</label>
				<input type="text" placeholder="이메일" name="email" value="" class="form-control input-padding" maxlength="50">
			</div>
			<div class="input-margin">
				<label for="tel">전화번호<span style="color:red;">*</span></label>
				<div class="form-inline">
					<input type="text" name="tel1" size="3" maxlength="3" value="{{old('tel1')}}" maxlength="50" required="" class="form-control form-control-sm">&nbsp; - &nbsp;
					<input type="text" name="tel2" size="4" maxlength="4" value="{{old('tel2')}}"  maxlength="50" required="" class="form-control form-control-sm">&nbsp; - &nbsp;
					<input type="text" name="tel3" size="4" maxlength="4" value="{{old('tel3')}}" maxlength="50" required="" class="form-control form-control-sm">
					@error('tel1'){{$message}} @enderror
					@error('tel2'){{$message}} @enderror
					@error('tel3'){{$message}} @enderror
				</div>
			</div>
			<div class="input-margin">
				<label for="gender">성별 <span style="color:red;">*</span></label>
				<div>
					<input type="radio" name="gender" value="0" checked>남자 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="radio" name="gender" value="1">여자
				</div>
			</div>
			<div>
				<label for="pic">사진 </label>
				<input type="file" name="pic" value="" class="form-control form-control-sm">
			</div>
			<div class="card-body text-center">
				<hr>
				<button type="submit" class="btn btn-block btn-info" style="min-height:50px;font-weight:600;font-size:16px;">회원가입</button>
			</div>
		</form>
	</div>
</div>
@endsection()