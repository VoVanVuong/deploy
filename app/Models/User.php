<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'soDienThoai',
        'password',
        'hoTen',
        'gioiTinh',
        'ngaySinh',
        'diaChi',
        'avatar',
        'trangThai',
        'phanQuyen',
        'last_seen',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {

        return $this->getKey();

    }

    public function getJWTCustomClaims()
    {

        return [];

    }

    public function isUserOnline()
    {
        return Cache::has('user-is-online' . $this->id);
    }

    public function reviews()
    {
        return $this->hasMany(Evaluate::class, 'idNguoiDung', 'id');
    }

    // public function courses()
    // {
    //     return $this->belongsToMany(Course::class, 'evaluates', 'idNguoiDung', 'idKhoaHoc')->withPivot('soSaoDanhGia');
    // }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function chapters()
    {
        return $this->hasManyThrough(Chapter::class, Course::class, 'user_id', 'course_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
