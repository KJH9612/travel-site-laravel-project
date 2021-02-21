@extends('admin/amain')
@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- DataTales Example -->
	<div class="card shadow mb-4">
			<form method="post" action="{{route('a_consumer.destroy', $row->id)}}">
			@method('DELETE')
			@csrf
		<div class="card-header py-3">
			<h4 class="m-0 font-weight-bold text-primary"><i class="fas fa-address-book"> Consumer</i>
					<a href='#' class="btn btn-primary float-right" onclick="history.back();"><i class="fas fa-undo"></i></a>
					<span class="float-right">&nbsp;</span>
					<button  class="btn btn-primary float-right" onClick="return confirm('삭제할까요 ?');"><i class="fas fa-trash-alt"></i></button>
					<span class="float-right">&nbsp;</span>
					<a href="{{ route('a_consumer.edit', $row->id) }}" class="btn btn-primary float-right"><i class="fas fa-pen"></i></a>
				</h4>
		</div>
		<div class="card-body">
			<table class="table table-bordered table-striped">
			<?php
				$tel = substr($row->tel, 0, 3) ."-" .substr($row->tel, 3, 4) ."-" .substr($row->tel, 7, 4);
				$rank = $row->rank ? "관리자" : "사용자";
				$gender = $row->gender ? "여자" : "남자";
			?>
				  <tbody>
					<tr>
					  <th scope="row" width="20%" style="vertical-align:middle;">ID</th>
					  <td width="80%">
						<input type="text" class="form-control" name="id" size="30" value="{{$row->id}}" disabled>
					  </td>
					</tr>
					<tr>
					  <th scope="row" width="20%" style="vertical-align:middle;">name </th>
					  <td width="80%">
						<input type="text" class="form-control" name="name" size="30" value="{{$row->name}}" disabled>
					  </td>
					</tr>
					<tr>
					  <th scope="row" width="20%" style="vertical-align:middle;">uid </th>
					  <td width="80%">
						<input type="text" class="form-control" name="uid" size="30" value="{{$row->uid}}" disabled>
					  </td>
					</tr>
					<tr>
					  <th scope="row" width="20%" style="vertical-align:middle;">pwd </th>
					  <td width="80%">
						<input type="text" class="form-control" name="pwd" size="30" value="{{$row->pwd}}" disabled>
					  </td>
					</tr>
					<tr>
					  <th scope="row" width="20%" style="vertical-align:middle;">birthday </th>
					  <td width="80%">
						<input type="text" class="form-control" name="birthday" size="30" value="{{$row->birthday}}" disabled>
					  </td>
					</tr>
					<tr>
					  <th scope="row" width="20%" style="vertical-align:middle;">email </th>
					  <td width="80%">
						<input type="text" class="form-control" name="email" size="30" value="{{$row->email}}" disabled>
					  </td>
					</tr>
					<tr>
					  <th scope="row" width="20%" style="vertical-align:middle;">tel </th>
					  <td width="80%">
						<input type="text" class="form-control" name="tel" size="30" value="{{$tel}}" disabled>
					  </td>
					</tr>
					<tr>
					  <th scope="row" width="20%" style="vertical-align:middle;">gender </th>
					  <td width="80%">
						<input type="text" class="form-control" name="gender" size="30" value="{{$gender}}" disabled>
					  </td>
					</tr>
					<tr>
					  <th scope="row" width="20%" style="vertical-align:middle;">rank </th>
					  <td width="80%">
						<input type="text" class="form-control" name="rank" size="30" value="{{$rank}}" disabled>
					  </td>
					</tr>
					<tr>
					  <th scope="row" width="20%" style="vertical-align:middle;">pic</th>
					  <td width="80%">
						@if($row->pic)
						<p>{{$row->pic}}</p>
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
