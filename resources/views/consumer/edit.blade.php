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
.my-active{
	background-color:#F15D30;
	border:1px solid rgba(0, 0, 0, 0.125);
	color:#fff;
}
.my-nonactive{
	background-color:#fff;
	border:1px solid rgba(0, 0, 0, 0.125);;
	color:#000;
}
</style>


 <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url(&quot;/images/bg_1.jpg&quot;); height: 912px;">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center" style="height: 912px;">
      <div class="col-md-9 ftco-animate pb-5 text-center fadeInUp ftco-animated">
       <p class="breadcrumbs"><span class="mr-2"><a href="/">Home <i class="fa fa-chevron-right"></i></a></span> <span>My Page <i class="fa fa-chevron-right"></i></span><span>My Info <i class="fa fa-chevron-right"></i></span></p>
       <h1 class="mb-0 bread">My Info
	   </h1>
     </div>
   </div>
 </div>
</section>

<div class="container">
	<div class="offset-lg-1 offset-md-1 col-lg-10 col-md-10" style="margin-top:30px;padding-left:0px;">
		<div class="btn-group btn-group-toggle" data-toggle="buttons">
			<a href="{{route('consumer.edit', session()->get('consumer')->id)}}"><button class="btn my-active">My Info</button></a>
			<a href="{{route('consumer_reservation.index',['id'=> session()->get('consumer')->id]) }}"><button class="btn active my-nonactive">Reservation</button></a>
		</div>
	</div>
	<div class="offset-lg-1 offset-md-1 col-lg-10 col-md-10 card" style="margin-top:0px;margin-bottom:30px;color:black;">
		<h6 style="margin-top:30px;font-weight:600;font-size:19px;">내 정보</h6>
		<hr>
		<form action="{{route('consumer.update', $row->id)}}" method="post" enctype="multipart/form-data">
		@method('PATCH')
		@csrf
			<div class="input-margin">
				<label for="name">이름 <span style="color:red;">*</span></label>
				<input type="text" placeholder="이름" name="name"  value="{{$row->name}}" class="form-control input-margin input-padding"  maxlength="20" required="" readonly>
				@error('name'){{$message}} @enderror
			</div>
			<div class="input-margin">
				<label for="birthday">생년월일 <span style="color:red;">*</span></label>
				<input type="text" placeholder="주민등록번호 앞 6자리" name="birthday" value="{{$row->birthday}}" class="form-control input-padding" maxlength="6" required="" readonly>
				@error('birthday'){{$message}} @enderror
			</div>
			<div class="input-margin">
				<label for="uid">아이디 <span style="color:red;">*</span></label>
				<input type="text" placeholder="아이디" name="uid"  value="{{$row->uid}}" class="form-control input-padding"  maxlength="20" required="" readonly>
				@error('uid'){{$message}} @enderror
			</div>
			<div class="input-margin">
				<label for="pwd">비밀번호&nbsp&nbsp <span style="color:red;">*</span>변경 시 입력</label>
				<input type="password" placeholder="변경 시 입력" name="pwd" value="" class="form-control input-padding" maxlength="20">
			</div>
			<div class="input-margin">
				<label for="email">이메일</label>
				<input type="text" placeholder="이메일" name="email" value="{{$row->email}}" class="form-control input-padding" maxlength="50">
			</div>
			<?php
				$tel1 = trim(substr($row->tel,0,3));
				$tel2 = trim(substr($row->tel,3,4));
				$tel3 = trim(substr($row->tel,7,4));
			?>
			<div class="input-margin">
				<label for="tel">전화번호<span style="color:red;">*</span></label>
				<div class="form-inline">
					<input type="text" name="tel1" size="3" maxlength="3" value="{{$tel1}}" maxlength="50" required="" class="form-control form-control-sm">&nbsp; - &nbsp;
					<input type="text" name="tel2" size="4" maxlength="4" value="{{$tel2}}"  maxlength="50" required="" class="form-control form-control-sm">&nbsp; - &nbsp;
					<input type="text" name="tel3" size="4" maxlength="4" value="{{$tel3}}" maxlength="50" required="" class="form-control form-control-sm">
					@error('tel1'){{$message}} @enderror
					@error('tel2'){{$message}} @enderror
					@error('tel3'){{$message}} @enderror
				</div>
			</div>
			<div class="input-margin">
				<label for="gender">성별 <span style="color:red;">*</span></label>
				<div>
					@if($row->gender == 0)
					<input type="radio" name="gender" value="0" checked>남자 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="radio" name="gender" value="1">여자
					@else
					<input type="radio" name="gender" value="0">남자 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="radio" name="gender" value="1" checked>여자
					@endif
				</div>
			</div>
			<div>
				<label for="pic">사진 </label><br>
				@if($row->pic)
				<img src="/storage/user_pic/{{$row->pic}}" width="300px" height="300px">
				<div><input type="checkbox" name="del_pic" value="1"> <span style="color:red;">*</span>삭제하기</div>
				@endif
				<input type="file" name="pic" value="" class="form-control form-control-sm">
			</div>
			<div class="card-body text-center">
				<hr>
				<button type="submit" class="btn btn-block btn-info" style="min-height:50px;font-weight:600;font-size:16px;">수정하기</button>
			</div>
		</form>
	</div>
</div>
@endsection()
