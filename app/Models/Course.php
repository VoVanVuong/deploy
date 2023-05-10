<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $table = 'courses';

    protected $fillable = [
        'tenKhoaHoc',
        'moTa',
        'linkVideo',
        'tenKhoaHoc',
        'giaCa',
        'trangThai',
        'user_id',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function reviews()
    {
        return $this->hasMany(Evaluate::class, 'idKhoaHoc', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function searchCourseUser()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->select('id', 'hoTen');
    }

    public function instructor()
    {
        return $this->belongsTo(User::class, 'user_id')->select('id', 'hoTen');
    }

    public function chapters()
    {
        return $this->hasMany(Chapter::class)->select('id', 'tenChuongHoc', 'course_id');
    }
}
