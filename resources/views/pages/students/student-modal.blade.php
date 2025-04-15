@extends('layouts.modal', [
    'id'    => 'student-modal',
    'title'  => 'Informations étudiant'
])

@section('modal-content')
    <form action="{{ route('student.update', ['id' => $student->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <x-forms.input name="last_name" :label="__('Nom')" :value="$student->last_name" required />
        <x-forms.input name="first_name" :label="__('Prénom')" :value="$student->first_name" required />
        <x-forms.input type="date" name="birth_date" :label="__('Date de Naissance')" :value="$student->birth_date" required />
        <x-forms.input type="email" name="email" :label="__('Email')" :value="$student->email" required />

        <x-forms.primary-button>
            {{ __('Valider') }}
        </x-forms.primary-button>
    </form>




@endsection
