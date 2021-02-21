<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;	//DB Lib 사용
use App\Models\Plane;

class AdminPlaneController extends Controller
{
    public function index()
    {
		$data['list'] = $this->getPlanes();
        return view('admin.air.plane.index', $data);
    }
	
	public function getPlanes()
	{
		$result = Plane::get();
		return $result;
	}
	
    public function create()
    {
        return view('admin.air.plane.create');
    }

    public function store(Request $request)
    {
        $request->validate([
			'number' => 'required|max:20'
		],
		[
			'number.required' => '번호를 입력해주세요'
		]);
		
		$row = new Plane([
			'number' => $request->input('number')
		]);
		
		$row->save();
		return redirect('plane');
    }

    public function show($id)
    {
		$row = Plane::find($id);
		return view('admin.air.plane.show', compact('row'));
    }

    public function edit($id)
    {
        $row = Plane::find($id);
		return view('admin.air.plane.edit', compact('row'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
			'number' => 'required|max:20'
		],
		[
			'number.required' => '번호를 입력해주세요'
		]);
		
		$row = Plane::find($id);
		$row->number = $request->input('number');
		$row->save();
		
		return redirect('plane');
    }

    public function destroy($id)
    {
        $row = Plane::find($id);
		$row->delete();
		
		return redirect('plane');
    }
}
