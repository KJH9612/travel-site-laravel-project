@extends('admin/amain')
@section('content')

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
							<form method="post" action="{{route('a_hroom.update', $row->id)}}" enctype="multipart/form-data">
							@method('PATCH')
							@csrf
                        <div class="card-header py-3">
                            <h4 class="m-0 font-weight-bold text-primary"><i class="fas fa-door-closed"> Hotel-Room Table</i>
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
										<input type="text" class="form-control" name="id" value="{{ $row->id }}" disabled>
									  </td>
									</tr>
									<tr>
									  <th scope="row" width="20%" style="vertical-align:middle;">Hotel-name <font color="red">*</font></th>
									  <td width="80%">
										<select name="hotel_id" class="form-control">
											<option value="">호텔명을 선택해주세요</option>
											@foreach($list as $row1)
												@if($row->hotel_id == $row1->id)
													<option value="{{$row1->id}}" selected>{{$row1->name}}</option>
												@else
													<option value="{{$row1->id}}">{{$row1->name}}</option>
												@endif
											@endforeach
									   </select>
										@error('hotel_id') {{ $message }} @enderror
									  </td>
									</tr>
									<tr>
									  <th scope="row" width="20%" style="vertical-align:middle;">Type <font color="red">*</font></th>
									   <td width="80%">
										<input type="text" class="form-control" name="type" value="{{ $row->type }}" placeholder="방 종류를 입력해주세요">	
										@error('type') {{ $message }} @enderror
									  </td>
									</tr>									
									<tr>
									  <th scope="row" width="20%" style="vertical-align:middle;">Bed <font color="red">*</font></th>
									  <td width="80%">
										<input type="text" class="form-control" name="bed" value="{{ $row->bed }}" placeholder="침대 수를 입력해주세요">
										@error('bed') {{ $message }} @enderror
									  </td>
									</tr>
									<tr>
									  <th scope="row" width="20%" style="vertical-align:middle;">Bathroom <font color="red">*</font></th>
									  <td width="80%">
										<input type="text" class="form-control" name="bathroom" value="{{ $row->bathroom }}" placeholder="화장실 수를 입력해주세요">
										@error('bathroom') {{ $message }} @enderror
									  </td>									 
									</tr>
									<tr>
									  <th scope="row" width="20%" style="vertical-align:middle;">Price <font color="red">*</font></th>
									  <td width="80%">
									  	<input type="text" class="form-control" name="price" value="{{ $row->price }}" placeholder="가격을 입력해주세요">
										@error('price') {{ $message }} @enderror
									  </td>
									</tr>
									<tr>
									  <th scope="row" width="20%" style="vertical-align:middle;">Size <font color="red">*</font></th>
									  <td width="80%">
									  	<input type="text" class="form-control" name="size" value="{{ $row->size }}" placeholder="평수를 입력해주세요">
										@error('size') {{ $message }} @enderror
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
								  </tbody>
								</table>
                        </div>
							</form>
                    </div>

                </div>
                <!-- /.container-fluid -->

 @stop