@extends('admin/amain')
@section('content')

		<style>
		$blue: #269bff;
		$bg-light: #f2f2f2;
		$bg-med: #eee;

		div.checkbox.switcher, div.radio.switcher {
		  label {padding: 0;
			* {vertical-align: middle;}
			input {display: none;
			  &+span {position: relative; display: inline-block; margin-right: 10px; width: 56px; height: 28px; background: $bg-light; border: 1px solid $bg-med; border-radius: 50px; transition: all 0.3s ease-in-out;
				small {position: absolute; display: block; width: 50%; height: 100%; background: #fff; border-radius: 50%; transition: all 0.3s ease-in-out; left: 0;}
			  }
			  &:checked+span {background: $blue; border-color: $blue;
				small {left: 50%;}
			  }
			}
		  }
		}

		// the basic
		body {color: #757575; font-family: 'Lato', sans-serif; font-size: 16px;
		  div.container {padding: 5% 0}
		}
		</style>

		<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap-switch-button@1.1.0/dist/bootstrap-switch-button.min.js"></script>
		<link href="/h_css/switch-button.min.css" rel="stylesheet">
		<link rel="stylesheet" href="/h_css/bootstrap-datepicker.css">
		<link rel="stylesheet" href="/h_css/jquery.timepicker.css">				

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
						<form method="post" action="{{route('a_hreservation.store')}}">
							@csrf
                        <div class="card-header py-3">
                            <h4 class="m-0 font-weight-bold text-primary"><i class="fas fa-clipboard-list"> Hotel-Reservation</i>
									<a href='#' class="btn btn-primary float-right" onclick="history.back();"><i class="fas fa-undo"></i></a>
									<span class="float-right">&nbsp;</span>
									<button class="btn btn-primary float-right"><i class="fas fa-check"></i></button>
							</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
								  <tbody>
									<tr>
									  <th scope="row" width="20%" style="vertical-align:middle;">Name</th>
									  <td width="80%">
										<select name="consumer_id" class="form-control">
											<option value="" selected>예약자를 선택해주세요</option>			
											@foreach($list as $row)
												<option value="{{$row->id}}">{{$row->name}}({{$row->uid}})</option>		
											@endforeach											
									    </select>
										@error('consumer_id') {{ $message }} @enderror
									  </td>
									</tr>
									<tr>
									  <th scope="row" width="20%" style="vertical-align:middle;">Check_in</th>
									  <td width="80%">
									  	<input type="text" name="check_in" id="check_in" class="form-control checkin_date" placeholder="입실일을 선택해주세요." onchange='fn_check()'>
										@error('check_in') {{ $message }} @enderror
									  </td>
									</tr>
									<tr>
									  <th scope="row" width="20%" style="vertical-align:middle;">Check_out</th>
									  <td width="80%">
										<input type="text" name="check_out" id="check_out" class="form-control checkin_date" placeholder="퇴실일을 선택해주세요." onchange='fn_check()'>
										@error('check_out') {{ $message }} @enderror
									  </td>
									</tr>
									<tr>
									  <th scope="row" width="20%" style="vertical-align:middle;">Adult</th>
									  <td width="80%">
										<input type="text" class="form-control" name="adult" id="adult" placeholder="인원수를 입력해주세요." onkeyup='fn_check()'>
										@error('adult') {{ $message }} @enderror
									  </td>
									</tr>
									<tr>
									  <th scope="row" width="20%" style="vertical-align:middle;">Child</th>
									  <td width="80%">
										<input type="text" class="form-control" name="child" id="child" placeholder="인원수를 입력해주세요." onkeyup='fn_check()'>
										@error('child') {{ $message }} @enderror
									  </td>									 
									</tr>
									<tr>
									  <th scope="row" width="20%" style="vertical-align:middle;">Hotel</th>
									  <td width="80%">
										<select name="hotel_id" id="hotel_id" class="form-control" onchange='fn_check()'>
											<option value="" selected>호텔을 선택해주세요</option>
											@foreach($list1 as $row)						
												<option value="{{$row->id}}">{{$row->name}}</option>			
											@endforeach											
									   </select>
									   @error('hotel_id') {{ $message }} @enderror
									  </td>									 
									</tr>
									<tr>
									  <th scope="row" width="20%" style="vertical-align:middle;">Type</th>
									  <td width="80%">
									  	<select name="hroom_id" id="type" class="form-control" onchange='fn_check()'>
											<option value="" selected>객실을 선택해주세요</option>			
											@foreach($list2 as $row)
												<option value="{{$row->id}}">{{$row->type}}({{$row->hotel}})</option>		
											@endforeach											
									   </select>
									   @error('hroom_id') {{ $message }} @enderror
									   @foreach($list2 as $row)
												<input type="text" class="form-control" name="rprice{{$row->id}}" id="rprice{{$row->id}}" value="{{ $row->price }}" style="display:none;">
										@endforeach
									  </td>									 
									</tr>									
									<tr>
									  <th scope="row" width="20%" style="vertical-align:middle;">Price</th>
									  <td width="80%">
										<input type="text" class="form-control" name="price" id="price" value="0원" readonly>
										<input type="text" class="form-control" name="realprice" id="realprice" value="0" style="display:none;">
									  </td>									 
									</tr>
									<tr>
									  <th scope="row" width="20%" style="vertical-align:middle;">Service</th>
									  <td width="80%">
										<div class="row">				
											<div class="col-2" style="display: flex; align-items: center; justify-content: left;">
												<div class="form-field" style="display: flex; align-items: center; justify-content: left;">
												  <div class="icon"><span class="fas fa-concierge-bell">&nbsp;조식 추가</span></div>
												</div>
											</div>
											<div class="col-1" style="display: flex; align-items: center; justify-content: left;">
												<div class="form-field" >
													<input type="checkbox" name="breakfast" id="breakfast" data-toggle="switchbutton" data-onstyle="primary" data-offstyle="outline-light" onchange="javascript:check1();">
												</div>
											</div>	

											<div class="col-1"></div>
											<div class="col-2" style="display: flex; align-items: center; justify-content: left;">
												<div class="form-field" style="display: flex; align-items: center; justify-content: left;">
												  <div class="icon"><span class="fas fa-bed">&nbsp;침대 사이즈</span></div>
												</div>
											</div>
											<div class="col-1" style="display: flex; align-items: center; justify-content: start;">
												<div class="form-field" >
													<input type="checkbox" name="bedsize" id="bedsize" data-toggle="switchbutton" data-onstyle="primary" data-offstyle="outline-light" onchange="javascript:check2();">
												</div>
											</div>	

											<div class="col-1"></div>
											<div class="col-2" style="display: flex; align-items: center; justify-content: left;">
												<div class="form-field" style="display: flex; align-items: center; justify-content: left;">
												  <div class="icon"><span class="fas fa-wifi">&nbsp;휴대용 WIFI</span></div>
												</div>
											</div>
											<div class="col-1" style="display: flex; align-items: center; justify-content: start;">
												<div class="form-field" >
													<input type="checkbox" name="wifiegg" id="wifiegg" data-toggle="switchbutton" data-onstyle="primary" data-offstyle="outline-light" onchange="javascript:check3();">
												</div>
											</div>	
										</div>
									  </td>									 
									</tr>
								</tbody>
								</table>
                        </div>
						</form>
                    </div>

                </div>
                <!-- /.container-fluid -->

<script>
	var total = 0;

	function check1(){
		var chkbox = document.getElementById('breakfast');
		var total = document.getElementById('realprice').value;
		if(chkbox.checked) 
			total = parseInt(total) + 50000;		
		else 
			total = parseInt(total) - 50000;
		
		var real = total;
		total = comma(total);

		document.getElementById("price").value = total + '원';
		document.getElementById("realprice").value = real;
	}

	function check2(){
		var chkbox = document.getElementById('bedsize');
		var total = document.getElementById('realprice').value;
		if(chkbox.checked) 
			total = parseInt(total) + 70000;
		else
			total = parseInt(total) - 70000;

		var real = total;
		total = comma(total);

		document.getElementById("price").value = total + '원';
		document.getElementById("realprice").value = real;
	}


	function check3(){
		var chkbox = document.getElementById('wifiegg');
		var total = document.getElementById('realprice').value;
		if(chkbox.checked) 
			total = parseInt(total) + 90000;
		else
			total = parseInt(total) - 90000;

		var real = total;
		total = comma(total);

		document.getElementById("price").value = total + '원';
		document.getElementById("realprice").value = real;
	}


	function fn_check(){
		var type = document.getElementById('type').value;
		type = 'rprice'.concat(type);
		var rprice = document.getElementById(type).value;
		var anum = document.getElementById('adult').value;
		var cnum = document.getElementById('child').value;
		

		var chkin = document.getElementById('check_in').value;
		var chkout = document.getElementById('check_out').value;
		var arr1 = chkin.split('-');		
		var arr2 = chkout.split('-');
		var date1 = new Date(arr1[0],arr1[1],arr1[2]);
		var date2 = new Date(arr2[0],arr2[1],arr2[2]);

		var elapsedMSec = date2.getTime() - date1.getTime(); // 172800000
		var elapsedDay = elapsedMSec / 1000 / 60 / 60 / 24; // 2
		
		if(isNaN(elapsedDay)==false)
			total = rprice * 1 * anum * elapsedDay + rprice * 1 / 2 * cnum * elapsedDay;
		
		var chkbox = document.getElementById('breakfast');
		if(chkbox.checked) 
			total = parseInt(total) + 50000;

		chkbox = document.getElementById('bedsize');
		if(chkbox.checked) 
			total = parseInt(total) + 70000;

		chkbox = document.getElementById('wifiegg');
		if(chkbox.checked) 
			total = parseInt(total) + 90000;
		

		var real = comma(total);

		document.getElementById("price").value = real + '원';
		document.getElementById("realprice").value = total;
	}


	function comma(num){
		var len, point, str; 
		   
		num = num + ""; 
		point = num.length % 3 ;
		len = num.length; 
	   
		str = num.substring(0, point); 
		while (point < len) { 
			if (str != "") str += ","; 
			str += num.substring(point, point + 3); 
			point += 3; 
		} 
		 
		return str; 
	}
</script>

<script src="/h_js/jquery.min.js"></script>
<script src="/h_js/jquery-migrate-3.0.1.min.js"></script>
<script src="/h_js/popper.min.js"></script>
<script src="/h_js/bootstrap.min.js"></script>
<script src="/h_js/jquery.easing.1.3.js"></script>
<script src="/h_js/jquery.waypoints.min.js"></script>
<script src="/h_js/jquery.stellar.min.js"></script>
<script src="/h_js/owl.carousel.min.js"></script>
<script src="/h_js/jquery.magnific-popup.min.js"></script>
<script src="/h_js/jquery.animateNumber.min.js"></script>
<script src="/h_js/bootstrap-datepicker.js"></script>
<script src="/h_js/bootstrap-datepicker.ko.js"></script>
<script src="/h_js/scrollax.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
<script src="/h_js/google-map.js"></script>
<script src="/h_js/main.js"></script>


 @stop