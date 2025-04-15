<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeStudentMail;
use App\Models\User;
use App\Models\UserSchool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
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

        $password = Str::random(10);

        $student = User::create([
            'last_name' => $validated['last_name'],
            'first_name' => $validated['first_name'],
            'birth_date' => $validated['birth_date'],
            'email' => $validated['email'],
            'password' => Hash::make($password),
        ]);

        UserSchool::create([
            'user_id' => $student->id,
            'school_id' => auth()->user()->school_id ?? 1,
            'role' => 'student',
        ]);

        Mail::to([$student->email, 'otheremail@example.com'])
            ->send(new WelcomeStudentMail($student, $password));

        return redirect()->route('student.index')->with('success', 'Étudiant ajouté avec succès.');
    }

    public function show($id)
    {
        $student = User::findOrFail($id);
        return response()->json($student);
    }

    public function update(Request $request, $id)
    {
        $student = User::findOrFail($id);
        $student->update($request->all());

        return redirect()->route('student.index')->with('success', 'Étudiant mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $student = User::find($id);

        if ($student) {
            $student->delete();
            return redirect()->route('student.index')->with('success', 'Étudiant supprimé avec succès');
        }

        return redirect()->route('student.index')->with('error', 'Étudiant non trouvé');
    }


}
