@extends('master')

@section('title', 'People')

@section('subtitle', 'Create')

@section('content')
    @php
        $errors = session('errors');
        $fields = [
            'name' => 'Name',
            'height' => 'Height',
            'mass' => 'Mass',
            'hair_color' => 'Hair color',
            'skin_color' => 'Skin color',
            'eye_color' => 'Eye color',
            'birth_year' => 'Birth Year',
            'gender' => 'Gender'
        ];
    @endphp

    @include('elements.alerts', ['errors' => $errors])

    <h5 class="mb-4">Create new person</h5>
    <form action="{!! route('people.store') !!}" method="POST">
        @csrf

        @foreach ($fields as $fieldName => $fieldTitle)
        <div class="mb-3">
            <label for="field-{!! $fieldName !!}" class="form-label">{!! $fieldTitle !!}</label>
            <input type="text"
                   name="{!! $fieldName !!}"
                   value="{!! old($fieldName) !!}"
                   class="form-control {!! $errors && $errors->has($fieldName) ? 'is-invalid' : '' !!}">

            @if ($errors && $errors->has($fieldName))
                <div class="invalid-feedback">
                    {{ $errors->first($fieldName) }}
                </div>
            @endif

        </div>
        @endforeach

        <div class="mt-5" style="text-align: right">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
@endsection
