<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Package;
use App\Models\Nation;
use App\Models\Schedule;


class AdminPackageController extends Controller
{
    public function index()
    {
        $data['list'] = Package::leftjoin('nations', 'packages.nation_id', '=', 'nations.id')->select('packages.*', 'nations.name as nation_name')->get();
        return view('admin.package.package.index', $data);
    }

    public function create()
    {
        $data['nations'] = Nation::get();
		$data['schedules'] = Schedule::leftjoin('airports as departure_airport', 'schedules.departure_id', '=', 'departure_airport.id')
			->leftjoin('airports as destnation_airport', 'schedules.destnation_id', '=', 'destnation_airport.id')
			->leftjoin('cities as departure_city', 'departure_airport.cities_id', '=', 'departure_city.id')
			->leftjoin('cities as destnation_city', 'destnation_airport.cities_id', '=', 'destnation_city.id')
			->select('schedules.*', 'destnation_airport.name as destnation_airport_name', 'departure_airport.name as departure_airport_name', 'departure_city.name as departure_city_name', 'destnation_city.name as destnation_city_name')
			->orderby('schedules.startDate', 'asc')->get();

		return view('admin.package.package.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
			'nation_id'               => 'required',
			'name'                    => 'required',
			'explain'                 => 'required',
			'adult_price'             => 'required|numeric',
			'kid_price'               => 'required|numeric',
			'baby_price'              => 'required|numeric',
			'departure_date'          => 'required',
			'arrival_date'            => 'required',
			'pic'                     => 'required',
			'star'              => 'required|numeric'
		 ],
		 [
			'nation_id.required'	   => '국가를 선택해주세요.',
			'name.required'	           => '패키지 이름을 입력해주세요.',
			'explain.required'	       => '설명을 작성해주세요.',
			'adult_price.required'	   => '어른 패키지 가격을 입력해주세요.',
			'kid_price.required'	   => '어린이 패키지 가격을 입력해주세요.',
			'baby_price.required'	   => '유아 패키지 가격을 입력해주세요.',
			'departure_date.required'  => '패키지 시작 날짜를 올려주세요.',
			'arrival_date.required'	   => '패키지 종료 날짜를 올려주세요.',
			'pic.required'	           => '사진을 올려주세요.',
			'adult_price.numeric'	   => '숫자로만 입력해주세요.',
			'kid_price.numeric'	   => '숫자로만 입력해주세요.',
			'baby_price.numeric'	   => '숫자로만 입력해주세요.',
			'star.required'	           => '평점을 입력해주세요.',
			'star.numeric'	   => '숫자로만 입력해주세요.'
		]);

		$departure_tmp = explode("/", $request->input('departure_date'));
		$departure_date = $departure_tmp[2] ."-" .$departure_tmp[0] ."-" .$departure_tmp[1];
		$arrival_tmp = explode("/", $request->input('arrival_date'));
		$arrival_date = $arrival_tmp[2] ."-" .$arrival_tmp[0] ."-" .$arrival_tmp[1];

		$row = new Package([
			'nation_id'	             => $request->input('nation_id'),
			'name'	                 => $request->input('name'),
			'explain'                => $request->input('explain'),
			'adult_price'            => $request->input('adult_price'),
			'kid_price'	             => $request->input('kid_price'),
			'baby_price'             => $request->input('baby_price'),
			'departure_date'         => $departure_date,
			'arrival_date'	         => $arrival_date,
			'departure_schedule_id'  => $request->input('departure_schedule_id'),
 			'arrival_schedule_id'	 => $request->input('arrival_schedule_id'),
			'star'	 => $request->input('star')
		]);
		$row->pic="1";
		$row->save();  //사진에 id값을 넣기위해 먼저저장

		if ($request->hasFile('pic'))                // 업로드할 파일 선택한 경우
		{
			$pic = $request->file('pic');
			$picname = $row->id ."_" .$pic->getClientOriginalName();         // file name
			$picsize    = $pic->getSize();                   // file size
			$pic->storeAs('/public/package_pic', $picname);   // 저장(폴더 자동생성)

			$row->pic = $picname;
		}

		$row->save();  //업데이트

