@extends('master')

@section('title', 'People')

@section('subtitle', 'All')

@section('content')
    @php
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

    @include('elements.alerts')

    <h5 class="mb-4">People <small><a href="{!! route('people.create') !!}">Create new person</a></small></h5>

    <table class="table table-sm">
        <thead>
        @foreach($fields as $fieldName => $fieldTitle)
            <th>{!! $fieldTitle !!}</th>
        @endforeach
        </thead>
        <tbody>
        @foreach($people as $person)
            <tr>
                @foreach($fields as $fieldName => $fieldTitle)
                    <td>{{ $person->{$fieldName} }}</td>
                @endforeach
            </tr>
        @endforeach
        </tbody>

    </table>

@endsection
