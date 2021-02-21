@extends('admin/amain')
@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- DataTales Example -->
	<div class="card shadow mb-4">
			<form method="post" action="{{route('a_package.destroy', $row->id)}}">
			@method('DELETE')
			@csrf
		<div class="card-header py-3">
			<h4 class="m-0 font-weight-bold text-primary"><i class="fas fa-route"> Package</i>
					<a href='#' class="btn btn-primary float-right" onclick="history.back();"><i class="fas fa-undo"></i></a>
					<span class="float-right">&nbsp;</span>
					<button  class="btn btn-primary float-right" onClick="return confirm('삭제할까요 ?');"><i class="fas fa-trash-alt"></i></button>
					<span class="float-right">&nbsp;</span>
					<a href="{{ route('a_package.edit', $row->id) }}" class="btn btn-primary float-right"><i class="fas fa-pen"></i></a>
				</h4>
		</div>
		<div class="card-body">
			<table class="table table-bordered table-striped">
				  <tbody>
					<tr>
					  <th scope="row" width="20%" style="vertical-align:middle;">ID</th>
					  <td width="80%">
						<input type="text" class="form-control" name="id" size="30" value="{{$row->id}}" disabled>
					  </td>
					</tr>
					<tr class="date">
					  <th scope="row" width="20%" style="vertical-align:middle;">nation </th>
					  <td width="80%">
						<input type="text" class="form-control" name="nation" size="30" value="{{$row->nation_name}}" disabled>
					  </td>
					</tr>
					<tr class="date">
					  <th scope="row" width="20%" style="vertical-align:middle;">name </th>
					  <td width="80%">
						<input type="text" class="form-control" name="name" size="30" value="{{$row->name}}" disabled>
					  </td>
					</tr>
					<tr>
					  <th scope="row" width="20%" style="vertical-align:middle;">explain</th>
					  <td width="80%">
						<textarea name="explain" rows="10" style="width:100%;" disabled >{{$row->explain}}</textarea>
					  </td>
					</tr>
					<tr class="date">
					  <th scope="row" width="20%" style="vertical-align:middle;">adult_price </th>
					  <td width="80%">
						<input type="text" class="form-control" name="adult_price" size="30" value="{{$row->adult_price}}" disabled>
					  </td>
					</tr>
					<tr class="date">
					  <th scope="row" width="20%" style="vertical-align:middle;">kid_price </th>
					  <td width="80%">
						<input type="text" class="form-control" name="kid_price" size="30" value="{{$row->kid_price}}" disabled>
					  </td>
					</tr>
					<tr class="date">
					  <th scope="row" width="20%" style="vertical-align:middle;">baby_price </th>
					  <td width="80%">
						<input type="text" class="form-control" name="baby_price" size="30" value="{{$row->baby_price}}" disabled>
					  </td>
					</tr>
					<tr class="date">
					  <th scope="row" width="20%" style="vertical-align:middle;">departure_date </th>
					  <td width="80%">
						<input type="text" class="form-control" name="departure_date" size="30" value="{{$row->departure_date}}" disabled>
					  </td>
					</tr>
					<tr class="date">
					  <th scope="row" width="20%" style="vertical-align:middle;">arrival_date </th>
					  <td width="80%">
						<input type="text" class="form-control" name="arrival_date" size="30" value="{{$row->arrival_date}}" disabled>
					  </td>
					</tr>
					<tr>
					  <th scope="row" width="20%" style="vertical-align:middle;">pic</th>
					  <td width="80%">
						<p>{{$row->pic}}</p>
						<img src="/storage/package_pic/{{$row->pic}}" style="width:300px;height:200px">
					  </td>
					</tr>
					<?php
						$departure_schedule = $row->departure_start_airport_name ?
						$row->departure_start_airport_name ."(" .$row->departure_start_city_name .")" .$row->departure_schedule_startDate ."->" .$row->departure_end_airport_name ."(" .$row->departure_end_city_name .")" .$row->departure_schedule_endDate
						: "없음";
						$arrival_schedule = $row->arrival_start_airport_name ?
						$row->arrival_start_airport_name ."(" .$row->arrival_start_city_name .")" .$row->arrival_schedule_startDate ."->"  .$row->arrival_end_airport_name ."(" .$row->arrival_end_city_name .")" .$row->arrival_schedule_endDate
						: "없음";
					?>
					<tr class="date">
					  <th scope="row" width="20%" style="vertical-align:middle;">departure_schedule </th>
					  <td width="80%">
						<input type="text" class="form-control" name="departure_schedule_id" size="30" value="{{$departure_schedule}}" disabled>
					  </td>
					</tr>
					<tr class="date">
					  <th scope="row" width="20%" style="vertical-align:middle;">arrival_schedule </th>
					  <td width="80%">
						<input type="text" class="form-control" name="arrival_schedule_id" size="30" value="{{$arrival_schedule}}" disabled>
					  </td>
					</tr>
					<tr class="date">
					  <th scope="row" width="20%" style="vertical-align:middle;">star </th>
					  <td width="80%">
						<input type="text" class="form-control" name="star" size="30" value="{{$row->star}}" disabled>
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
