<?php

namespace App\Http\Controllers;

use App\Models\Cohort;
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
        $promotions = Cohort::with('school')->get();
        return view('pages.cohorts.index', compact('promotions'));
    }


    /**
     * Display a specific cohort
     * @param Cohort $cohort
     * @return Application|Factory|object|View
     */
    public function show(Cohort $cohort) {

        return view('pages.cohorts.show', [
            'cohort' => $cohort
        ]);

    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'school_id' => 'required|exists:schools,id'
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
            'school_id' => $request->school_id,
        ]);

        return redirect()->route('cohort.index')->with('success', 'Promotion ajoutée avec succès!');
    }


}
