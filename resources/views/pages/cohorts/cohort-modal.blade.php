@extends('layouts.modal', [
    'id' => 'cohort-modal',
    'title' => 'Modifier la Promotion'
])

@section('modal-content')
    <p class="text-sm text-gray-600 mb-4">
        Pour enregistrer les modifications, vous devez mettre à jour tous les champs obligatoires ci-dessous.
    </p>
    <form action="{{ route('cohort.update', ['id' => $promotion->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <x-forms.input name="name" :label="__('Nom de la promotion')" :value="$promotion->name" required />
        <div class="mb-4"></div>
        <x-forms.input name="description" :label="__('Description')" :value="$promotion->description" required />
        <div class="mb-4"></div>
        <x-forms.input type="date" name="start_date" :label="__('Date de début')" :value="$promotion->start_date" required />
        <div class="mb-4"></div>
        <x-forms.input type="date" name="end_date" :label="__('Date de fin')" :value="$promotion->end_date" required />
        <div class="mb-4"></div>
        <x-forms.primary-button>
            {{ __('Valider') }}
        </x-forms.primary-button>
    </form>
@endsection
