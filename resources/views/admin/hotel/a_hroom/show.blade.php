@extends('admin/amain')
@section('content')

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
							<form method="post" action="{{ route('a_hroom.destroy', $row->id) }}">
							@method('DELETE')
							@csrf
                        <div class="card-header py-3">
                            <h4 class="m-0 font-weight-bold text-primary"><i class="fas fa-door-closed"> Hotel-Room Table</i>
									<a href='#' class="btn btn-primary float-right" onclick="history.back();"><i class="fas fa-undo"></i></a>
									<span class="float-right">&nbsp;</span>
									<button  class="btn btn-primary float-right" onClick="return confirm('삭제할까요 ?');"><i class="fas fa-trash-alt"></i></button>
									<span class="float-right">&nbsp;</span>
									<a href="{{ route('a_hroom.edit', $row->id) }}"  class="btn btn-primary float-right"><i class="fas fa-pen"></i></a>
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
									  <th scope="row" width="20%" style="vertical-align:middle;">Hotel-Name</th>
									  <td width="80%">
										<input type="text" class="form-control" name="hotel_name" value="{{ $row->hotel_name }}" disabled>
									  </td>
									</tr>
									<tr>
									  <th scope="row" width="20%" style="vertical-align:middle;">Type</th>
									  <td width="80%">
										<input type="text" class="form-control" name="type" value="{{ $row->type }}" disabled>
									  </td>
									</tr>
									<tr>
									  <th scope="row" width="20%" style="vertical-align:middle;">Bed</th>
									  <td width="80%">
										<input type="text" class="form-control" name="bed" value="{{ $row->bed }}" disabled>
									  </td>
									</tr>
									<tr>
									  <th scope="row" width="20%" style="vertical-align:middle;">Bathroom</th>
									  <td width="80%">
										<input type="text" class="form-control" name="bathroom" value="{{ $row->bathroom }}" disabled>
									  </td>
									</tr>
									<tr>
									  <th scope="row" width="20%" style="vertical-align:middle;">Price($)</th>
									  <td width="80%">
										<input type="text" class="form-control" name="price" value="{{ $row->price }}" disabled>
									  </td>									 
									</tr>
									<tr>
									  <th scope="row" width="20%" style="vertical-align:middle;">Size</th>
									  <td width="80%">
									  	<input type="text" class="form-control" name="size" value="{{ $row->size }}" disabled>
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
								</tbody>
							</table>
                        </div>
							</form>
                    </div>
                </div>
                <!-- /.container-fluid -->
 @stop