<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $table = 'bills';

    protected $fillable = [
        'hoTen',
        'soDienThoai',
        'diaChi',
        'maHoaDon',
        'maKichHoat',
        'user_id',
        'my_course_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function myCourse()
    {
        return $this->belongsTo(MyCourse::class);
    }

}
