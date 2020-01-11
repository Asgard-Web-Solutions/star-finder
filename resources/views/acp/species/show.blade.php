@extends('site.layout')

@section('body')
    <div class="w-full">

        <div class="card w-4/12 m-auto">
            <div class="card-header">
                <h1>{{ $species->name }}</h1>
            </div>
            <div class="card-body">
                <strong>Name:</strong> {{ $species->name }}<br>
                <strong>Description:</strong> {{ $species->description}}

                <div class="w-full text-right mr-2">
                    <a href="{{ route('edit-species', $species->id) }}" class="button">Edit Species</a>
                </div>
            </div>
        </div>

        <div class="text-right w-4/12 mt-2 m-auto">
            <a href="{{ route('all-species') }}" class="button-dark">Go Back</a>
        </div>

    </div>
@endsection
