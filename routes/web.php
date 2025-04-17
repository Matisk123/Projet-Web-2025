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
use Illuminate\Support\Facades\Mail;




// Redirect the root path to /dashboard
Route::redirect('/', 'dashboard');




Route::middleware('auth')->group(function () {




    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/email', [ProfileController::class, 'updateEmail'])->name('profile.email.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::patch('/profile/update', [ProfileController::class, 'updateProfile'])->name('profile.updateProfile');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');



    Route::middleware('verified')->group(function () {
        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');




        // Cohorts
        Route::get('/cohorts', [CohortController::class, 'index'])->name('cohort.index');
        Route::get('/cohort/{cohort}', [CohortController::class, 'show'])->name('cohort.show');
        Route::post('/cohorts', [CohortController::class, 'store'])->name('cohort.store');
        Route::delete('/cohort/{cohort}', [\App\Http\Controllers\CohortController::class, 'destroy'])->name('cohort.destroy');

        Route::get('/cohorts/create', [CohortController::class, 'create'])->name('cohort.create');
        Route::post('/cohorts/student/add/{cohort}', [CohortController::class, 'addStudent'])->name('cohort.student.add');
        Route::delete('/cohorts/student/remove/{cohort}/{student}', [CohortController::class, 'removeStudent'])->name('cohort.student.remove');

        Route::put('/cohorts/{id}', [CohortController::class, 'update'])->name('cohort.update');


        Route::get('/dashboard-teacher', [CohortController::class, 'autreVue'])->name('dashboard.teacher');

        // Teachers
        Route::get('/teachers', [TeacherController::class, 'index'])->name('teacher.index');
        Route::post('/teachers', [TeacherController::class, 'store'])->name('teacher.store');
        Route::get('/teachers/{id}', [TeacherController::class, 'show']);
        Route::put('/teachers/{id}', [TeacherController::class, 'update'])->name('teacher.update');
        Route::delete('/teachers/{id}', [TeacherController::class, 'destroy'])->name('teacher.destroy');
        Route::get('/teachers', [TeacherController::class, 'index'])->name('teacher.index');



        // Students
        Route::get('students', [StudentController::class, 'index'])->name('student.index');
        Route::post('/students', [StudentController::class, 'store'])->name('student.store');
        Route::get('/students/{id}', [StudentController::class, 'show']);
        Route::put('/students/{id}', [StudentController::class, 'update'])->name('student.update');
        Route::delete('/students/{id}', [StudentController::class, 'destroy'])->name('student.destroy');



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


Route::get('/test-mail', function () {
    Mail::raw('Mail de test en mode log.', function ($message) {
        $message->to('exemple@exemple.com')
            ->subject('Test Log Mail');
    });

    return 'Mail simulé envoyé !';
});



require __DIR__.'/auth.php';

