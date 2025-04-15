<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeStudentMail;
use App\Models\User;
use App\Models\UserSchool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = User::whereHas('userSchools', function ($query) {
            $query->where('role', 'teacher');
        })->get();
        return view('pages.teachers.index', compact('teachers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'email' => 'required|email|unique:users,email',
        ]);

        $password = Str::random(10);

        $teacher = User::create([
            'last_name' => $validated['last_name'],
            'first_name' => $validated['first_name'],
            'birth_date' => $validated['birth_date'],
            'email' => $validated['email'],
            'password' => Hash::make($password),
        ]);

        UserSchool::create([
            'user_id' => $teacher->id,
            'school_id' => auth()->user()->school_id ?? 1,
            'role' => 'teacher',

        ]);

        Mail::to([$teacher->email, 'otheremail@example.com'])
            ->send(new WelcomeStudentMail($teacher, $password));

        return redirect()->route('teacher.index')->with('success', 'Étudiant ajouté avec succès.');
    }

    public function show($id)
    {
        $teacher = User::findOrFail($id);
        return response()->json($teacher);
    }

    public function update(Request $request, $id)
    {
        $teacher = User::findOrFail($id);
        $teacher->update($request->all());

        return redirect()->route('teacher.index')->with('success', 'Étudiant mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $teacher = User::find($id);

        if ($teacher) {
            $teacher->delete();
            return redirect()->route('teacher.index')->with('success', 'Étudiant supprimé avec succès');
        }

        return redirect()->route('teacher.index')->with('error', 'Étudiant non trouvé');
    }
}
