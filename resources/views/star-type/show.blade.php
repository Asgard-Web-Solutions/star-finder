@extends('site.layout')

@section('body')
    <div class="w-full">

        <div class="card w-4/12 m-auto">
            <div class="card-header">
                <h1>{{ $star->type }}</h1>
            </div>
            <div class="card-body">
                <strong>Name:</strong> {{ $star->type }}<br>
                <strong>diameter:</strong> {{ $star->diameter}}<br>
                <strong>color:</strong> {{ $star->color}}<br>
                <strong>probobility:</strong> {{ $star->probability}}

                <div class="w-full text-right mr-2">
                    <a href="{{ route('edit-star-type', $star->id) }}" class="button">Edit star</a>
                </div>
            </div>
        </div>

        <div class="text-right w-4/12 mt-2 m-auto">
            <a href="{{ route('all-star-types') }}" class="button-dark">Go Back</a>
        </div>

    </div>
@endsection
