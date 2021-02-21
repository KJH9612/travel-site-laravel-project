@extends('admin/amain')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- DataTales Example -->
	<div class="card shadow mb-4">
			<form method="post" action="{{route('a_consumer.update', $row->id)}}" enctype="multipart/form-data">
			@method('PATCH')
			@csrf
		<div class="card-header py-3">
			<h4 class="m-0 font-weight-bold text-primary"><i class="fas fa-address-book"> Consumer</i>
					<a href='#' class="btn btn-primary float-right" onclick="history.back();"><i class="fas fa-undo"></i></a>
					<span class="float-right">&nbsp;</span>
					<button class="btn btn-primary float-right"><i class="fas fa-check"></i></button>
				</h4>
		</div>
		<div class="card-body">
			<table class="table table-bordered table-striped">
					<?php
						$tel1 = trim(substr($row->tel, 0, 3));
						$tel2 = trim(substr($row->tel, 3, 4));
						$tel3 = trim(substr($row->tel, 7, 10));
					?>
				  <tbody>
					<tr>
					  <th scope="row" width="20%" style="vertical-align:middle;">ID</th>
					  <td width="80%">
						<input type="text" class="form-control" name="id" size="30" value="{{$row->id}}" disabled>
					  </td>
					</tr>
					<th scope="row" width="20%" style="vertical-align:middle;">name <font color="red">*</font></th>
					  <td width="80%">
						<input type="text" class="form-control" name="name" size="30" value="{{$row->name}}" placeholder="이름을 입력해주세요.">
						@error('name') {{ $message }} @enderror
					  </td>
					</tr>
					<tr>
					  <th scope="row" width="20%" style="vertical-align:middle;">uid <font color="red">*</font></th>
					  <td width="80%">
						<input type="text" class="form-control" name="uid" size="30" value="{{$row->uid}}" placeholder="사용자 아이디를 입력해주세요.">
						@error('uid') {{ $message }} @enderror
					  </td>
					</tr>
					<tr>
					  <th scope="row" width="20%" style="vertical-align:middle;">pwd <font color="red">*</font></th>
					  <td width="80%">
						<input type="text" class="form-control" name="pwd" size="30" value="{{$row->pwd}}" placeholder="비밀번호를 입력해주세요.">
						@error('pwd') {{ $message }} @enderror
					  </td>
					</tr>
					<tr>
					<tr>
					  <th scope="row" width="20%" style="vertical-align:middle;">birthday <font color="red">*</font></th>
					  <td width="80%">
						<input type="text" class="form-control" name="birthday" size="30" value="{{$row->birthday}}" maxlength="6" placeholder="생일 6자리를 입력해주세요">
						@error('birthday') {{ $message }} @enderror
					  </td>
					</tr>
					<tr>
					  <th scope="row" width="20%" style="vertical-align:middle;">email </th>
					  <td width="80%">
						<input type="text" class="form-control" name="email" size="30" value="{{$row->email}}" placeholder="이메일을 입력해주세요.">
					  </td>
					</tr>
					<tr>
					  <th scope="row" width="20%" style="vertical-align:middle;">tel <font color="red">*</font></th>
					  <td width="80%">
						<div class="form-inline">
							<input type="text" name="tel1" size="3" maxlength="3" value="{{$tel1}}" maxlength="50" required="" class="form-control form-control-sm">&nbsp; - &nbsp;
							<input type="text" name="tel2" size="4" maxlength="4" value="{{$tel2}}"  maxlength="50" required="" class="form-control form-control-sm">&nbsp; - &nbsp;
							<input type="text" name="tel3" size="4" maxlength="4" value="{{$tel3}}" maxlength="50" required="" class="form-control form-control-sm">
						</div>
						@error('tel1'){{$message}} @enderror
						@error('tel2'){{$message}} @enderror
						@error('tel3'){{$message}} @enderror
					  </td>
					</tr>
					<tr>
					  <th scope="row" width="20%" style="vertical-align:middle;">gender <font color="red">*</font></th>
					  <td width="80%">
						<div>
							@if($row->gender == 0)
							<input type="radio" name="gender" value="0" checked>남자 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="radio" name="gender" value="1">여자
							@else
							<input type="radio" name="gender" value="0">남자 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="radio" name="gender" value="1" checked>여자
							@endif
						</div>
						@error('gender') {{ $message }} @enderror
					  </td>
					</tr>
					<tr>
					  <th scope="row" width="20%" style="vertical-align:middle;">rank <font color="red">*</font></th>
					  <td width="80%">
						<div>
							@if($row->rank == 0)
							<input type="radio" name="rank" value="0" checked>사용자 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="radio" name="rank" value="1">관리자
							@else
							<input type="radio" name="rank" value="0">사용자 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="radio" name="rank" value="1" checked>관리자
							@endif
						</div>
						@error('rank') {{ $message }} @enderror
					  </td>
					</tr>
					<tr>
					  <th scope="row" width="20%" style="vertical-align:middle;">pic </th>
					  <td width="80%">
						<input type="file" class="form-control" name="pic" size="30" value="">
						@if($row->pic)
						<p>{{$row->pic}}</p><input type="checkbox" name="del_pic" value="1"> <span style="color:red;">*</span>삭제하기</div>
						<img src="/storage/user_pic/{{$row->pic}}" style="width:300px;height:200px">
						@else
						<p>등록된 사진이 없습니다.</p>
						@endif
					  </td>
					</tr>
				  </tbody>
				</table>
		</div>
			</form>
	</div>

</div>

<!-- /.container-fluid -->

 @stop
