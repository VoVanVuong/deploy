<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';

    protected $fillable = [
        'noiDung',
        'lesson_id',
        'parent_id',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class)
            ->select(['id', 'avatar', 'hoTen']);
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id')
            ->with('user:id,avatar,hoTen');
    }
}
