<?php

namespace App\Http\Controllers;

use App\Models\Cohort;
use App\Models\User;
use App\Models\UserCohort;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class CohortController extends Controller
{
    /**
     * Display all available cohorts
     * @return Factory|View|Application|object
     */
    public function index() {
        // return view('pages.cohorts.index');
        $promotions = Cohort::getCohortBySchoolId(1);

        return view('pages.cohorts.index', compact('promotions'));

    }

    /**
     * Display the dashboard for a teacher
     * @return Application|Factory|View|object
     */
    public function autreVue() {
        $promotions = Cohort::getCohortBySchoolId(1);
        return view('pages.dashboard.dashboard-teacher', compact('promotions'));
    }

    /**
     * Display a specific cohort
     * @param Cohort $cohort
     * @return Application|Factory|object|View
     */
    public function show(Cohort $cohort) {
        $students = User::getUserByRole('student', 1);

        return view('pages.cohorts.show', [
            'cohort' => $cohort,
            'cohortStudents' => $cohort->students,
            'students' => $students,
        ]);
    }

    /**
     * Add a student to a cohort
     * @param Cohort $cohort
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addStudent(Cohort $cohort, Request $request) {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);
        $user = User::find($request->user_id);

        // Link User with Cohort
        UserCohort::create([
            'user_id' => $user->id,
            'cohort_id' => $cohort->id,
        ]);

        return redirect()->route('cohort.show', $cohort)->with('success', 'Étudiant ajouté avec succès !');
    }

    /**
     * Remove a student from a cohort
     * @param Cohort $cohort
     * @param User $student
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeStudent(Cohort $cohort, User $student)
    {
        $cohort->students()->detach($student->id);

        return redirect()->route('cohort.show', $cohort)->with('success', 'Étudiant retiré avec succès.');
    }

    /**
     * Store a newly created cohort in the database
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        /*$cohort = Cohort::create($validated);

        if(auth()->check()) {
            auth()->user()->cohorts()->attach($cohort->id);
        }*/

        //Cohort::create($validated);

        $cohort = Cohort::create([
            'name' => $request->name,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'school_id' => 1,
        ]);

        return redirect()->route('cohort.index')->with('success', 'Promotion ajoutée avec succès!');
    }

    /**
     * Remove a cohort from the database
     * @param Cohort $cohort
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Cohort $cohort)
    {
        $cohort->delete();


        return redirect()->route('cohort.index')->with('success', 'Promotion supprimée avec succès.');
    }

    /**
     * Update the specified cohort in the database
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $cohort = Cohort::findOrFail($id);
        $cohort->update($validated);

        return redirect()->back()->with('success', 'Promotion mise à jour');
    }
}
