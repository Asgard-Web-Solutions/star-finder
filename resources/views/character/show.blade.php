@extends('site.layout')

@section('body')
    <div class="w-full">

        <div class="card w-4/12 m-auto">
            <div class="card-header">
                <h1>{{ $character->name }}</h1>
            </div>
            <div class="card-body">
                <strong>Name:</strong> {{ $character->name }}<br>
                <strong>Description:</strong> {{ $character->description}}
            </div>
        </div>

        <div class="text-right w-4/12 mt-2 m-auto">
            <a href="{{ route('all-characters') }}" class="button-dark">Go Back</a>
        </div>

    </div>
@endsection
