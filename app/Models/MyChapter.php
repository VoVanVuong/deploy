<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyChapter extends Model
{
    use HasFactory;

    protected $table = 'my_chapters';

    protected $fillable = [
        'tenChuongHoc',
        'trangThai',
        'giaoVienID',
        'my_course_id',
    ];

    public function myCourse()
    {
        return $this->belongsTo(MyCourse::class);
    }

    public function myLessons()
    {
        return $this->hasMany(MyLesson::class);
    }
}
