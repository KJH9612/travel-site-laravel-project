@extends('admin/amain')
@section('content')

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
							<form method="post" action="{{ route('plane.destroy', $row->id) }}">
							@method('DELETE')
							@csrf
                        <div class="card-header py-3">
                            <h4 class="m-0 font-weight-bold text-primary"><i class="fas fa-plane"> Plane</i> 
									<a href='#' class="btn btn-primary float-right" onclick="history.back();"><i class="fas fa-undo"></i></a>
									<span class="float-right">&nbsp;</span>
									<button  class="btn btn-primary float-right" onClick="return confirm('삭제할까요 ?');"><i class="fas fa-trash-alt"></i></button>
									<span class="float-right">&nbsp;</span>
									<a href="{{ route('plane.edit', $row->id) }}" class="btn btn-primary float-right"><i class="fas fa-pen"></i></a>
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
									  <th scope="row" width="20%" style="vertical-align:middle;">Number</th>
									  <td width="80%">
										<input type="text" class="form-control" name="number" value="{{ $row->number }}" disabled>
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