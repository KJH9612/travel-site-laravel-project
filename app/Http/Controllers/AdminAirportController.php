<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;	//DB Lib 사용
use App\Models\Airport;
use App\Models\City;

class AdminAirportController extends Controller
{
    public function index()
    {
		$data['list'] = $this->getAirport();
		return view('admin.air.airport.index', $data);
    }
	
	public function getAirport()
	{
		$result = Airport::leftjoin('cities', 'airports.cities_id', '=', 'cities.id')
					->select('airports.*', 'cities.name as cities_name')
					->get();
		return $result;
	}
	
	public function getPlanes()
	{
		$result = Plane::get();
		return $result;
	}
	
    public function create()
    {
		$data['list'] = City::get();
        return view('admin.air.airport.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
			'name' => 'required|max:40',
			'cities_id' => 'required'
		],
		[
			'name.required' => '이름을 입력해주세요',
			'cities_id.required' => '도시를 선택해주세요'
		]);
		
		
		$row = new Airport([
			'name' => $request->input('name'),
			'cities_id' => $request->input('cities_id')
		]);
		
		$row->save();
		
		return redirect('airport');
    }

    public function show($id)
    {
		$data['row'] = $this->getAir($id);
		return view('admin.air.airport.show', $data);
		//return response($data);
    }
	
	public function getAir($id)
	{
		$result = Airport::leftjoin('cities', 'airports.cities_id', '=', 'cities.id')
					->select('airports.*', 'cities.name as cities_name')
					->where('airports.id', $id)
					->first();
					
		return $result;
	}
	

    public function edit($id)
    {
        $data['row'] = Airport::find($id);
		$data['list'] = City::get();
		
		return view('admin.air.airport.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
			'name' => 'required|max:40',
			'cities_id' => 'required'
		],
		[
			'name.required' => '이름을 입력해주세요',
			'cities_id.required' => '도시를 선택해주세요'
		]);
		
		$row = Airport::find($id);
		$row->name = $request->input('name');
		$row->cities_id = $request->input('cities_id');
		$row->save();
		
		return redirect('airport');
    }

    public function destroy($id)
    {
        $row = Airport::find($id);
		$row->delete();
		
		return redirect('airport');
    }
}
