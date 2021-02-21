@extends('admin/amain')
@section('content')

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800"><i class="fas fa-fw fa-table"></i>  Tables</h1>
                    <p class="mb-4"></p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h4 class="m-0 font-weight-bold text-primary"><i class="fas fa-clipboard-list"> ScheduleTable</i>
									<a href="{{ route('schedule.create') }}" class="btn btn-primary" style="float: right;"><i class="fas fa-plus-square"></i></a>
								</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
												  <th>편명</th>
                                            <th>시간</th>
												  <th>출발지</th>
												  <th>도착지</th>
												  <th>가격</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
												  <th>편명</th>
                                            <th>시간</th>
												  <th>출발지</th>
												  <th>도착지</th>
												  <th>가격</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
											@foreach($list as $row)
                                        <tr>
                                            <td><a href="{{route('schedule.show', $row->id)}}">{{$row->id}}</a></td>
                                            <td>{{$row->planes_number}}</td>
											      <td>{{$row->startDate}} &nbsp; - &nbsp; {{$row->endDate}}</td>
												  <td>{{$row->departure_name}} ({{$row->departure_airport}})</td>
												  <td>{{$row->destnation_name}} ({{$row->destnation_airport}})</td>
												  <td>{{number_format($row->price)}}</td>
                                        </tr>
											@endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

 @stop