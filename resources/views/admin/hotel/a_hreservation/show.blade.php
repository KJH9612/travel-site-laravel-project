@extends('admin/amain')
@section('content')

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
							<form method="post" action="{{ route('a_hreservation.destroy', $row->id) }}">
							@method('DELETE')
							@csrf
                        <div class="card-header py-3">
                            <h4 class="m-0 font-weight-bold text-primary"><i class="fas fa-clipboard-list"> Hotel-Reservation</i>
									<a href='#' class="btn btn-primary float-right" onclick="history.back();"><i class="fas fa-undo"></i></a>
									<span class="float-right">&nbsp;</span>
									<button  class="btn btn-primary float-right" onClick="return confirm('삭제할까요 ?');"><i class="fas fa-trash-alt"></i></button>
									<span class="float-right">&nbsp;</span>
									<a href="{{ route('a_hreservation.edit', $row->id) }}"  class="btn btn-primary float-right"><i class="fas fa-pen"></i></a>
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
										<input type="text" class="form-control" name="name" value="{{ $row->consumer_name }}" disabled>
									  </td>
									</tr>
									<tr>
									  <th scope="row" width="20%" style="vertical-align:middle;">Check_in</th>
									  <td width="80%">
										<input type="text" class="form-control" name="check_in" value="{{ $row->check_in }}" disabled>
									  </td>
									</tr>
									<tr>
									  <th scope="row" width="20%" style="vertical-align:middle;">Check_out</th>
									  <td width="80%">
										<input type="text" class="form-control" name="check_out" value="{{ $row->check_out }}" disabled>
									  </td>
									</tr>
									<tr>
									  <th scope="row" width="20%" style="vertical-align:middle;">Adult</th>
									  <td width="80%">
										<input type="text" class="form-control" name="adult" value="{{ $row->adult }}" disabled>
									  </td>
									</tr>
									<tr>
									  <th scope="row" width="20%" style="vertical-align:middle;">Child</th>
									  <td width="80%">
										<input type="text" class="form-control" name="child" value="{{ $row->child }}" disabled>
									  </td>									 
									</tr>
									<tr>
									  <th scope="row" width="20%" style="vertical-align:middle;">Hotel</th>
									  <td width="80%">
										<input type="text" class="form-control" name="hotel" value="{{ $row->hotel }}" disabled>
									  </td>									 
									</tr>
									<tr>
									  <th scope="row" width="20%" style="vertical-align:middle;">Type</th>
									  <td width="80%">
										<input type="text" class="form-control" name="type" value="{{ $row->type }}" disabled>
									  </td>									 
									</tr>									
									<tr>
									  <th scope="row" width="20%" style="vertical-align:middle;">Price</th>
									  <td width="80%">
										<input type="text" class="form-control" name="price" value="{{number_format($row->price)}}원" disabled>
									  </td>									 
									</tr>
									<tr>
									  <th scope="row" width="20%" style="vertical-align:middle;">Breakfast</th>
									  <td width="80%">
										<input type="text" class="form-control" name="breakfast" value="{{ $row->breakfast }}" disabled>
									  </td>									 
									</tr>
									<tr>
									  <th scope="row" width="20%" style="vertical-align:middle;">Bedsize</th>
									  <td width="80%">
										<input type="text" class="form-control" name="bedsize" value="{{ $row->bedsize }}" disabled>
									  </td>									 
									</tr>
									<tr>
									  <th scope="row" width="20%" style="vertical-align:middle;">WIFIegg</th>
									  <td width="80%">
										<input type="text" class="form-control" name="wifiegg" value="{{ $row->wifiegg }}" disabled>
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