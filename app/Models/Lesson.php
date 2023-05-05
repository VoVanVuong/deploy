<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $table = 'lessons';

    protected $fillable = [
        'tenBaiHoc',
        'linkVideo',
        'tenBaiTap',
        'moTaBaiTap',
        'trangThai',
        'chapter_id',
        'user_id',
    ];

    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

}