		return redirect(route('a_package.index'));
    }

    public function show($id)
    {
		$data['row'] = Package::leftjoin('schedules as departure_schedule', 'packages.departure_schedule_id', '=', 'departure_schedule.id')
			->leftjoin('schedules as arrival_schedule', 'packages.arrival_schedule_id', '=', 'arrival_schedule.id')

			->leftjoin('airports as departure_start_airport', 'departure_schedule.departure_id', '=', 'departure_start_airport.id')
			->leftjoin('airports as departure_end_airport', 'departure_schedule.destnation_id', '=', 'departure_end_airport.id')
			->leftjoin('cities as departure_start_city', 'departure_start_airport.cities_id', '=', 'departure_start_city.id')
			->leftjoin('cities as departure_end_city', 'departure_end_airport.cities_id', '=', 'departure_end_city.id')

			->leftjoin('airports as arrival_start_airport', 'arrival_schedule.departure_id', '=', 'arrival_start_airport.id')
			->leftjoin('airports as arrival_end_airport', 'arrival_schedule.destnation_id', '=', 'arrival_end_airport.id')
			->leftjoin('cities as arrival_start_city', 'arrival_start_airport.cities_id', '=', 'arrival_start_city.id')
			->leftjoin('cities as arrival_end_city', 'arrival_end_airport.cities_id', '=', 'arrival_end_city.id')

			->leftjoin('nations', 'packages.nation_id', '=', 'nations.id')

			->select('packages.*', 
			'departure_schedule.startDate as departure_schedule_startDate', 'departure_schedule.endDate as departure_schedule_endDate', 'departure_start_airport.name as departure_start_airport_name', 'departure_end_airport.name as departure_end_airport_name', 'departure_start_city.name as departure_start_city_name', 'departure_end_city.name as departure_end_city_name',
			'arrival_schedule.startDate as arrival_schedule_startDate', 'arrival_schedule.endDate as arrival_schedule_endDate', 'arrival_start_airport.name as arrival_start_airport_name', 'arrival_end_airport.name as arrival_end_airport_name', 'arrival_start_city.name as arrival_start_city_name', 'arrival_end_city.name as arrival_end_city_name'
			,'nations.name as nation_name')
			->where('packages.id', '=', $id)->first();

		return view('admin.package.package.show', $data);
    }

    public function edit($id)
    {
        $data['nations'] = Nation::get();
		$data['schedules'] = Schedule::leftjoin('airports as departure_airport', 'schedules.departure_id', '=', 'departure_airport.id')
			->leftjoin('airports as destnation_airport', 'schedules.destnation_id', '=', 'destnation_airport.id')
			->leftjoin('cities as departure_city', 'departure_airport.cities_id', '=', 'departure_city.id')
			->leftjoin('cities as destnation_city', 'destnation_airport.cities_id', '=', 'destnation_city.id')
			->select('schedules.*', 'destnation_airport.name as destnation_airport_name', 'departure_airport.name as departure_airport_name', 'departure_city.name as departure_city_name', 'destnation_city.name as destnation_city_name')
			->orderby('schedules.startDate', 'asc')->get();
		$data['row'] = Package::leftjoin('schedules as departure_schedule', 'packages.departure_schedule_id', '=', 'departure_schedule.id')
			->leftjoin('schedules as arrival_schedule', 'packages.arrival_schedule_id', '=', 'arrival_schedule.id')

			->leftjoin('airports as departure_start_airport', 'departure_schedule.departure_id', '=', 'departure_start_airport.id')
			->leftjoin('airports as departure_end_airport', 'departure_schedule.destnation_id', '=', 'departure_end_airport.id')
			->leftjoin('cities as departure_start_city', 'departure_start_airport.cities_id', '=', 'departure_start_city.id')
			->leftjoin('cities as departure_end_city', 'departure_end_airport.cities_id', '=', 'departure_end_city.id')

			->leftjoin('airports as arrival_start_airport', 'arrival_schedule.departure_id', '=', 'arrival_start_airport.id')
			->leftjoin('airports as arrival_end_airport', 'arrival_schedule.destnation_id', '=', 'arrival_end_airport.id')
			->leftjoin('cities as arrival_start_city', 'arrival_start_airport.cities_id', '=', 'arrival_start_city.id')
			->leftjoin('cities as arrival_end_city', 'arrival_end_airport.cities_id', '=', 'arrival_end_city.id')

			->leftjoin('nations', 'packages.nation_id', '=', 'nations.id')

			->select('packages.*', 
			'departure_schedule.startDate as departure_schedule_startDate', 'departure_schedule.endDate as departure_schedule_endDate', 'departure_start_airport.name as departure_start_airport_name', 'departure_end_airport.name as departure_end_airport_name', 'departure_start_city.name as departure_start_city_name', 'departure_end_city.name as departure_end_city_name',
			'arrival_schedule.startDate as arrival_schedule_startDate', 'arrival_schedule.endDate as arrival_schedule_endDate', 'arrival_start_airport.name as arrival_start_airport_name', 'arrival_end_airport.name as arrival_end_airport_name', 'arrival_start_city.name as arrival_start_city_name', 'arrival_end_city.name as arrival_end_city_name'
			,'nations.name as nation_name')
			->where('packages.id', '=', $id)->first();

		return view('admin.package.package.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
			'nation_id'               => 'required',
			'name'                    => 'required',
			'explain'                 => 'required',
			'adult_price'             => 'required|numeric',
			'kid_price'               => 'required|numeric',
			'baby_price'              => 'required|numeric',
			'departure_date'          => 'required',
			'arrival_date'            => 'required',
			'star'              => 'required|numeric'
		 ],
		 [
			'nation_id.required'	   => '국가를 선택해주세요.',
			'name.required'	           => '패키지 이름을 입력해주세요.',
			'explain.required'	       => '설명을 작성해주세요.',
			'adult_price.required'	   => '어른 패키지 가격을 입력해주세요.',
			'kid_price.required'	   => '어린이 패키지 가격을 입력해주세요.',
			'baby_price.required'	   => '유아 패키지 가격을 입력해주세요.',
			'departure_date.required'  => '패키지 시작 날짜를 올려주세요.',
			'arrival_date.required'	   => '패키지 종료 날짜를 올려주세요.',
			'adult_price.numeric'	   => '숫자로만 입력해주세요.',
			'kid_price.numeric'	   => '숫자로만 입력해주세요.',
			'baby_price.numeric'	   => '숫자로만 입력해주세요.',
			'star.required'	           => '평점을 입력해주세요.',
			'star.numeric'	   => '숫자로만 입력해주세요.'
		]);

		$departure_tmp = explode("/", $request->input('departure_date'));
		$departure_date = $departure_tmp[2] ."-" .$departure_tmp[0] ."-" .$departure_tmp[1];
		$arrival_tmp = explode("/", $request->input('arrival_date'));
		$arrival_date = $arrival_tmp[2] ."-" .$arrival_tmp[0] ."-" .$arrival_tmp[1];
		
		$row = Package::find($id);

		$row->nation_id	             = $request->input('nation_id');
		$row->name	                 = $request->input('name');
		$row->explain                = $request->input('explain');
		$row->adult_price            = $request->input('adult_price');
		$row->kid_price	             = $request->input('kid_price');
		$row->baby_price             = $request->input('baby_price');
		$row->departure_date         = $departure_date;
		$row->arrival_date	         = $arrival_date;
		$row->departure_schedule_id  = $request->input('departure_schedule_id');
		$row->arrival_schedule_id	 = $request->input('arrival_schedule_id');
		$row->star					 = $request->input('star');
		
		if ($request->hasFile('pic'))                // 업로드할 파일 선택한 경우
		{
			Storage::delete('/public/package_pic/' .$row->pic);  //기존 사진 삭제
			$pic = $request->file('pic');
			$picname = $row->id ."_" .$pic->getClientOriginalName();         // file name
			$picsize    = $pic->getSize();                   // file size
			$pic->storeAs('/public/package_pic', $picname);   // 저장(폴더 자동생성)

			$row->pic = $picname;
		}

		$row->save();  //업데이트

		return redirect(route('a_package.index'));
    }

    public function destroy($id)
    {
        $row = Package::find($id);
		Storage::delete('/public/package_pic/' .$row->pic);  //기존 사진 삭제
		$row->delete();

		return redirect(route('a_package.index'));
    }
}
