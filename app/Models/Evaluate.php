<?php

namespace App\Models;

use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluate extends Model
{
    use HasFactory;

    protected $table = 'evaluates';

    protected $fillable = [
        'soSaoDanhGia',
        'idNguoiDung',
        'idKhoaHoc',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'idNguoiDung', 'id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'idKhoaHoc', 'id');
    }
}
