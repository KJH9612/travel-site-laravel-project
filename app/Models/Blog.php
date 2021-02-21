<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', // 사용자 id
        'pack_id', // 패키지 여행
        'title', // 제목
        'thumb', // 썸네일
        'filename', // 파일명
        'deleteTime' // 삭제 시간(YYYY-MM-DD hh:mm:ss)
    ];
}
