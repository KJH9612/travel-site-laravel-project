<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;	//DB Lib 사용
use App\Models\City;
use App\Models\Nation;

class AdminCityController extends Controller
{
    public function index()
    {
		$data['list'] = $this->getCity();
        return view('admin.other.city.index', $data);
    }
	
	public function getCity()
	{
		$result = City::leftjoin('nations', 'nations.id', '=', 'cities.nation_id')
				->select('cities.*', 'nations.name as nation_name')
				->get();
				
		return $result;
	}
	
    public function create()
    {
		$data['list'] = Nation::get();
        return view('admin.other.city.create', $data);
    }

    public function store(Request $request)
    {
		$request->validate([
			'name' => 'required|max:30',
			'nation_id' => 'required'
		],
		[
			'name.required' => '이름을 입력해주세요',
			'nation_id.required' => '국가를 선택해주세요'
		]);
		
		$row = new City([
			'name' => $request->input('name'),
			'nation_id' => $request->input('nation_id'),
			'info' => $request->input('info')
		]);
		$row->save();
		
		return redirect('city');
    }

    public function show($id)
    {
		$data['row'] = $this->getCityItem($id);
		return view('admin.other.city.show', $data);
    }
	
	public function getCityItem($id)
	{
		$result = City::leftjoin('nations', 'cities.nation_id', '=', 'nations.id')
				->select('cities.*', 'nations.name as nation_name')
				->where('cities.id', $id)
				->first();
				
		return $result;
	}

    public function edit($id)
    {
        $data['list'] = Nation::get();
		$data['row'] = $this->getCityItem($id);
		return view('admin.other.city.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
			'name' => 'required|max:30',
			'nation_id' => 'required'
		],
		[
			'name.required' => '이름을 입력해주세요',
			'nation_id.required' => '국가를 선택해주세요'
		]);
		
		$row = City::find($id);
		$row->name = $request->input('name');
		$row->nation_id = $request->input('nation_id');
		$row->info = $request->input('info');
		$row->save();
		
		return redirect('city');
    }

    public function destroy($id)
    {
        $row = City::find($id);
		$row->delete();
		
		return redirect('city');
    }
}
?>