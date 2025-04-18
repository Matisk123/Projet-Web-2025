<x-app-layout>
    <x-slot name="header">
        <h1 class="flex items-center gap-1 text-sm font-normal">
            <span class="text-gray-700">{{ $cohort->name }}</span>
        </h1>
    </x-slot>


    <!-- begin: grid -->
    <div class="grid lg:grid-cols-3 gap-5 lg:gap-7.5 items-stretch">
        <div class="lg:col-span-2">
            <div class="grid">
                <div class="card card-grid h-full min-w-full">
                    <div class="card-header">
                        <h3 class="card-title">Enseignant et Étudiants</h3>
                    </div>
                    <div class="card-body">
                        <div data-datatable="true" data-datatable-page-size="30">
                            <div class="scrollable-x-auto">
                                <table class="table table-border" data-datatable-table="true">
                                    <thead>
                                    <tr>
                                        <th class="min-w-[135px]">
                                            <span class="sort">
                                                <span class="sort-label">Rôle</span>
                                                <span class="sort-icon"></span>
                                            </span>
                                        </th>

                                        <th class="min-w-[135px]">
                                           <span class="sort asc">
                                                <span class="sort-label">Nom</span>
                                                <span class="sort-icon"></span>
                                           </span>
                                        </th>
                                        <th class="min-w-[135px]">
                                           <span class="sort">
                                               <span class="sort-label">Prénom</span>
                                               <span class="sort-icon"></span>
                                           </span>
                                        </th>
                                        <th class="min-w-[135px]">
                                           <span class="sort">
                                               <span class="sort-label">Date de naissance</span>
                                               <span class="sort-icon"></span>
                                           </span>
                                        </th>
                                        <th class="max-w-[50px]"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($cohortTeachers as $teacher)
                                        <tr class="bg-yellow-100 font-bold">
                                            <td>Enseignant</td>
                                            <td>{{ $teacher->last_name }}</td>
                                            <td>{{ $teacher->first_name }}</td>
                                            <td>{{ \Carbon\Carbon::parse($teacher->birth_date)->format('d/m/Y') }}</td>
                                            <td>
                                                <form action="{{ route('cohort.teacher.remove', [$cohort, $teacher]) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Retirer</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @foreach ($cohortStudents as $student)
                                        <tr>
                                            <td>Étudiant</td>
                                            <td>{{ $student->last_name }}</td>
                                            <td>{{ $student->first_name }}</td>
                                            <td>{{ \Carbon\Carbon::parse($student->birth_date)->format('d/m/Y') }}</td>
                                            <td>
                                                <form action="{{ route('cohort.student.remove', [$cohort, $student]) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Retirer</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer justify-center md:justify-between flex-col md:flex-row gap-5 text-gray-600 text-2sm font-medium">
                                <div class="flex items-center gap-2 order-2 md:order-1">
                                    Show
                                    <select class="select select-sm w-16" data-datatable-size="true" name="perpage"></select>
                                    per page
                                </div>
                                <div class="flex items-center gap-4 order-1 md:order-2">
                                    <span data-datatable-info="true"></span>
                                    <div class="pagination" data-datatable-pagination="true"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="lg:col-span-1">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        Ajouter un étudiant à la promotion
                    </h3>
                </div>
                <div class="card-body flex flex-col gap-5">
                    <form action="{{ route('cohort.student.add', $cohort) }}" method="POST">
                        @csrf
                    <x-forms.dropdown name="user_id" :label="__('Student')">
                        @foreach($students as $student)
                            <option value="{{ $student->id }}">{{ $student->full_name }}</option>
                        @endforeach
                    </x-forms.dropdown>
                        <div class="mb-4"></div>
                    <x-forms.primary-button>
                        {{ __('Valider') }}
                    </x-forms.primary-button>
                    </form>
                </div>
            </div>
            <div class="mb-4"></div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Ajouter un professeur à la promotion</h3>
                </div>
                <div class="card-body flex flex-col gap-5">
                    <form action="{{ route('cohort.teacher.add', $cohort) }}" method="POST">
                        @csrf
                        <x-forms.dropdown name="user_id" :label="__('Teacher')">
                            @foreach($teachers as $teacher)
                                <option value="{{ $teacher->id }}">{{ $teacher->full_name }}</option>
                            @endforeach
                        </x-forms.dropdown>
                        <div class="mb-4"></div>
                        <x-forms.primary-button>
                            {{ __('Valider') }}
                        </x-forms.primary-button>
                    </form>
                </div>
            </div>

        </div>
    </div>
    <!-- end: grid -->
</x-app-layout>
