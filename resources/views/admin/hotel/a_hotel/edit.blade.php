@extends('admin/amain')
@section('content')

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
							<form method="post" action="{{route('a_hotel.update', $row->id)}}" enctype="multipart/form-data">
							@method('PATCH')
							@csrf
                        <div class="card-header py-3">
                            <h4 class="m-0 font-weight-bold text-primary"><i class="fas fa-hotel"> Hotel</i>
									<a href='#' class="btn btn-primary float-right" onclick="history.back();"><i class="fas fa-undo"></i></a>
									<span class="float-right">&nbsp;</span>
									<button class="btn btn-primary float-right"><i class="fas fa-check"></i></button>
							</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
								  <tbody>
									<tr>
									  <th scope="row" width="20%" style="vertical-align:middle;">ID <font color="red">*</font></th>
									  <td width="80%">
										<input type="text" class="form-control" name="id" value="{{ $row->id }}" disabled>
									  </td>
									</tr>
									<tr>
									  <th scope="row" width="20%" style="vertical-align:middle;">Name <font color="red">*</font></th>
									  <td width="80%">
										<input type="text" class="form-control" name="name" value="{{ $row->name }}" placeholder="호텔명을 입력해주세요">
										@error('name') {{ $message }} @enderror
									  </td>
									</tr>
									<tr>
									  <th scope="row" width="20%" style="vertical-align:middle;">Nation <font color="red">*</font></th>
									   <td width="80%">
										<select name="nation_id" class="form-control">
											<option value="">국가를 선택해주세요</option>
											@foreach($list1 as $row1)
												@if($row->nation_id == $row1->id)
													<option value="{{$row1->id}}" selected>{{$row1->name}}</option>
												@else
													<option value="{{$row1->id}}">{{$row1->name}}</option>
												@endif
											@endforeach
									   </select>
									   @error('nation_id') {{ $message }} @enderror
									  </td>
									</tr>
									<tr>
									  <th scope="row" width="20%" style="vertical-align:middle;">City <font color="red">*</font></th>
									  <td width="80%">
									  	<select name="city_id" class="form-control">
											<option value="">도시를 선택해주세요</option>
											@foreach($list2 as $row1)
												@if($row->city_id == $row1->id)
													<option value="{{$row1->id}}" selected>{{$row1->name}}</option>
												@else
													<option value="{{$row1->id}}">{{$row1->name}}</option>
												@endif
											@endforeach
									   </select>
									   @error('city_id') {{ $message }} @enderror
									  </td>
									</tr>
									<tr>
									  <th scope="row" width="20%" style="vertical-align:middle;">Address <font color="red">*</font></th>
									  <td width="80%">
										<input type="text" class="form-control" name="address" value="{{ $row->name }}" placeholder="주소을 입력해주세요">
										@error('address') {{ $message }} @enderror
									  </td>
									</tr>
									<tr>
									  <th scope="row" width="20%" style="vertical-align:middle;">Google_map_Address<font color="red">*</font></th>
									  <td width="80%">
										<textarea name="gm_address" style="width:100%; resize:none;" rows="5" placeholder="구글맵 주소을 입력해주세요">{{ $row->gm_address }}
										</textarea>										
										@error('gm_address') {{ $message }} @enderror
									  </td>									 
									</tr>
									<tr>
									  <th scope="row" width="20%" style="vertical-align:middle;">Explain <font color="red">*</font></th>
									  <td width="80%">
									  	<textarea name="explain" style="width:100%; resize:none;" rows="9" placeholder="호텔 소개를 입력해주세요">{{ $row->explain }}
										</textarea>
										@error('explain') {{ $message }} @enderror
									  </td>
									</tr>
									<tr>
									  <th scope="row" width="20%" style="vertical-align:middle;">Picture <font color="red">*</font></th>
									  <td width="80%">
										<div class="form-inline">
											<b>파일이름</b> : {{$row->pic}} <br>
											<input type="file" name="pic" value="" class="form-control form-control-sm">
										</div>
										<br>
										<img src="../../storage/hotel_img/{{ $row->pic }}" width="400px" height="300px">	
									  </td>
									</tr>
									<tr>
									  <th scope="row" width="20%" style="vertical-align:middle;">Star <font color="red">*</font></th>
									  <td width="80%">
										<input type="text" class="form-control" name="star" value="{{ $row->star }}" placeholder="성급을 입력해주세요">
										@error('star') {{ $message }} @enderror
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