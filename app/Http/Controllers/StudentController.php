<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserSchool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    public function index()
    {
        //return view('pages.students.index');
        $students = User::whereHas('userSchools', function ($query) {
            $query->where('role', 'student');
        })->get();

        return view('pages.students.index', compact('students'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'email' => 'required|email|unique:users,email',
        ]);

        $student = User::create([
            'last_name' => $validated['last_name'],
            'first_name' => $validated['first_name'],
            'birth_date' => $validated['birth_date'],
            'email' => $validated['email'],
            'password' => Hash::make('defaultpassword'),
            ]);

        UserSchool::create([
            'user_id' => $student->id,
            'school_id' => auth()->user()->school_id ?? 1,
            'role' => 'student',
        ]);

        return redirect()->route('student.index')->with('success', 'Étudiant ajouté avec succès.');
    }
}
