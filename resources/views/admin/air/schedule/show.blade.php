@extends('admin/amain')
@section('content')

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
							<form method="post" action="{{ route('schedule.destroy', $row->id) }}">
							@method('DELETE')
							@csrf
                        <div class="card-header py-3">
                            <h4 class="m-0 font-weight-bold text-primary"><i class="fas fa-clipboard-list"> Schedule</i>
									<a href='#' class="btn btn-primary float-right" onclick="history.back();"><i class="fas fa-undo"></i></a>
									<span class="float-right">&nbsp;</span>
									<button  class="btn btn-primary float-right" onClick="return confirm('삭제할까요 ?');"><i class="fas fa-trash-alt"></i></button>
									<span class="float-right">&nbsp;</span>
									<a href="{{ route('schedule.edit', $row->id) }}" class="btn btn-primary float-right"><i class="fas fa-pen"></i></a>
								</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
								  <tbody>
									<tr>
									  <th scope="row" width="20%" style="vertical-align:middle;">ID</th>
									  <td width="80%">
										<input type="text" class="form-control" name="id" size="30" value="{{$row->id}}" disabled>
									  </td>
									</tr>
									<tr class="date">
									  <th scope="row" width="20%" style="vertical-align:middle;">Departure </th>
									  <td width="80%">
										<input type="text" class="form-control" name="startDate" size="30" value="{{$row->startDate}}" disabled>
									  </td>
									</tr>
									<tr>
									  <th scope="row" width="20%" style="vertical-align:middle;">Arrival </th>
									  <td width="80%">
										<input type="text" class="form-control" name="endDate" size="30" value="{{$row->endDate}}" disabled>
									  </td>
									</tr>
									<tr>
									  <th scope="row" width="20%" style="vertical-align:middle;">Departure city </th>
									  <td width="80%">
										<input type="text" class="form-control" name="departure_id" size="30" value="{{$row->departure_name}} ({{$row->departure_airport}})" disabled>
									  </td>
									</tr>
									<tr>
									  <th scope="row" width="20%" style="vertical-align:middle;">Arrival city </th>
									  <td width="80%">
										<input type="text" class="form-control" name="destnation_id" size="30" value="{{$row->destnation_name}} ({{$row->destnation_airport}})" disabled>
									  </td>
									</tr>
									<tr>
									  <th scope="row" width="20%" style="vertical-align:middle;">Plane </th>
									  <td width="80%">
										<input type="text" class="form-control" name="air_id" size="30" value="{{$row->planes_number}}" disabled>
									  </td>
									</tr>
									<tr>
									  <th scope="row" width="20%" style="vertical-align:middle;">Price </th>
									  <td width="80%">
										<input type="text" class="form-control" name="price" size="30" value="{{$row->price}}" disabled>
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