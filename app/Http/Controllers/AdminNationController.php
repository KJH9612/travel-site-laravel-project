<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;	//DB Lib 사용
use App\Models\Nation;

class AdminNationController extends Controller
{
    public function index()
    {
		$data['list'] = $this->getNation();
        return view('admin.other.nation.index', $data);
    }
	
	public function getNation()
	{
		$result = Nation::get();
		return $result;
	}
	
    public function create()
    {
        return view('admin.other.nation.create');
    }

    public function store(Request $request)
    {
		$request->validate([
			'name' => 'required|max:30'
		],
		[
			'name.required' => '이름을 입력해주세요'
		]);
		
		$row = new Nation([
			'name' => $request->input('name')
		]);
		$row->save();
		
		return redirect('nation');
    }

    public function show($id)
    {
		$row = Nation::find($id);
		return view('admin.other.nation.show', compact('row'));
    }

    public function edit($id)
    {
        $row = Nation::find($id);
		return view('admin.other.nation.edit', compact('row'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
			'name' => 'required|max:30'
		],
		[
			'name.required' => '이름을 입력해주세요'
		]);
		
		$row = Nation::find($id);
		$row->name = $request->input('name');
		$row->save();
		
		return redirect('nation');
    }

    public function destroy($id)
    {
        $row = Nation::find($id);
		$row->delete();
		
		return redirect('nation');
    }
}
?>