@extends('admin/amain')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- DataTales Example -->
	<div class="card shadow mb-4">
			<form method="post" action="{{route('a_package_reservation.update', $row->id)}}" enctype="multipart/form-data">
			@method('PATCH')
			@csrf
		<div class="card-header py-3">
			<h4 class="m-0 font-weight-bold text-primary"><i class="fas fa-clipboard-list"> Package_Reservation</i>
					<a href='#' class="btn btn-primary float-right" onclick="history.back();"><i class="fas fa-undo"></i></a>
					<span class="float-right">&nbsp;</span>
					<button class="btn btn-primary float-right"><i class="fas fa-check"></i></button>
				</h4>
		</div>
		<div class="card-body">
			<table class="table table-bordered table-striped">
				  <tbody>
					<tr>
					  <th scope="row" width="20%" style="vertical-align:middle;">ID</th>
					  <td width="80%">
						<input type="text" class="form-control" name="id" size="30" value="" disabled>
					  </td>
					</tr>
					<tr>
					  <th scope="row" width="20%" style="vertical-align:middle;">consumer <font color="red">*</font></th>
					  <td width="80%">
						<select name="consumer_id" class="form-control">
							@foreach($consumers as $consumer)
								@if($consumer->id == $row->consumer_id)
									<option value="{{$consumer->id}}" selected>{{$consumer->name}}({{$consumer->uid}})</option>
								@else
									<option value="{{$consumer->id}}">{{$consumer->name}}({{$consumer->uid}})</option>
								@endif

							@endforeach
					    </select>
						@error('consumer_id') {{ $message }} @enderror
					  </td>
					</tr>
					<tr>
					  <th scope="row" width="20%" style="vertical-align:middle;">package <font color="red">*</font></th>
					  <td width="80%">
						<select name="package_id" class="form-control">
							<option value="{{old('package_id')}}">패키지를 선택해주세요.</option>
							@foreach($packages as $package)
								@if($package->id == $row->package_id)
									<option value="{{$package->id}}" selected>{{$package->name}} ({{$package->departure_date}} ~ {{$package->arrival_date}})</option>
								@else
									<option value="{{$package->id}}">{{$package->name}} ({{$package->departure_date}} ~ {{$package->arrival_date}})</option>
								@endif
							@endforeach
					    </select>
						@error('package_id') {{ $message }} @enderror
					  </td>
					</tr>
					<tr>
					  <th scope="row" width="20%" style="vertical-align:middle;">adult <font color="red">*</font></th>
					  <td width="80%">
						<input type="text" class="form-control" name="adult" size="30" value="{{$row->adult}}" placeholder="여행 가는 어른의 수를 입력해주세요.">
						@error('adult') {{ $message }} @enderror
					  </td>
					</tr>
					<tr>
					  <th scope="row" width="20%" style="vertical-align:middle;">kid <font color="red">*</font></th>
					  <td width="80%">
						<input type="kid" class="form-control" name="kid" size="30" value="{{$row->kid}}" placeholder="여행 가는 어린이의 수를 입력해주세요.">
						@error('kid') {{ $message }} @enderror
					  </td>
					</tr>
					<tr>
					  <th scope="row" width="20%" style="vertical-align:middle;">baby <font color="red">*</font></th>
					  <td width="80%">
						<input type="text" class="form-control" name="baby" size="30" value="{{$row->baby}}" placeholder="여행 가는 유아의 수를 입력해주세요.">
						@error('baby') {{ $message }} @enderror
					  </td>
					</tr>
					<tr>
					  <th scope="row" width="20%" style="vertical-align:middle;">service</th>
					  <td width="80%">
					  <?php $option_name = array("조식추가", "침대사이즈 업", "휴대용 wifi", "항공기 업그레이드", "공항 셔틀버스");
					  	 $option = array("breakfast", "bedsize", "wifi", "airplaneup", "shuttle");
						 $option_row = array("$row->breakfast", "$row->bedsize", "$row->wifi", "$row->airplaneup", "$row->shuttle");
					  ?>
					  	@for($i = 0; $i<sizeof($option); $i++)
							@if($option_row[$i] == "on")
								<input type="checkbox" name="{{$option[$i]}}" checked> {{$option_name[$i]}}</div>
							@else
								<input type="checkbox" name="{{$option[$i]}}"> {{$option_name[$i]}}</div>
							@endif
							@if($i<(sizeof($option)-1)) &nbsp;&nbsp;
							@endif
						@endfor
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
