<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;

class TeachersController extends Controller
{
    public function getTeachers()
    {
        $teachers = User::where('phanQuyen', 2)->get();

        return response()->json($teachers);
    }
}
