<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Consumer;

class AdminConsumerController extends Controller
{
    public function index()
    {
		$data['list'] = Consumer::get();
        return view('admin.other.consumer.index', $data);
    }

    public function create()
    {
        return view('admin.other.consumer.create');
    }

    public function store(Request $request)
    {
        $request->validate([
			'name'   => 'required',
			'birthday'   => 'required|numeric',
			'uid'   => 'required',
			'pwd'   => 'required',
			'tel1'  => 'numeric',
			'tel2'  => 'numeric',
			'tel3'  => 'numeric'
		 ],
		 [
			'name.required'	   => '이름은 필수입력입니다.',
			'birthday.required'	   => '생일은 필수입력입니다.',
			'birthday.numeric'	   => '생일은 숫자입력입니다.',
			'uid.required'	   => '아이디는 필수입력입니다.',
			'pwd.required'	   => '패스워드는 필수입력입니다.',
			'tel1.numeric'	   => '전화번호는 숫자입력입니다.',
			'tel2.numeric'	   => '전화번호는 숫자입력입니다.',
			'tel3.numeric'	   => '전화번호는 숫자입력입니다.'
		]);
		$tel1 = $request->input('tel1');
		$tel2 = $request->input('tel2');
		$tel3 = $request->input('tel3');
		$tel = sprintf('%-3s%-4s%-4s', $tel1, $tel2, $tel3);

		$row = new Consumer([
			'name'	=> $request->input('name'),
			'birthday'   => $request->input('birthday'),
			'uid'  => $request->input('uid'),
			'pwd'	=> $request->input('pwd'),
			'email'	=> $request->input('email'),
			'tel'	=> $tel,
			'gender'	=> $request->input('gender'),
			'rank'	=> $request->input('rank')
		]);

		if ($request->hasFile('pic'))                // 업로드할 파일 선택한 경우
		{
			$pic = $request->file('pic');
			$picname = $row->uid ."_" .$pic->getClientOriginalName();         // file name
			$picsize    = $pic->getSize();                   // file size
			$pic->storeAs('/public/user_pic', $picname);   // 저장(폴더 자동생성)

			$row->pic = $picname;
		}

		$row->save();

		return redirect(route('a_consumer.index'));
    }

    public function show($id)
    {
        $data['row'] = Consumer::find($id);

		return view('admin.other.consumer.show', $data);
    }

    public function edit($id)
    {
        $data['row'] = Consumer::find($id);

		return view('admin.other.consumer.edit', $data);
    }

    public function update(Request $request, $id)
    {
		 $request->validate([
			'name'   => 'required',
			'birthday'   => 'required|numeric',
			'uid'   => 'required',
			'tel1'  => 'numeric',
			'tel2'  => 'numeric',
			'tel3'  => 'numeric'
		 ],
		 [
			'name.required'	   => '이름은 필수입력입니다.',
			'birthday.required'	   => '생일은 필수입력입니다.',
			'birthday.numeric'	   => '생일은 숫자입력입니다.',
			'uid.required'	   => '아이디는 필수입력입니다.',
			'tel1.numeric'	   => '전화번호는 숫자입력입니다.',
			'tel2.numeric'	   => '전화번호는 숫자입력입니다.',
			'tel3.numeric'	   => '전화번호는 숫자입력입니다.'
		]);

		$row = Consumer::find($id);

		if ($request->hasFile('pic'))                // 업로드할 파일 선택한 경우
		{
			Storage::delete('/public/user_pic/' .$row->pic);
			$pic = $request->file('pic');
			$picname = $row->uid ."_" .$pic->getClientOriginalName();         // file name
			$picsize    = $pic->getSize();                   // file size
			$pic->storeAs('/public/user_pic', $picname);   // 저장(폴더 자동생성)

			$row->pic = $picname;
		}
		else if( $request->input('del_pic')){
			Storage::delete('/public/user_pic/' .$row->pic);
			$row->pic = "";
		}
		

		$tel1 = $request->input('tel1');
		$tel2 = $request->input('tel2');
		$tel3 = $request->input('tel3');
		$tel = sprintf('%-3s%-4s%-4s', $tel1, $tel2, $tel3);

		$row->name = $request->input('name');
		$row->birthday = $request->input('birthday');
		$row->uid = $request->input('uid');
		if( $request->input('pwd'))$row->pwd = $request->input('pwd');
		$row->email = $request->input('email');
		$row->tel = $tel;
		$row->gender = $request->input('gender');

		$row->save();

		return redirect(route('a_consumer.index'));
    }

    public function destroy($id)
    {
        $row = Consumer::find($id);
		if($row->pic) Storage::delete('/public/user_pic/' .$row->pic);
		$row->delete();

		return redirect(route('a_consumer.index'));
    }
}
