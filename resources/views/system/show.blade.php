@extends('site.layout')

@section('body')
    <div class="w-full">

        <div class="card w-4/12 m-auto">
            <div class="card-header">
                <h1>{{ $system->name }}</h1>
            </div>
            <div class="card-body">
                <strong>Name:</strong> {{ $system->name }}<br>
                <strong>Location:</strong> {{ $system->location->x }}, {{ $system->location->y }}<br />

                <br />
                <strong>Description:</strong> {{ $system->description}}<br />

                <div class="w-full text-right mr-2">
                    <a href="{{ route('edit-system', $system->id) }}" class="button">Edit System</a>
                </div>
            </div>
        </div>

        <div class="text-right w-4/12 mt-2 m-auto">
            <a href="{{ route('locations') }}" class="button-dark">Go Back</a>
        </div>

    </div>
@endsection
