@extends('admin/amain')
@section('content')
				<script>
					$( function() {
						$('#startDate').datetimepicker();
						$('#endDate').datetimepicker();
					});

				</script>
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
							<form method="post" action="{{route('schedule.update', $row->id)}}">
							@method('PATCH')
							@csrf
                        <div class="card-header py-3">
                            <h4 class="m-0 font-weight-bold text-primary"><i class="fas fa-clipboard-list"> Schedule</i>
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
										<input type="text" class="form-control" name="id" size="30" value="{{ $row->id }}" disabled>
									  </td>
									</tr>
									<tr class="date">
									  <th scope="row" width="20%" style="vertical-align:middle;">Departure <font color="red">*</font></th>
									  <td width="80%">
										<?php
											$s = strtotime($row->startDate);
											$e = strtotime($row->endDate);
											$startDate = date('m/d/Y H:i', $s);
											$endDate = date('m/d/Y H:i', $e);
										?>
										<div class="input-group date" id="startDate" data-target-input="nearest">
											<input type="text" name="startDate" class="form-control datetimepicker-input" data-target="#startDate" value="{{ $startDate }}" placeholder="출발일을 선택해주세요">
											<div class="input-group-append" data-target="#startDate" data-toggle="datetimepicker">
												<div class="input-group-text"><i class="fa fa-calendar"></i></div>
											</div>
										</div>

										@error('startDate') {{ $message }} @enderror
									  </td>
									</tr>
									<tr>
									  <th scope="row" width="20%" style="vertical-align:middle;">Arrival <font color="red">*</font></th>
									  <td width="80%">
										<div class="input-group date" id="endDate" data-target-input="nearest">
											<input type="text" name="endDate" class="form-control datetimepicker-input" data-target="#endDate" value="{{ $endDate }}" placeholder="도착일을 선택해주세요">
											<div class="input-group-append" data-target="#endDate" data-toggle="datetimepicker">
												<div class="input-group-text"><i class="fa fa-calendar"></i></div>
											</div>
										</div>
										@error('endDate') {{ $message }} @enderror
									  </td>
									</tr>
									<tr>
									  <th scope="row" width="20%" style="vertical-align:middle;">Departure city <font color="red">*</font></th>
									  <td width="80%">
										<select name="departure_id" class="form-control">
											<option value="">도시를 선택해주세요</option>
											@foreach($list as $row1)
												@if($row->departure_id == $row1->id)
													<option value="{{$row1->id}}" selected>{{$row1->cities_name}} ({{$row1->name}})</option>
												@else
													<option value="{{$row1->id}}">{{$row1->cities_name}} ({{$row1->name}})</option>
												@endif
											@endforeach
									   </select>
									   @error('departure_id') {{ $message }} @enderror
									  </td>
									</tr>
									<tr>
									  <th scope="row" width="20%" style="vertical-align:middle;">Arrival city <font color="red">*</font></th>
									  <td width="80%">
										<select name="destnation_id" class="form-control">
											<option value="">도시를 선택해주세요</option>
											@foreach($list as $row1)
												@if($row->destnation_id == $row1->id)
													<option value="{{$row1->id}}" selected>{{$row1->cities_name}} ({{$row1->name}})</option>
												@else
													<option value="{{$row1->id}}">{{$row1->cities_name}} ({{$row1->name}})</option>
												@endif
											@endforeach
									   </select>
									   @error('destnation_id') {{ $message }} @enderror
									  </td>
									</tr>
									<tr>
									  <th scope="row" width="20%" style="vertical-align:middle;">Plane <font color="red">*</font></th>
									  <td width="80%">
										<select name="air_id" class="form-control">
											<option value="">항공기를 선택해주세요</option>
											@foreach($plist as $row1)
												@if($row->air_id == $row1->id)
													<option value="{{$row1->id}}" selected>{{$row1->number}}</option>
												@else
													<option value="{{$row1->id}}">{{$row1->number}}</option>
												@endif
											@endforeach
									   </select>
									   @error('air_id') {{ $message }} @enderror
									  </td>
									</tr>
									<tr>
									  <th scope="row" width="20%" style="vertical-align:middle;">Price <font color="red">*</font></th>
									  <td width="80%">
										<input type="text" class="form-control" name="price" size="30" value="{{ $row->price }}" placeholder="가격을 입력해주세요">
										@error('price') {{ $message }} @enderror
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
