@extends('layouts.modal', [
    'id'    => 'teacher-modal',
    'title'  => 'Informations étudiant'
])

@section('modal-content')
    <form action="{{ route('teacher.update', ['id' => $teacher->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <x-forms.input name="last_name" :label="__('Nom')" :value="$teacher->last_name" required />
        <x-forms.input name="first_name" :label="__('Prénom')" :value="$teacher->first_name" required />
        <x-forms.input type="date" name="birth_date" :label="__('Date de Naissance')" :value="$teacher->birth_date" required />
        <x-forms.input type="email" name="email" :label="__('Email')" :value="$teacher->email" required />

        <x-forms.primary-button>
            {{ __('Valider') }}
        </x-forms.primary-button>
    </form>




@endsection
