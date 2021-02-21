@extends('admin/amain')
@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- DataTales Example -->
	<div class="card shadow mb-4">
			<form method="post" action="{{route('a_package_reservation.destroy', $row->id)}}">
			@method('DELETE')
			@csrf
		<div class="card-header py-3">
			<h4 class="m-0 font-weight-bold text-primary"><i class="fas fa-clipboard-list"> Package_Reservation</i>
					<a href='#' class="btn btn-primary float-right" onclick="history.back();"><i class="fas fa-undo"></i></a>
					<span class="float-right">&nbsp;</span>
					<button  class="btn btn-primary float-right" onClick="return confirm('삭제할까요 ?');"><i class="fas fa-trash-alt"></i></button>
					<span class="float-right">&nbsp;</span>
					<a href="{{ route('a_package_reservation.edit', $row->id) }}" class="btn btn-primary float-right"><i class="fas fa-pen"></i></a>
				</h4>
		</div>
		<div class="card-body">
			<table class="table table-bordered table-striped">
			<?php
				$option = array("조식추가", "침대사이즈 업", "휴대용 wifi", "항공기 업그레이드", "공항 셔틀버스");
				$service = "";
				if($row->breakfast == "on") $service = $service .$option[0];
				if($row->bedsize == "on") $service = $service ? $service .", " .$option[1] ." " : $service .$option[1];
				if($row->wifi == "on") $service = $service ? $service .", " .$option[2] ." " : $service .$option[2];
				if($row->airplaneup == "on") $service = $service ? $service .", " .$option[3] ." " : $service .$option[3];
				if($row->shuttle == "on") $service = $service ? $service .", " .$option[4] ." " : $service .$option[4];
				if(!$service) $service = "없음";
			?>
				  <tbody>
					<tr>
					  <th scope="row" width="20%" style="vertical-align:middle;">ID</th>
					  <td width="80%">
						<input type="text" class="form-control" name="id" size="30" value="{{$row->id}}" disabled>
					  </td>
					</tr>
					<tr>
					  <th scope="row" width="20%" style="vertical-align:middle;">consumer </th>
					  <td width="80%">
						<input type="text" class="form-control" name="consumer_id" size="30" value="{{$row->consumer_name}}({{$row->consumer_uid}})" disabled>
					  </td>
					</tr>
					<tr>
					  <th scope="row" width="20%" style="vertical-align:middle;">package</th>
					  <td width="80%">
						<input type="text" class="form-control" name="package_id" size="30" value="{{$row->package_name}} ({{$row->package_departure_date}} ~ {{$row->package_arrival_date}})" disabled>
					  </td>
					</tr>
					<tr>
					  <th scope="row" width="20%" style="vertical-align:middle;">adult </th>
					  <td width="80%">
						<input type="text" class="form-control" name="adult" size="30" value="{{$row->adult}}명" disabled>
					  </td>
					</tr>
					<tr>
					  <th scope="row" width="20%" style="vertical-align:middle;">kid </th>
					  <td width="80%">
						<input type="text" class="form-control" name="kid" size="30" value="{{$row->kid}}명" disabled>
					  </td>
					</tr>
					<tr>
					  <th scope="row" width="20%" style="vertical-align:middle;">baby </th>
					  <td width="80%">
						<input type="text" class="form-control" name="baby" size="30" value="{{$row->baby}}명" disabled>
					  </td>
					</tr>
					<tr>
					  <th scope="row" width="20%" style="vertical-align:middle;">service </th>
					  <td width="80%">
						<input type="text" class="form-control" name="" size="30" value="{{$service}}" disabled>
					  </td>
					</tr>
					<tr>
					  <th scope="row" width="20%" style="vertical-align:middle;">service_total </th>
					  <td width="80%">
						<input type="text" class="form-control" name="service_total" size="30" value="{{number_format($row->service_total)}}원" disabled>
					  </td>
					</tr>
					<tr>
					  <th scope="row" width="20%" style="vertical-align:middle;">package_total </th>
					  <td width="80%">
						<input type="text" class="form-control" name="package_total" size="30" value="{{number_format($row->package_total)}}원" disabled>
					  </td>
					</tr>
					<tr>
					  <th scope="row" width="20%" style="vertical-align:middle;">total </th>
					  <td width="80%">
						<input type="text" class="form-control" name="total" size="30" value="{{number_format($row->total)}}원" disabled>
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
