<?php

namespace App\Http\Controllers;

use App\Models\Cohort;
use App\Models\User;
use App\Models\UserSchool;
use App\Models\School;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $userRole = auth()->user()->school()->pivot->role;

        $totalCohorts = Cohort::count();
        $studentIds = UserSchool::where('role', 'student')->pluck('user_id');

        $totalStudents = User::whereIn('id', $studentIds)->count();

        // Récupère les ID des users avec rôle "teacher"
        $teacherIds = UserSchool::where('role', 'teacher')->pluck('user_id');
        $totalTeachers = User::whereIn('id', $teacherIds)->count();
        $totalGroups = School::count();

        // return view('pages.dashboard.dashboard-' . $userRole);

        return view('pages.dashboard.dashboard-' . $userRole, compact('totalCohorts', 'totalStudents', 'totalTeachers', 'totalGroups'));

    }
}
