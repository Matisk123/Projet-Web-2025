<x-app-layout>
    <x-slot name="header">
        <h1 class="flex items-center gap-1 text-sm font-normal">
            <span class="text-gray-700">
                {{ __('Dashboard') }}
            </span>
        </h1>
    </x-slot>

    <!-- begin: grid -->
    <div class="grid lg:grid-cols-3 gap-5 lg:gap-7.5 items-stretch">
        <div class="lg:col-span-2">
            <div class="grid">
                <div class="card card-grid h-full min-w-full">

                    <!-- Cohort -->
                    <div class="card-header flex justify-between items-center">
                        <h3 class="card-title">
                            <a href="{{ route('cohort.index') }}" class="text-blue-500">Promotion</a>
                        </h3>
                        <span>{{ $totalCohorts }}</span>
                    </div>

                    <!-- Student -->
                    <div class="card-header flex justify-between items-center">
                        <h3 class="card-title">
                            <a href="{{ route('student.index') }}" class="text-blue-500">Étudiant</a>
                        </h3>
                        <span>{{ $totalStudents }}</span>
                    </div>

                    <!-- Teachers -->
                    <div class="card-header flex justify-between items-center">
                        <h3 class="card-title">
                            <a href="{{ route('teacher.index') }}" class="text-blue-500">Enseignant</a>
                        </h3>
                        <span>{{ $totalTeachers }}</span>
                    </div>

                    <!-- Groups -->
                    <div class="card-header flex justify-between items-center">
                        <h3 class="card-title">
                            <a href="{{ route('group.index') }}" class="text-blue-500">Groupes</a>
                        </h3>
                        <span>{{ $totalGroups }}</span>
                    </div>

                    <div class="card-body flex flex-col gap-5">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end: grid -->
</x-app-layout>
