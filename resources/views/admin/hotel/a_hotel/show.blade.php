@extends('admin/amain')
@section('content')

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
							<form method="post" action="{{ route('a_hotel.destroy', $row->id) }}">
							@method('DELETE')
							@csrf
                        <div class="card-header py-3">
                            <h4 class="m-0 font-weight-bold text-primary"><i class="fas fa-hotel"> Hotel</i>
									<a href='#' class="btn btn-primary float-right" onclick="history.back();"><i class="fas fa-undo"></i></a>
									<span class="float-right">&nbsp;</span>
									<button  class="btn btn-primary float-right" onClick="return confirm('삭제할까요 ?');"><i class="fas fa-trash-alt"></i></button>
									<span class="float-right">&nbsp;</span>
									<a href="{{ route('a_hotel.edit', $row->id) }}"  class="btn btn-primary float-right"><i class="fas fa-pen"></i></a>
							</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped" width="100%" cellspacing="0">
								  <tbody>
									<tr>
									  <th scope="row" width="20%" style="vertical-align:middle;">ID</th>
									  <td width="80%">
										<input type="text" class="form-control" name="id" value="{{ $row->id }}" disabled>
									  </td>
									</tr>
									<tr>
									  <th scope="row" width="20%" style="vertical-align:middle;">Name</th>
									  <td width="80%">
										<input type="text" class="form-control" name="name" value="{{ $row->name }}" disabled>
									  </td>
									</tr>
									<tr>
									  <th scope="row" width="20%" style="vertical-align:middle;">Nation</th>
									  <td width="80%">
										<input type="text" class="form-control" name="nation" value="{{ $row->nation_name }}" disabled>
									  </td>
									</tr>
									<tr>
									  <th scope="row" width="20%" style="vertical-align:middle;">City</th>
									  <td width="80%">
										<input type="text" class="form-control" name="city" value="{{ $row->city_name }}" disabled>
									  </td>
									</tr>
									<tr>
									  <th scope="row" width="20%" style="vertical-align:middle;">Address</th>
									  <td width="80%">
										<input type="text" class="form-control" name="city" value="{{ $row->address }}" disabled>
									  </td>
									</tr>
									<tr>
									  <th scope="row" width="20%" style="vertical-align:middle;">Google_map_Address</th>
									  <td width="80%">
										<textarea name="gm_address" style="width:100%; resize:none;" rows="5" disabled>{{ $row->gm_address }}
										</textarea>
									  </td>									 
									</tr>
									<tr>
									  <th scope="row" width="20%" style="vertical-align:middle;">Explain</th>
									  <td width="80%">
									  	<textarea name="explain" style="width:100%; resize:none;" rows="9" disabled>{{ $row->explain }}
										</textarea>
									  </td>
									</tr>
									<tr>
									  <th scope="row" width="20%" style="vertical-align:middle;">Picture</th>
									  <td width="80%">
										<div class="form-inline">
											<b>파일이름</b> : {{ $row->pic }} <br>
										</div>
										<img src="../storage/hotel_img/{{ $row->pic }}" width="400px" height="300px">
									  </td>
									</tr>
									<tr>
									  <th scope="row" width="20%" style="vertical-align:middle;">Star</th>
									  <td width="80%">
										<input type="text" class="form-control" name="star" value="{{ $row->star }}" disabled>
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