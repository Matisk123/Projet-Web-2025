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
    /**
     * Display a list of all students.
     */
    public function index()
    {
        // Get all users who have a 'student' role
        $students = User::whereHas('userSchools', function ($query) {
            $query->where('role', 'student');
        })->get();

        // Return the view with the list of students
        return view('pages.students.index', compact('students'));
    }

    /**
     * Store a new student in the database.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'email' => 'required|email|unique:users,email',
        ]);

        // Default password for new student
        $password = '123456';

        // Create the student user
        $student = User::create([
            'last_name' => $validated['last_name'],
            'first_name' => $validated['first_name'],
            'birth_date' => $validated['birth_date'],
            'email' => $validated['email'],
            'password' => Hash::make($password),
        ]);

        // Associate the student with a school and assign role
        UserSchool::create([
            'user_id' => $student->id,
            'school_id' => auth()->user()->school_id ?? 1, // Default school if not found
            'role' => 'student',
        ]);

        // Send a welcome email to the student and another email
        Mail::to([$student->email, 'otheremail@example.com'])
            ->send(new WelcomeStudentMail($student, $password));

        // Redirect back with success message
        return redirect()->route('student.index')->with('success', 'Étudiant ajouté avec succès.');
    }

    /**
     * Show a single student in JSON format.
     */
    public function show($id)
    {
        $student = User::findOrFail($id); // Find student by ID or fail
        return response()->json($student); // Return JSON response
    }

    /**
     * Update student information.
     */
    public function update(Request $request, $id)
    {
        $student = User::findOrFail($id); // Find student by ID
        $student->update($request->all()); // Update with all form data

        return redirect()->route('student.index')->with('success', 'Étudiant mis à jour avec succès.');
    }

    /**
     * Delete a student from the database.
     */
    public function destroy($id)
    {
        $student = User::find($id); // Find student by ID

        if ($student) {
            $student->delete(); // Delete the student
            return redirect()->route('student.index')->with('success', 'Étudiant supprimé avec succès');
        }

        // If student not found
        return redirect()->route('student.index')->with('error', 'Étudiant non trouvé');
    }
}
