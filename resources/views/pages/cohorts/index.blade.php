<x-app-layout>
    <x-slot name="header">
        <h1 class="flex items-center gap-1 text-sm font-normal">
            <span class="text-gray-700">
                {{ __('Promotions') }}
            </span>
        </h1>
    </x-slot>

    <!-- begin: grid -->
    <div class="grid lg:grid-cols-3 gap-5 lg:gap-7.5 items-stretch">
        <div class="lg:col-span-2">
            <div class="grid">
                <div class="card card-grid h-full min-w-full">
                    <div class="card-header">
                        <h3 class="card-title">Mes promotions</h3>
                    </div>
                    <div class="card-body">
                        <div data-datatable="true" data-datatable-page-size="5">
                            <div class="scrollable-x-auto">
                                <table class="table table-border" data-datatable-table="true">
                                    <thead>
                                    <tr>
                                        <th class="min-w-[280px]">
                                            <span class="sort asc">
                                                <span class="sort-label">Promotion</span>
                                                <span class="sort-icon"></span>
                                            </span>
                                        </th>
                                        <th class="min-w-[135px]">
                                            <span class="sort">
                                                <span class="sort-label">Year</span>
                                                <span class="sort-icon"></span>
                                            </span>
                                        </th>
                                        <th class="min-w-[135px]">
                                            <span class="sort">
                                                <span class="sort-label">Students</span>
                                                <span class="sort-icon"></span>
                                            </span>
                                        </th>
                                        <th class="min-w-[100px]">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($promotions as $promotion)
                                        <tr>
                                            <td>
                                                <div class="flex flex-col gap-2">
                                                    <a class="leading-none font-medium text-sm text-gray-900 hover:text-primary"
                                                       href="{{ route('cohort.show', $promotion->id) }}">
                                                        {{ $promotion->name }}
                                                    </a>
                                                    <span class="text-2sm text-gray-700 font-normal leading-3">
                                                        {{ $promotion->description }}
                                                    </span>
                                                </div>
                                            </td>
                                            <td>{{ $promotion->start_date }} - {{ $promotion->end_date }}</td>
                                            <td>{{ $promotion->students_count }}</td>
                                            <td>
                                                <div class="flex items-center justify-between">
                                                    <a href="#">
                                                        <i class="text-success ki-filled ki-shield-tick"></i>
                                                    </a>
                                                    <a class="hover:text-primary cursor-pointer" href="#"
                                                       data-modal-toggle="#cohort-modal"
                                                       data-id="{{ $promotion->id }}"
                                                       data-name="{{ $promotion->name }}"
                                                       data-description="{{ $promotion->description }}"
                                                       data-start-date="{{ $promotion->start_date }}"
                                                       data-end-date="{{ $promotion->end_date }}">
                                                        <i class="ki-filled ki-cursor"></i>
                                                    </a>

                                                    <form action="{{ route('cohort.destroy', $promotion->id) }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-danger bg-transparent border-0">
                                                            <i class="ki-filled ki-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
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

        <!-- Form to add a new promotion -->
        <div class="lg:col-span-1">
            <div class="card h-full">
                <div class="card-header">
                    <h3 class="card-title">
                        Ajouté une Promotion
                    </h3>
                </div>
                <div class="card-body flex flex-col gap-5">
                    <!-- Form -->
                    <form action="{{ route('cohort.store') }}" method="POST">
                        @csrf

                        <x-forms.input name="name" :label="__('Nom de la promotion')" required />
                        <div class="mb-4"></div>
                        <x-forms.input name="description" :label="__('Lieu')" required />
                        <div class="mb-4"></div>
                        <x-forms.input type="date" name="start_date" :label="__('Start of the year')" required />
                        <div class="mb-4"></div>
                        <x-forms.input type="date" name="end_date" :label="__('End of the year')" required />
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
    @include('pages.cohorts.cohort-modal')

</x-app-layout>
<script src="{{ asset('js/cohort.js') }}"></script>
