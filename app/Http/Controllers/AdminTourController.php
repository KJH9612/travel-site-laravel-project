<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Tour;
use App\Models\City;

class AdminTourController extends Controller
{
    public function index()
    {
		$data['list'] = Tour::leftjoin('cities', 'tours.city_id', '=', 'cities.id')->select('tours.*', 'cities.name as city_name')->get();
        return view('admin.package.tour.index', $data);
    }

    public function create()
    {
		$data['cities'] = City::get();
        return view('admin.package.tour.create', $data);
    }

    public function store(Request $request)
    {
		$request->validate([
			'name'   => 'required',
			'context'   => 'required',
			'pic1'   => 'required',
			'pic2'   => 'required',
			'city_id'   => 'required',
		 ],
		 [
			'name.required'	   => '이름을 입력해주세요.',
			'context.required'	   => '설명을 작성해주세요.',
			'pic1.required'	   => '사진1을 올려주세요.',
			'pic2.required'	   => '사진2를 올려주세요.',
			'city_id.required'	   => '도시를 선택해주세요.',
		]);

		$row = new Tour([
			'name'	=> $request->input('name'),
			'context'   => $request->input('context'),
			'city_id'  => $request->input('city_id')
		]);

		$row->pic1 = "1"; //사진이름에 id값을 넣기 위해 먼저 데이터를 저장함.
		$row->pic2 = "1";
		$row->save();

		if ($request->hasFile('pic1'))                // 업로드할 파일 선택한 경우
		{
			$pic = $request->file('pic1');
			$picname = $row->id ."_" .$pic->getClientOriginalName();         // file name
			$picsize    = $pic->getSize();                   // file size
			$pic->storeAs('/public/tour_pic', $picname);   // 저장(폴더 자동생성)

			$row->pic1 = $picname;
		}
		if ($request->hasFile('pic2'))                // 업로드할 파일 선택한 경우
		{
			$pic = $request->file('pic2');
			$picname = $row->id ."_" .$pic->getClientOriginalName();         // file name
			$picsize    = $pic->getSize();                   // file size
			$pic->storeAs('/public/tour_pic', $picname);   // 저장(폴더 자동생성)

			$row->pic2 = $picname;
		}

		$row->save();

		return redirect(route('a_tour.index'));
    }

    public function show($id)
    {
       $data['row'] = Tour::leftjoin('cities', 'tours.city_id', '=', 'cities.id')->select('tours.*', 'cities.name as city_name')->where('tours.id', '=', $id)->first();

        return view('admin.package.tour.show', $data);
    }

    public function edit($id)
    {
		$data['row'] = Tour::leftjoin('cities', 'tours.city_id', '=', 'cities.id')->select('tours.*', 'cities.name as city_name')->where('tours.id', '=', $id)->first();
		$data['cities'] = City::get();
        return view('admin.package.tour.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
			'name'   => 'required',
			'context'   => 'required',
			'city_id'   => 'required'
		 ],
		 [
			'name.required'	   => '이름을 입력해주세요.',
			'context.required'	   => '설명을 작성해주세요.',
			'city_id.required'	   => '도시를 선택해주세요.'
		]);

		$row = Tour::find($id);
		$row->name = $request->input('name');
		$row->context = $request->input('context');
		$row->city_id = $request->input('city_id');

		if ($request->hasFile('pic1'))                // 업로드할 파일 선택한 경우
		{
			Storage::delete('/public/tour_pic/' .$row->pic1);  //기존 사진 삭제
			$pic = $request->file('pic1');
			$picname = $row->id ."_" .$pic->getClientOriginalName();         // file name
			$picsize    = $pic->getSize();                   // file size
			$pic->storeAs('/public/tour_pic', $picname);   // 저장(폴더 자동생성)

			$row->pic1 = $picname;
		}
		if ($request->hasFile('pic2'))                // 업로드할 파일 선택한 경우
		{
			Storage::delete('/public/tour_pic/' .$row->pic2);  //기존 사진 삭제
			$pic = $request->file('pic2');
			$picname = $row->id ."_" .$pic->getClientOriginalName();         // file name
			$picsize    = $pic->getSize();                   // file size
			$pic->storeAs('/public/tour_pic', $picname);   // 저장(폴더 자동생성)

			$row->pic2 = $picname;
		}

		$row->save();
		return redirect(route('a_tour.index'));
    }

    public function destroy($id)
    {
        $row = Tour::find($id);
		Storage::delete('/public/tour_pic/' .$row->pic1);  //기존 사진 삭제
		Storage::delete('/public/tour_pic/' .$row->pic2);  //기존 사진 삭제
		$row->delete();

		return redirect(route('a_tour.index'));
    }
}
