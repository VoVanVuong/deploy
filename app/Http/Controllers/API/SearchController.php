<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function searchCourse(Request $request)
    {
        $query = $request->input('search');

        $courses = Course::where('tenKhoaHoc', 'LIKE', "%$query%")
            ->get();

        return response()->json(['courses' => $courses]);
    }
}
