<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\PackageSchedule;
use App\Models\City;
use App\Models\Package;
use App\Models\Tour;
use App\Models\Hotel;


class AdminPackageScheduleController extends Controller
{
    public function index()
    {
        $data['list'] = PackageSchedule::leftjoin('packages', 'package_schedules.package_id', '=', 'packages.id')
			->leftjoin('cities', 'package_schedules.city_id', '=', 'cities.id')
			->select('package_schedules.*', 'packages.name as package_name', 'cities.name as city_name')->get();
		return view('admin.package.package_schedule.index', $data);
    }

    public function create()
    {
        $data['cities'] = City::get();
		$data['tours'] = Tour::get();
		$data['hotels'] = Hotel::leftjoin('cities as hotel_city', 'hotels.city_id', '=', 'hotel_city.id')->select('hotels.*', 'hotel_city.name as hotel_city_name')->get();
		$data['packages'] = Package::get();
        return view('admin.package.package_schedule.create', $data);
    }

    public function store(Request $request)
    {
		if($request->input('type')=="호텔"){
			$request->validate([
				'package_id'   => 'required',
				'date'   => 'required|numeric',
				'sort'   => 'required|numeric',
				'context'   => 'required',
				'type'   => 'required',
				'city_id'   => 'required',
				'hotel_id'   => 'required',
			 ],
			 [
				'package_id.required'	   => '패키지를 선택 해주세요.',
				'date.required'	   => '몇일차인지 써주세요.',
				'sort.required'	   => '몇번째인지 써주세요.',
				'context.required'	   => '일정을 작성해주세요.',
				'type.required'	   => '타입을 선택 해주세요.',
				'city_id.required'	   => '도시를 선택해주세요.',
				'hotel_id.required'	   => '호텔을 선택해주세요.',
				'date.numeric'	   => '일차는 숫자만 가능합니다.',
				'sort.numeric'	   => '번수는 숫자만 가능합니다.'
			]);
		}
		else{
			$request->validate([
				'package_id'   => 'required',
				'date'   => 'required|numeric',
				'sort'   => 'required|numeric',
				'context'   => 'required',
				'type'   => 'required',
				'city_id'   => 'required',
			 ],
			 [
				'package_id.required'	   => '패키지를 선택 해주세요.',
				'date.required'	   => '몇일차인지 써주세요.',
				'sort.required'	   => '몇번째인지 써주세요.',
				'context.required'	   => '일정을 작성해주세요.',
				'type.required'	   => '타입을 선택 해주세요.',
				'city_id.required'	   => '도시를 선택해주세요.',
				'date.numeric'	   => '일차는 숫자만 가능합니다.',
				'sort.numeric'	   => '번수는 숫자만 가능합니다.'
			]);
		}

		if($request->input('type') != "호텔") $hotel_id=NULL; else $hotel_id = $request->input('hotel_id');
		if($request->input('type') != "관광") $tour_id=NULL; else $tour_id = $request->input('tour_id');

		$row = new PackageSchedule([
			'package_id'	=> $request->input('package_id'),
			'date'   => $request->input('date'),
			'sort'  => $request->input('sort'),
			'context'  => $request->input('context'),
			'type'  => $request->input('type'),
			'tour_id'  => $tour_id,
			'city_id'  => $request->input('city_id'),
			'hotel_id'  => $hotel_id
		]);

		$row->save();

		return redirect(route('a_package_schedule.index'));
    }

    public function show($id)
    {
        $data['row'] = PackageSchedule::leftjoin('packages', 'package_schedules.package_id', '=', 'packages.id')
			->leftjoin('cities', 'package_schedules.city_id', '=', 'cities.id')
			->leftjoin('tours', 'package_schedules.tour_id', '=', 'tours.id')
			->leftjoin('hotels', 'package_schedules.hotel_id', '=', 'hotels.id')
			->select('package_schedules.*', 'packages.name as package_name', 'cities.name as city_name', 'tours.name as tour_name', 'hotels.name as hotel_name')
			->where('package_schedules.id', '=', $id)->first();
		return view('admin.package.package_schedule.show', $data);
    }

