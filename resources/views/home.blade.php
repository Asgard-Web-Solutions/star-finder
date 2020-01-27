@extends('site.layout')

@section('body')
    @if (!$loadCharacter)
        <a class="button" href="{{ route ('new-character') }}">create charater</a>
    @else 

    <div class="w-full">
        <div class="card w-1/4 m-auto">
            <div class="card-header">
                <h1>Actions</h1>
            </div>
            <div class="card-body">
                <a href="{{ route('visit-planet') }}">Visit {{ $loadCharacter->planet->name }}</a>
            </div>
        </div>
    </div>

    @endif
@endsection
