<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;	//DB Lib 사용
use App\Models\Schedule;
use App\Models\Plane;
use App\Models\Airport;

class AdminScheduleController extends Controller
{
    public function index()
    {
		$data['list'] = $this->getSchedule();
		return view('admin.air.schedule.index', $data);
    }
	
	public function getSchedule()
	{
		$result = Schedule::leftjoin('airports', 'schedules.departure_id', '=', 'airports.id')
			->leftjoin('airports as a', 'schedules.destnation_id', '=', 'a.id')
			->leftjoin('planes', 'schedules.air_id', '=', 'planes.id')
			->leftjoin('cities', 'airports.cities_id', '=', 'cities.id')
			->leftjoin('cities as c', 'a.cities_id', '=', 'c.id')
			->select('schedules.*', 'cities.name as departure_name', 'c.name as destnation_name', 'airports.name as departure_airport', 'a.name as destnation_airport', 'planes.number as planes_number')
			->get();
		return $result;
	}

    public function create()
    {
		$data['plist'] = Plane::get();
		$data['list'] = $this->getAir();
		
        return view('admin.air.schedule.create', $data);
    }
	
	public function getAir()
	{
		$result = Airport::leftjoin('cities', 'airports.cities_id', '=', 'cities.id')
					->select('airports.*', 'cities.name as cities_name')
					->get();
					
		return $result;
	}

    public function store(Request $request)
    {
        $request->validate([
			'startDate' => 'required',
			'endDate' => 'required',
			'departure_id' => 'required',
			'destnation_id' => 'required',
			'air_id' => 'required',
			'price' => 'required'
		],
		[
			'startDate.required' => '출발일을 선택해주세요',
			'endDate.required' => '도착일을 선택해주세요',
			'departure_id.required' => '출발지를 선택해주세요',
			'destnation_id.required' => '목적지를 선택해주세요',
			'air_id.required' => '항공기를 선택해주세요',
			'price.required' => '가격을 입력해주세요'
		]);
		
		$s = strtotime($request->input('startDate'));
		$e = strtotime($request->input('endDate'));
		$startDate = date('Y-m-d H:i:s', $s);
		$endDate = date('Y-m-d H:i:s', $e);
		
		$row = new Schedule([
			'startDate' => $startDate,
			'endDate' => $endDate,
			'departure_id' => $request->input('departure_id'),
			'destnation_id' => $request->input('destnation_id'),
			'air_id' => $request->input('air_id'),
			'price' => $request->input('price')
		]);
		
		$row->save();
		
		return redirect('schedule');
    }

    public function show($id)
    {
		$data['row'] = $this->getScheduleItem($id);
		return view('admin.air.schedule.show', $data);
    }
	
	public function getScheduleItem($id) 
	{
		$result = Schedule::leftjoin('airports', 'schedules.departure_id', '=', 'airports.id')
			->leftjoin('airports as a', 'schedules.destnation_id', '=', 'a.id')
			->leftjoin('planes', 'schedules.air_id', '=', 'planes.id')
			->leftjoin('cities', 'airports.cities_id', '=', 'cities.id')
			->leftjoin('cities as c', 'a.cities_id', '=', 'c.id')
			->select('schedules.*', 'cities.name as departure_name', 'c.name as destnation_name', 'airports.name as departure_airport', 'a.name as destnation_airport', 'planes.number as planes_number')
			->where('schedules.id', $id)
			->first();
		return $result;
	}

    public function edit($id)
    {
        $data['row'] = $this->getScheduleItem($id);
		$data['plist'] = Plane::get();
		$data['list'] = $this->getAir();
		
		return view('admin.air.schedule.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
			'startDate' => 'required',
			'endDate' => 'required',
			'departure_id' => 'required',
			'destnation_id' => 'required',
			'air_id' => 'required',
			'price' => 'required'
		],
		[
			'startDate.required' => '출발일을 선택해주세요',
			'endDate.required' => '도착일을 선택해주세요',
			'departure_id.required' => '출발지를 선택해주세요',
			'destnation_id.required' => '목적지를 선택해주세요',
			'air_id.required' => '항공기를 선택해주세요',
			'price.required' => '가격을 입력해주세요'
		]);
		
		$s = strtotime($request->input('startDate'));
		$e = strtotime($request->input('endDate'));
		$startDate = date('Y-m-d H:i:s', $s);
		$endDate = date('Y-m-d H:i:s', $e);
		
		$row = Schedule::find($id);
		$row->startDate = $startDate;
		$row->endDate = $endDate;
		$row->departure_id = $request->input('departure_id');
		$row->destnation_id = $request->input('destnation_id');
		$row->air_id = $request->input('air_id');
		$row->price = $request->input('price');
		$row->save();
		
		return redirect('schedule');
    }

    public function destroy($id)
    {
        $row = Schedule::find($id);
		$row->delete();
		
		return redirect('schedule');
    }
}
