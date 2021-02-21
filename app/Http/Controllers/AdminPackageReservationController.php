<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Package;
use App\Models\Consumer;
use App\Models\PackageReservation;

class AdminPackageReservationController extends Controller
{
    public function index()
    {
        $data['list'] = PackageReservation::leftjoin('consumers', 'package_reservations.consumer_id', '=', 'consumers.id')
			->leftjoin('packages', 'package_reservations.package_id', '=', 'packages.id')
			->select('package_reservations.*', 'consumers.uid as consumer_uid', 'consumers.name as consumer_name', 'packages.name as package_name')->get();

		return view('admin.package.reservation.index', $data);
    }
    public function create()
    {
        $data['consumers'] = Consumer::get();
		$data['packages'] = Package::get();

		return view('admin.package.reservation.create', $data);
    }
    public function store(Request $request)
    {
		$request->validate([
			'consumer_id'   => 'required',
			'package_id'   => 'required',
			'adult'   => 'required|numeric',
			'kid'   => 'required|numeric',
			'baby'   => 'required|numeric',
		 ],
		 [
			'consumer_id.required'	   => '예약자를 선택해주세요.',
			'package_id.required'	   => '패키지를 선택해주세요.',
			'adult.required'	   => '어른의 수를 입력해주세요.',
			'kid.required'	   => '어린이의 수를 입력해주세요.',
			'baby.required'	   => '유아의 수를 입력해주세요.',
			'adult.numeric'	   => '숫자만 입력가능합니다.',
			'kid.numeric'	   => '숫자만 입력가능합니다.',
			'baby.numeric'	   => '숫자만 입력가능합니다.'
		]);
		$package = Package::find($request->input('package_id'));

		$package_total = $package->adult_price * $request->input('adult') + $package->kid_price * $request->input('kid') + $package->baby_price * $request->input('baby');
		
		$service_total = 0;
		if($request->input('breakfast'))$service_total = $service_total + 50000;
		if($request->input('bedsize')) $service_total = $service_total + 70000;
		if($request->input('wifi')) $service_total = $service_total + 90000;
		if($request->input('airplaneup')) $service_total = $service_total + 350000;
		if($request->input('shuttle')) $service_total = $service_total + 70000;
		
		$total = $package_total + $service_total;

		$row = new PackageReservation([
			'adult' => $request->input('adult'),
			'kid' => $request->input('kid'),
			'baby' => $request->input('baby'),
			'package_id' => $request->input('package_id'),
			'consumer_id' => $request->input('consumer_id'),
			'package_total' => $package_total,
			'service_total' => $service_total,
			'total' => $total,
			'breakfast' => $request->input('breakfast')? $request->input('breakfast') : "off",
			'bedsize' => $request->input('bedsize')? $request->input('bedsize') : "off",
			'wifi' => $request->input('wifi')? $request->input('wifi') : "off",
			'airplaneup' => $request->input('airplaneup')? $request->input('airplaneup') : "off",
			'shuttle' => $request->input('shuttle')? $request->input('shuttle') : "off"
		]);
		$row->save();

		return redirect(route('a_package_reservation.index'));
    }

    public function show($id)
    {
        $data['row'] = PackageReservation::leftjoin('consumers', 'package_reservations.consumer_id', '=', 'consumers.id')
			->leftjoin('packages', 'package_reservations.package_id', '=', 'packages.id')
			->select('package_reservations.*', 'consumers.uid as consumer_uid', 'consumers.name as consumer_name', 'packages.name as package_name', 'packages.departure_date as package_departure_date', 'packages.arrival_date as package_arrival_date')->where('package_reservations.id', '=', $id)->first();

		return view('admin.package.reservation.show', $data);
    }

    public function edit($id)
    {
        $data['consumers'] = Consumer::get();
		$data['packages'] = Package::get();
		$data['row'] = PackageReservation::leftjoin('consumers', 'package_reservations.consumer_id', '=', 'consumers.id')
			->leftjoin('packages', 'package_reservations.package_id', '=', 'packages.id')
			->select('package_reservations.*', 'consumers.id as consumer_id', 'consumers.uid as consumer_uid', 'consumers.name as consumer_name', 'packages.id as package_id', 'packages.name as package_name', 'packages.departure_date as package_departure_date', 'packages.arrival_date as package_arrival_date')->where('package_reservations.id', '=', $id)->first();

		return view('admin.package.reservation.edit', $data);
    }

    public function update(Request $request, $id)
    {
		$request->validate([
			'consumer_id'   => 'required',
			'package_id'   => 'required',
			'adult'   => 'required|numeric',
			'kid'   => 'required|numeric',
			'baby'   => 'required|numeric',
		 ],
		 [
			'consumer_id.required'	   => '예약자를 선택해주세요.',
			'package_id.required'	   => '패키지를 선택해주세요.',
			'adult.required'	   => '어른의 수를 입력해주세요.',
			'kid.required'	   => '어린이의 수를 입력해주세요.',
			'baby.required'	   => '유아의 수를 입력해주세요.',
			'adult.numeric'	   => '숫자만 입력가능합니다.',
			'kid.numeric'	   => '숫자만 입력가능합니다.',
			'baby.numeric'	   => '숫자만 입력가능합니다.'
		]);
		$package = Package::find($request->input('package_id'));

		$package_total = $package->adult_price * $request->input('adult') + $package->kid_price * $request->input('kid') + $package->baby_price * $request->input('baby');
		
		$service_total = 0;
		if($request->input('breakfast'))$service_total = $service_total + 50000;
		if($request->input('bedsize')) $service_total = $service_total + 70000;
		if($request->input('wifi')) $service_total = $service_total + 90000;
		if($request->input('airplaneup')) $service_total = $service_total + 350000;
		if($request->input('shuttle')) $service_total = $service_total + 70000;
		
		$total = $package_total + $service_total;

		$row = PackageReservation::find($id);

		$row->adult = $request->input('adult');
		$row->kid = $request->input('kid');
		$row->baby = $request->input('baby');
		$row->package_id = $request->input('package_id');
		$row->consumer_id = $request->input('consumer_id');
		$row->package_total = $package_total;
		$row->service_total = $service_total;
		$row->total = $total;
		$row->breakfast = $request->input('breakfast')? $request->input('breakfast') : "off";
		$row->bedsize = $request->input('bedsize')? $request->input('bedsize') : "off";
		$row->wifi = $request->input('wifi')? $request->input('wifi') : "off";
		$row->airplaneup = $request->input('airplaneup')? $request->input('airplaneup') : "off";
		$row->shuttle = $request->input('shuttle')? $request->input('shuttle') : "off";

		$row->save();

		return redirect(route('a_package_reservation.index'));
    }

    public function destroy($id)
    {
        $row = PackageReservation::find($id);
		$row->delete();

		return redirect(route('a_package_reservation.index'));
    }
}
