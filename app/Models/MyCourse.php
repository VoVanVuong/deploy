<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyCourse extends Model
{
    use HasFactory;

    protected $table = 'my_courses';

    protected $fillable = [
        'tenKhoaHoc',
        'moTa',
        'linkVideo',
        'giaCa',
        'trangThai',
        'giaoVienID',
        'maHoaDon',
        'maKichHoat',
        'ngayHetHan',
        'ngayMua',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bills()
    {
        return $this->hasMany(Bill::class);
    }

    public function myChapter()
    {
        return $this->hasMany(MyChapter::class);
    }
}
