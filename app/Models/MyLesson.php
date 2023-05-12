<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyLesson extends Model
{
    use HasFactory;

    protected $table = 'my_lessons';

    protected $fillable = [
        'tenBaiHoc',
        'linkVideo',
        'tenBaiTap',
        'moTaBaiTap',
        'trangThai',
        'giaoVienID',
        'my_chapter_id',
    ];

    public function myChapter()
    {
        return $this->belongsTo(MyChapter::class);
    }
}