    public function edit($id)
    {
		$data['row'] = PackageSchedule::leftjoin('packages', 'package_schedules.package_id', '=', 'packages.id')
			->leftjoin('cities', 'package_schedules.city_id', '=', 'cities.id')
			->leftjoin('tours', 'package_schedules.tour_id', '=', 'tours.id')
			->leftjoin('hotels', 'package_schedules.hotel_id', '=', 'hotels.id')
			->leftjoin('cities as hotel_city', 'hotels.city_id', '=', 'hotel_city.id')
			->select('package_schedules.*', 'packages.name as package_name', 'cities.name as city_name', 'tours.name as tour_name', 'hotels.name as hotel_name', 'hotel_city.name as hotel_city_name')
			->where('package_schedules.id', '=', $id)->first();
        $data['cities'] = City::get();
		$data['tours'] = Tour::get();
		$data['hotels'] = Hotel::leftjoin('cities as hotel_city', 'hotels.city_id', '=', 'hotel_city.id')->select('hotels.*', 'hotel_city.name as hotel_city_name')->get();
		$data['packages'] = Package::get();
        return view('admin.package.package_schedule.edit', $data);
    }

    public function update(Request $request, $id)
    {
		if($request->input('type')=="호텔"){
			$request->validate([
				'package_id'   => 'required',
				'date'   => 'required|numeric',
				'sort'   => 'required|numeric',
				'context'   => 'required',
				'type'   => 'required',
				'city_id'   => 'required',
				'hotel_id'   => 'required',
			 ],
			 [
				'package_id.required'	   => '패키지를 선택 해주세요.',
				'date.required'	   => '몇일차인지 써주세요.',
				'sort.required'	   => '몇번째인지 써주세요.',
				'context.required'	   => '일정을 작성해주세요.',
				'type.required'	   => '타입을 선택 해주세요.',
				'city_id.required'	   => '도시를 선택해주세요.',
				'hotel_id.required'	   => '호텔을 선택해주세요.',
				'date.numeric'	   => '일차는 숫자만 가능합니다.',
				'sort.numeric'	   => '번수는 숫자만 가능합니다.'
			]);
		}
		else{
			$request->validate([
				'package_id'   => 'required',
				'date'   => 'required|numeric',
				'sort'   => 'required|numeric',
				'context'   => 'required',
				'type'   => 'required',
				'city_id'   => 'required',
			 ],
			 [
				'package_id.required'	   => '패키지를 선택 해주세요.',
				'date.required'	   => '몇일차인지 써주세요.',
				'sort.required'	   => '몇번째인지 써주세요.',
				'context.required'	   => '일정을 작성해주세요.',
				'type.required'	   => '타입을 선택 해주세요.',
				'city_id.required'	   => '도시를 선택해주세요.',
				'date.numeric'	   => '일차는 숫자만 가능합니다.',
				'sort.numeric'	   => '번수는 숫자만 가능합니다.'
			]);
		}

		if($request->input('type') != "호텔") $hotel_id=NULL; else $hotel_id = $request->input('hotel_id');
		if($request->input('type') != "관광") $tour_id=NULL; else $tour_id = $request->input('tour_id');

		$row = PackageSchedule::find($id);

		$row->package_id = $request->input('package_id');
		$row->date       = $request->input('date');
		$row->sort       = $request->input('sort');
		$row->context    = $request->input('context');
		$row->type       = $request->input('type');
		$row->tour_id    = $tour_id;
		$row->city_id    = $request->input('city_id');
		$row->hotel_id   = $hotel_id;

		$row->save();

		return redirect(route('a_package_schedule.index'));
    }

    public function destroy($id)
    {
        $row = PackageSchedule::find($id);
		$row->delete();

		return redirect(route('a_package_schedule.index'));
    }
}
