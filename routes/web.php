<?php




use App\Http\Controllers\CohortController;
use App\Http\Controllers\CommonLifeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RetroController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\KnowledgeController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;




// Redirect the root path to /dashboard
Route::redirect('/', 'dashboard');




Route::middleware('auth')->group(function () {




    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');




    Route::middleware('verified')->group(function () {
        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');




        // Cohorts
        Route::get('/cohorts', [CohortController::class, 'index'])->name('cohort.index');
        Route::get('/cohort/{cohort}', [CohortController::class, 'show'])->name('cohort.show');
        Route::post('/cohorts', [CohortController::class, 'store'])->name('cohort.store');
        Route::delete('/cohort/{cohort}', [\App\Http\Controllers\CohortController::class, 'destroy'])->name('cohort.destroy');


        // Teachers
        Route::get('/teachers', [TeacherController::class, 'index'])->name('teacher.index');




        // Students
        Route::get('students', [StudentController::class, 'index'])->name('student.index');
        Route::post('/students', [StudentController::class, 'store'])->name('student.store');



        // Knowledge
        Route::get('knowledge', [KnowledgeController::class, 'index'])->name('knowledge.index');




        // Groups
        Route::get('groups', [GroupController::class, 'index'])->name('group.index');




        // Retro
        route::get('retros', [RetroController::class, 'index'])->name('retro.index');




        // Common life
        Route::get('common-life', [CommonLifeController::class, 'index'])->name('common-life.index');
    });




});




Route::get('/jeu', function () {
    return view('jeu');
})->name('jeu');




Route::get('/score', function () {
    return view('score');
})->name('score');




require __DIR__.'/auth.php';

