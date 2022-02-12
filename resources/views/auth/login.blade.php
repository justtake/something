@extends('master')

@section('title', 'Auth')

@section('subtitle', 'Login')

@section('content')
    @php
        $errors = session('errors');
        $fields = [
            'email' => [
                'title' => 'E-mail',
                'type' => 'text'
            ],
            'password' => [
                'title' => 'Password',
                'type' => 'password'
            ]
        ];
    @endphp

    @include('elements.alerts', ['errors' => $errors])

    <form action="{!! route('auth.login') !!}" method="POST">
        @csrf

        @foreach ($fields as $fieldName => $field)
            <div class="mb-3">
                <label for="field-{!! $fieldName !!}" class="form-label">{!! $field['title'] !!}</label>
                <input type="{!! $field['type'] !!}"
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
