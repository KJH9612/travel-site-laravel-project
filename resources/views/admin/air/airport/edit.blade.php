@extends('admin/amain')
@section('content')

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
							<form method="post" action="{{route('airport.update', $row->id)}}">
							@method('PATCH')
							@csrf
                        <div class="card-header py-3">
                            <h4 class="m-0 font-weight-bold text-primary"><i class="fas fa-plane-departure"> Airport</i>
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
									<tr>
									  <th scope="row" width="20%" style="vertical-align:middle;">City <font color="red">*</font></th>
									  <td width="80%">
										<select name="cities_id" class="form-control">
											<option value="">도시를 선택해주세요</option>
											@foreach($list as $row1)
												@if($row->cities_id == $row1->id)
													<option value="{{$row1->id}}" selected>{{$row1->name}}</option>
												@else
													<option value="{{$row1->id}}">{{$row1->name}}</option>
												@endif
											@endforeach
									   </select>
									   @error('cities_id') {{ $message }} @enderror
									  </td>
									</tr>
									<tr>
									  <th scope="row" width="20%" style="vertical-align:middle;">Name <font color="red">*</font></th>
									  <td width="80%">
										<input type="text" class="form-control" name="name" size="30" value="{{ $row->name }}" placeholder="이름을 입력해주세요">
										@error('name') {{ $message }} @enderror
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