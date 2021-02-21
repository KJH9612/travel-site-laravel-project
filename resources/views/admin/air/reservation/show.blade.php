@extends('admin/amain')
@section('content')

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
							<form method="post" action="{{ route('airline.destroy', $row->id) }}">
							@method('DELETE')
							@csrf
                        <div class="card-header py-3">
                            <h4 class="m-0 font-weight-bold text-primary"><i class="fas fa-clipboard-list"> Airline_Reservation</i>
									<a href='#' class="btn btn-primary float-right" onclick="history.back();"><i class="fas fa-undo"></i></a>
									<span class="float-right">&nbsp;</span>
									<button  class="btn btn-primary float-right" onClick="return confirm('삭제할까요 ?');"><i class="fas fa-trash-alt"></i></button>
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
									  <th scope="row" width="20%" style="vertical-align:middle;">consumer</th>
									  <td width="80%">
										<input type="text" class="form-control" name="number" size="30" value="{{ $row->consumers_name }}" disabled>
									  </td>
									</tr>
									<tr>
									  <th scope="row" width="20%" style="vertical-align:middle;">schedule</th>
									  <td width="80%">
										<input type="text" class="form-control" name="number" size="30" 
											value="{{$row->startDate}} ({{$row->departure_name}}) &nbsp -> &nbsp {{$row->endDate}} ({{$row->destnation_name}})" disabled>
									  </td>
									</tr>
									<tr>
									  <th scope="row" width="20%" style="vertical-align:middle;">adult</th>
									  <td width="80%">
										<input type="text" class="form-control" name="number" size="30" value="{{ $row->adult }}" disabled>
									  </td>
									</tr>
									<tr>
									  <th scope="row" width="20%" style="vertical-align:middle;">child</th>
									  <td width="80%">
										<input type="text" class="form-control" name="number" size="30" value="{{ $row->child }}" disabled>
									  </td>
									</tr>
									<tr>
									  <th scope="row" width="20%" style="vertical-align:middle;">infant</th>
									  <td width="80%">
										<input type="text" class="form-control" name="number" size="30" value="{{ $row->infant }}" disabled>
									  </td>
									</tr>
									<tr>
									  <th scope="row" width="20%" style="vertical-align:middle;">baggage</th>
									  <td width="80%">
										<input type="text" class="form-control" name="number" size="30" value="{{ $row->baggage }}" disabled>
									  </td>
									</tr>
									<tr>
									  <th scope="row" width="20%" style="vertical-align:middle;">price</th>
									  <td width="80%">
										<input type="text" class="form-control" name="number" size="30" value="{{ number_format($row->total) }}" disabled>
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