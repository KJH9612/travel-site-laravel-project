<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', // 사용자 id
        'title', // 제목
        'content', // 내용
        'image', // 이미지 구분은 세미콜론으로
        'regdateTime', // 등록 시간(YYYY-MM-DD hh:mm:ss)
        'updateTime', // 갱신 시간(YYYY-MM-DD hh:mm:ss)
        'deleteTime' // 삭제 시간(YYYY-MM-DD hh:mm:ss)
    ];
}
